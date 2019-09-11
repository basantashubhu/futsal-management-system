<?php


namespace App\Http\Controllers\RoleManagement;


use App\Http\Controllers\BaseController;
use App\Models\Role;
use App\Models\User;
use App\Repo\UserPermissionRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserPermissionController extends BaseController
{
    private static $repo = null;

    protected $clayout = "";

    public function __construct()
    {
        parent::__construct();
        $this->clayout = $this->layout . '.pages.roleManagement.userPermission';
    }


    /**
     * @return UserPermissionRepo|null
     */
    private static function getInstance($model)
    {
        if (self::$repo == null)
            self::$repo = new UserPermissionRepo($model);
        return self::$repo;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function all(Request $request)
    {
        return self::getInstance('UserPermission')->selectDataTable($request);
    }

    public function create()
    {
        $users = User::where('is_deleted', 0)->where('id', '!=', 1)->get();
        return view($this->clayout . '.modal.add', compact('users'));
    }

    public function edit(User $user)
    {
        $users = User::where('is_deleted', 0)->where('id', '!=', 1)->get();

        //geting All Pivot Data
        $data=self::getInstance('UserPermission')->selectRolePermission($user->id);

        return view($this->clayout . '.modal.edit', compact('users','data'));
    }

    public function store(Request $request)
    {
        $res=self::getInstance('UserPermission')->saveUpdate($request);
        if($res)
            return $this->response("Permission assigned successFully","view",200);
        else
            return $this->response("Can't assign role",'view',422);
    }

    public function update(Request $request,User $user)
    {
        //delete old data
        self::getInstance('UserPermission')->delete($request->user_id);
        DB::beginTransaction();
        try{
            //Insert updated one
            $res=self::getInstance('UserPermission')->saveUpdate($request);
            if($res)
            {
                DB::commit();
                return $this->response("Permission updated successFully","view",200);
            }
            else
                throw new \Exception("Can't update permission");
        }
        catch (\Exception $e)
        {
            DB::rollback();
            return $this->response("Can't update permission",'view',422);
        }

    }

}