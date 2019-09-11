?php

namespace App\Http\Controllers\Fgp\Lookup;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\LookupRequest;
use App\Models\Member;
use App\Models\Settings\Lookups;
use App\Models\User;
use App\Repo\LookupRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LookupController extends BaseController
{
    private static $repo = null;
    private $clayout = "";

    public function __construct()
    {
        parent::__construct();
        $this->clayout = $this->layout . '.pages.settings.lookups';
    }

    /**
     * @param $model
     * @return LookupRepo|null
     */
    private static function getInstance($model)
    {
        if (self::$repo == null)
            self::$repo = new LookupRepo($model);
        return self::$repo;
    }

    public function list(Request $request) {
        $selectCol = $request->has('lookupview') ? 'value' : 'text';
        return Lookups::select('section as '. $selectCol, 'id')->groupBy('section')
            ->when($request->term, function($query) use($request){
                $query->where('section', 'like', '%'. $request->term .'%');
            })->get();
    }

    public function volunterDetail(Request $request) {
        $input = $request->input('formdata', array());
        $codes = array();
        foreach ($input as $key => $value) {
            $codes[] = $value['value'];
        }
        return Lookups::where('code', 'volunteer_details')
            ->select('value as text', 'id','datatype as data_type', 'has_lookup')
            ->when($request->term, function($query) use($request){
                $query->where('value', 'like', '%'. $request->term .'%');
            })
            ->whereNotIn('value', $codes)
            ->get();
    }

    public function fetchChildLookups(Request $request){
        $value_code = str_replace('"','',str_replace(' ', '_',mb_strtolower(request()->value)));
        return Lookups::where('code', $value_code)
            ->select('value as text', 'id')
            ->when($request->term, function($query) use($request){
                $query->where('value', 'like', '%'. $request->term .'%');
            })
            ->get();
    }

    public function fetchSupervisors(Request $request){
        return User::select('name as text', 'id')
                ->when($request->term, function($query) use($request){
                    $query->where('name', 'like', '%'. $request->term .'%');
                })
            ->get();
    }

    public function reportingMgr(Request $request){
        $users = User::when($request->input('term', false), function($query, $term) {
            $query->whereHas('member', function($query) use($term){
                $query->where(DB::raw('CONCAT(first_name, " ", last_name)'), 'like', "%$term%");
            });
        })->with('member')->get();
//        dd($users);
        $data = [];
        foreach ($users as $user):
            if ($m = $user->member) {
                array_push($data, ['id' => $user->id, 'text' => implode(' ', [
                    $m->first_name, $m->last_name,
                    $user->role?'('. $user->role->label .')':''
                ])]);
            }
        endforeach;
            return $data;
        /*return User::select(DB::raw('CONCAT(first_name, " ", last_name) as text'), 'users.id')
        ->leftjoin('members', 'users.id', 'members.user_id')
            ->
            ->get();*/
    }
}
