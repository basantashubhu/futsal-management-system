<?php
/**
 * @author Suman Thaapa -- Lead
 * @author Rakesh Shrestha
 * @author Basanta Tajpuriya
 * @author Prabhat gurung
 * @author Manish Buddhacharya
 * @author Lekh Raj Rai
 * @email NEPALNME@GMAIL.COM
 * @create date 2019-03-12 16:51:56
 * @modify date 2019-03-12 16:51:56
 * @desc [description]
 */

namespace App\Http\Controllers\User;

use Hash;
use LogicException;
use App\Models\File;
use App\Models\Note;
use App\Models\Role;
use App\Models\User;
use App\Models\Audit;
use App\Models\Member;
use App\Repo\UserRepo;
use App\Models\Address;
use App\Models\Contact;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Repo\FGP\VolunteerRepo;
use App\Http\Requests\UserRequest;
use App\Models\EmailSettingsModel;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\json_encode;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserEditRequest;
use App\Http\Controllers\BaseController;

class UserController extends BaseController
{
    private static $repo = null;
    protected $clayout = "";

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->clayout = $this->layout . '.pages.user';
    }

    /**
     * @param $model
     * @return UserRepo|null
     */
    private static function getInstance($model)
    {
        if (self::$repo == null) {
            self::$repo = new UserRepo($model);
        }

        return self::$repo;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view($this->clayout . '.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $roles = Role::where('is_deleted', 0)->where('id', '!=', 1)->get();
        return view($this->clayout . '.modal.add', compact('roles'));
    }

    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {

        $roles = Role::where('is_deleted', 0)->where('id', '!=', 1)->get();

        return view($this->clayout . '.modal.edit', compact('roles', 'user'));
    }

    /**
     * @param Request $request
     * @return array
     */
    public function all(Request $request)
    {
        $data = self::getInstance('User')->selectDataTable($request);
        return $data;
    }

    public function userList(Request $request)
    {
        return self::getInstance('User')->userList($request);
    }

    /**
     * to store the user details
     * @param UserRequest $request
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:users,email|email',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
            'name' => 'required|unique:users,name',
            'fname' => 'required',
            'lname' => 'required',
            'role_id' => 'required',
        ]);

        $userData = $request->only([
            'name', 'email', 'password', 'role_id',
        ]);

        DB::transaction(function () use ($userData, $request) {

            $user = self::getInstance('User')->saveUpdate($userData);

            if ($user) {

                $user->self()->create([

                    'first_name' => $request->fname,
                    'last_name' => $request->lname,

                ]);

            }

            return $this->response("User added successFully", "view", 200);

        });

    }

    /**
     * to update the user details except password
     * @param UserEditRequest $request
     * @param User            $user
     * @return UserController|\Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function update(UserEditRequest $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'role_id' => 'required',
        ]);

        DB::transaction(function () use ($request, $user) {
            $userData = $request->only([
                'name', 'email', 'alt_id', 'role_id',
            ]);
            $res = self::getInstance($user)->saveUpdate($userData);

            $user->self()->update([
                "first_name" => $request->fname,
                "last_name" => $request->lname,
            ]);

            if ($res) {
                return $this->response("User edited successFully", "view", 200);
            } else {
                return $this->response("Can't edit user", 'view', 422);
            }

        });
    }

    public function changePassword(User $user)
    {
        return view($this->clayout . '.modal.changePassword', compact('user'));
    }

    public function checkPass(Request $request, User $user)
    {
        // $user = User::find(auth()->id());
        if (Hash::check($request->pass, $user->password)) {
            return response()->json(['pass' => 'true']);
        } else {
            return response()->json(['pass' => 'false']);
        }
    }

    public function updatePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);
        DB::beginTransaction();
        try {
            $user->password = bcrypt($request->password);
            $user->save();
            DB::commit();
            return $this->response("Password changed Successfully", "view", 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->response("Failed to change Password", 'view', 422);
        }
    }

    public function userProfile($id = null)
    {
        $id = $id ?: auth()->id();
        $email = EmailSettingsModel::where('user_id', $id)->first();
        $notes = Note::where('userc_id', $id)->orderBy('created_at', 'desc')->limit(8)->get();
        $i = 1;
        foreach ($notes as $note):
            $note->line = $i++;
        endforeach;
//        $client = Client::where('user_id', $id)->first();
        //        if (is_null($client)) {
        //            return $this->response("Profile Not Found", "error", 500);
        //        }

        /*
         * use of client model is deprecated use member instead of model
         * */
        $member = Member::where('user_id', $id)->first();
        $user = User::find($id);
        if (is_null($member)) {
            return $this->response("Profile Not Found", "error", 500);
        }
        $profile = File::where('table', 'members')->where('table_id', $member->id)->first();

        $sig = File::where('table', 'users')->where('table_id', $id)->where('document_title', 'signature')->first();

        if (!is_null($profile)) {
            if (file_exists(storage_path('uploads/') . $profile->file_name)):
                $profile->image = base64_encode(file_get_contents(storage_path('uploads/') . $profile->file_name));
            else:
                $profile->image = base64_encode(file_get_contents(storage_path('uploads/avatar.jpg')));
            endif;
        }

        $address = Address::where('table_name', 'members')->where('table_id', $member->id)->first();
        $contact = Contact::where('table_name', 'members')->where('table_id', $member->id)->first();
        $client = $member;
        // dd($address, $contact);
        return view('default.fgp.profile.index', compact('profile', 'notes', 'email', 'user', 'sig', 'client', 'address', 'contact'));
    }

    public function delete(User $user)
    {
        return view($this->clayout . '.modal.delete', compact('user'));
    }
    public function destroy(Request $request, User $user)
    {
        $user->is_deleted = true;
        $user->is_active = false;
        $user->save();
        return $this->response("User Successfully Deleted", "view", 200);
    }

    public function userCounties(Request $request)
    {
        $user_counties = auth()->user()->settings()->where('type', 'default_counties')->pluck('value')->map(function ($county) {
            return '"' . $county . '"';
        })->all();

        $user_counties = count($user_counties) ? $user_counties : ['""'];

        return [
            'counties' => Address::select('county')->selectRaw('(case when county in (' . implode(',', $user_counties) . ') then "1" else "0" end) as selected')
                ->distinct()->whereNotNull('county')->orderBy('selected', 'desc')
                ->get(),
        ];
    }

    public function getSupervisors(Request $request)
    {
        return (new UserRepo('User'))->selectSupervisorDataTable($request);
    }

    public function checkUserEmail(Request $request)
    {

        $user = User::where('email', $request->email)->first();

        if ($user) {
            if ($request->has('user_id')) {

                $this->checkToUpdateUserId($request, $user);

            } else {

                throw new LogicException("User of that email already exists");

            }

        }

    }

    public function checkToUpdateUserId(Request $request, User $user)
    {

        if ($user->id !== (int) $request->user_id) {
            throw new LogicException("User of that username already exists");
        }

    }

    public function checkUserName(Request $request)
    {

        $user = User::where("name", $request->name)->first();

        if ($user) {

            if ($request->has('user_id')) {

                $this->checkToUpdateUserId($request, $user);

            } else {

                throw new LogicException("User of that username already exists");

            }

        }

    }

    // public function checkToUpdateUserName(Request $request, User $user){

    //     if($user->id !== (int)$request->user_id){
    //         throw new LogicException("User of that username already exists");
    //     }

    // }

    public function getSites(Request $request, User $user)
    {
        return $user->sites(['id', 'site_name']);
    }

    public function filter_SearchSites($query, $site_name)
    {
        $query->where('sites.site_name', 'like', "%$site_name%");
    }

    public function getVolData(Request $request, User $user)
    {
        return VolunteerRepo::getUserVolunteers($request, $user);
    }

    public function transferVolModal()
    {
        return view('default.fgp.profile.transfer_supervisor');
    }

    public function transferVols(Request $request, User $user)
    {
        $old = json_encode($user->volunteers->pluck('volunteers.alt_id')->all());
        $existingVols = collect();
        $newVols = is_array($request->input('volunteers')) ? $request->input('volunteers') : false;

        if (!$newVols) {
            return response(['errors' => ['message' => 'No volunteers selected.']], 422);
        }

        $allVols = $existingVols->merge($newVols);
        $allVols = $allVols->unique()->all();
        $user->volunteers()->detach();
        $user->volunteers()->sync($allVols);

        Notification::create(array(
            'table_name' => 'users',
            'table_id' => $user->id,
            'user_id' => auth()->id(),
            'to' => $user->id,
            'message' => 'New Volunteer Assigned',
            'type' => 'Notification',
            'url' => 'userProfile',
            'is_read' => 0,
        ));

        Audit::create(array(
            'table_name' => 'users',
            'table_id' => $user->id,
            'old_record' => $old,
            'new_record' => json_encode($newVols),
            'user_id' => auth()->id(),
        ));

        return response(['message' => 'Volunteers transfered successfully.'], 200);
    }
}
