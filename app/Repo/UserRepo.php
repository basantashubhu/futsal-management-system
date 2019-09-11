<?php
/**
 * @author Suman Thaapa -- Lead
 * @author Prabhat gurung
 * @author Basanta Tajpuriya
 * @author Rakesh Shrestha
 * @author Manish Buddhacharya
 * @author Lekh Raj Rai
 * @author Ascol Parajuli
 * @email NEPALNME@GMAIL.COM
 * @create date 2019-03-12 16:51:56
 * @modify date 2019-03-12 16:51:56
 * @desc [description]
 */

namespace App\Repo;

use App\Lib\Filter\UserFilter\UserFilter;
use App\Models\Contact;
use App\Models\Fgp\Site;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserRepo extends BaseRepo
{
    public function save(Request $request)
    {
        $formData = $request->all();
        // $key == "password" || $key == "password_confirmation" || $key == "fname" || $key == "lname" || $key == "selected_sites"
        $avoidData = array('password', 'password_confirmation', 'fname', 'lname', 'selected_sites', 'rpt_mgr_id');
        DB::beginTransaction();
        try {
            foreach ($formData as $key => $value):
                if (!in_array($key, $avoidData)):
                    $this->model->$key = $value;
                endif;
            endforeach;
            $this->model->password = bcrypt($formData['password']);
            $this->model->userc_id = Auth::id();

            $this->model->save();

            if ($mgr_id = $request->input('rpt_mgr_id', false)) {
                $this->model->reportingMgr()->detach();
                $this->model->reportingMgr()->attach($mgr_id);
            } else {
                $this->model->reportingMgr()->detach();
            }
            // dd($d);

            /*
             * save assigned sites of user
             * */
            $this->saveSites($this->model, $request);

//            $client = new Client(); // **** Use of Client Model is deprecated ****
            /*
             * Every user i.e. Supervisor, Director have details in members table
             * details as first name, middle name, last name
             * details as date of birth etc.
             * */
            $member = new Member();
            $member = save_update($member, [
                'first_name' => $formData['fname'], 'last_name' => $formData['lname'],
                'user_id' => $this->model->id,
            ]);
            $contact = new Contact();
            $contact = save_update($contact, [
                'table_name' => 'members',
                'table_id' => $member->id,
                'email' => $formData['email'],
            ]);
            DB::commit();
            return $this->model;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return false;
        }

    }

    public function saveUpdate($request)
    {
        $old_record = $this->model->__toString();
        $action = $this->action;
        //check if the data is object of request
        if ($request instanceof Request) {
            $formData = $request->all();
        } elseif (is_array($request)) {
            $formData = $request;
        } else {
            throw new \Exception("undefined data");
        }

        foreach ($formData as $key => $value):
            if ($key != "formData" && $key != 'undefined' && !is_array($value)) {
                $this->model->$key = $value;
            }

        endforeach;
        if (isset($formData['password'])) {
            $this->model->password = bcrypt($formData['password']);
        }

        $this->model->$action = auth()->check() ? auth()->id() : 0;

        $user_id = 0;

        //if action is set to useru_id that means it's update so we need to push data in audit table
        if ($this->action == "useru_id") {
            $this->audit($this->model->id, $old_record, $this->model->__toString(), auth()->check() ? auth()->id() : $user_id);
        }
        $this->model->save();
        return $this->model;
    }

    /**
     * save the requested sites for user
     * @param         $user
     * @param Request $request
     */
    private function saveSites($user, Request $request)
    {
        $site_ids = $request->input('selected_sites', []);
        // site informations
        DB::table('site_managers')->where('user_id', $user->id)->delete();
        // $sites = DB::table('sites')->whereIn('id', $site_ids)->get()->map(function($site) use($user){
        //     return [
        //         'user_id' => $user->id,
        //         'site_id' => $site->id
        //     ];
        // })->toArray();
        $sites = Site::whereIn('id', $site_ids)->get()->map(function ($site) use ($user) {
            return [
                'user_id' => $user->id,
                'site_id' => $site->id,
            ];
        })->toArray();
        DB::table('site_managers')->insert($sites);
    }

    public function selectDataTable(Request $request)
    {
        $perpage = $request->pagination['perpage'] ?: 1000;
        $offset = ($request->pagination['page'] ?: 1 - 1) * $perpage;

        $result = $this->model
            ->join('roles', 'roles.id', 'users.role_id')
        // ->leftjoin('users as rpt', 'rpt.id', 'users.rpt_mgr_id')
        //            ->with('reportingMgr', 'reportingMgr.member')
            ->leftJoin('members', 'members.user_id', 'users.id')
            ->select('users.name', 'users.email', 'users.id', 'roles.label as role_name', 'is_locked', 'users.rpt_mgr_id',
                DB::raw('CONCAT(members.first_name," ",COALESCE(members.middle_name,"")," ", coalesce(members.last_name, "")) AS full_name'))
            ->where('users.name', '!=', 'dsc')->where('users.is_deleted', false);

        $filter = new UserFilter($request);
        if (isset($_COOKIE['users'])) {
            $advData = isset($_COOKIE['users']) ? json_decode($_COOKIE['users']) : [];
            $result = $filter->getQueryCookie($result, $advData);
        }
        $totalResult = count($result->groupBy('users.id')->get());

        $result = $result->when($request->input('sort.field') !== 'role_name', function ($q) use ($request) {
            $q->orderBy($request->sort['field'], $request->sort['sort']);
        })
            ->limit($perpage)->offset($offset);

        $result = $result->groupBy('users.id')->get();

        $data = [
            'meta' => [
                'page' => $request->pagination['page'],
                'pages' => ceil($totalResult / $perpage),
                'perpage' => $perpage,
                'total' => $totalResult,
                'sort' => $request->sort['sort'],
                'field' => $request->sort['field'],
            ],
            'data' => $result,
        ];
        return $data;
    }

    public function selectSupervisorDataTable(Request $request)
    {
        $perpage = $request->pagination['perpage'] ?: 20;
        $offset = ($request->pagination['page'] - 1) * $perpage;

        $result = $this->model
            ->join('roles', 'roles.id', 'users.role_id')
            ->leftJoin('members', 'members.user_id', 'users.id')
            ->select('users.name', 'users.email', 'users.id',
                DB::raw('CONCAT(members.first_name," ",COALESCE(members.middle_name,"")," ", coalesce(members.last_name, "")) AS sup_name'))
            ->selectRaw('(select count(distinct volunteer_id) from volunteers_supervisors where supervisor_id = users.id) as volunteers')
//            ->selectRaw('(select group_concat(concat(m.first_name, " ", coalesce(m.middle_name, "")," ", coalesce(m.last_name, "")) separator ", ")
        //                    from user_rpt_mgr rpt join members m on m.user_id = rpt.rpt_mgr_id where rpt.user_id = users.id group by rpt.user_id) as rpt_mgrs')
            ->where('users.name', '!=', 'dsc')->where('users.is_deleted', false)
            ->where(DB::raw('lower(roles.label)'), 'supervisor');

        $result->when($request->input('query.SearchSites', false), function ($q, $sup) {
            $q->where(function ($query) use ($sup) {
                $query->where(
                    DB::raw('CONCAT(members.first_name," ",COALESCE(members.middle_name,"")," ", coalesce(members.last_name, ""))'),
                    'like',
                    "%$sup%"
                )->orWhere('users.email', 'like', "%$sup%");
            });
        });

        $result->when($request->input('query.sup_cat', 'default'), function ($q, $cat) {
            if ($cat === 'default') {
                $ids = auth()->user()->hierarchyIds()->all();
                $q->whereIn('users.id', $ids);
            }
        })->when($request->input('query.sup_cat_county', false), function ($q, $county) {
            $q->whereHas('default_counties', function ($counties) use ($county) {
                $county = explode(',', $county);
                $counties->whereIn('value', $county);
            });
        });

        $totalResult = $result->count();

        $result->orderBy('members.first_name');

        $result = $result->get();

        $data = [
            'meta' => [
                'page' => $request->pagination['page'],
                'pages' => ceil($totalResult / $perpage),
                'perpage' => $perpage,
                'total' => $totalResult,
                'sort' => $request->sort['sort'],
                'field' => $request->sort['field'],
            ],
            'data' => $result,
        ];
        return $data;
    }

    public function userList(Request $request)
    {
        return $this->model->select('users.id', DB::raw('concat(members.first_name, " ", members.last_name) as text'))
            ->join('members', 'members.user_id', 'users.id')
            ->where(DB::raw('concat(members.first_name, " ", members.last_name)'), 'like', "%{$request->term}%")
            ->where('users.is_deleted', 0)->groupBy('users.id')
            ->orderBy('text')
            ->get();
    }
}
