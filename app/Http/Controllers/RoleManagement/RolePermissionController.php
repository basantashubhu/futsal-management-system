<?php


namespace App\Http\Controllers\RoleManagement;


use App\Http\Controllers\BaseController;
use App\Models\Role;
use App\Models\RolePermission;
use App\Repo\RolePermissionRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolePermissionController extends BaseController
{
    private static $repo = null;

    protected $clayout = "";

    public function __construct()
    {
        parent::__construct();
        $this->clayout = $this->layout . '.pages.roleManagement.rolePermission';
    }


    /**
     * @return RolePermissionRepo|null
     */
    private static function getInstance($model)
    {
        if (self::$repo == null)
            self::$repo = new RolePermissionRepo($model);
        return self::$repo;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function all(Request $request)
    {
        return self::getInstance('RolePermission')->selectDataTable($request);
    }

    public function create()
    {
        $roles = Role::where('is_deleted', 0)->where('id', '!=', 1)->get();
        return view($this->clayout . '.modal.add', compact('roles'));
    }

    public function edit(Role $role)
    {
        $roles = Role::where('is_deleted', 0)->where('id', '!=', 1)->get();

        //geting All Pivot Data
        $data=self::getInstance('RolePermission')->selectRolePermission($role->id);

        return view($this->clayout . '.modal.edit', compact('roles','data'));
    }

    public function preview(Role $role)
    {
        // dd($role);
        $roles = Role::where('is_deleted', 0)->where('id', '!=', 1)->get();
        //geting All Pivot Data
        $data=self::getInstance('RolePermission')->selectRolePermission($role->id);

        return view($this->clayout . '.modal.preview', compact('roles','data'));
    }

    public function store(Request $request)
    {
        $res=self::getInstance('RolePermission')->saveUpdate($request);
        if($res)
            return $this->response("Permission assigned successFully","view",200);
        else
            return $this->response("Can't assign role",'view',422);
    }

    public function update(Request $request,Role $role)
    {
        //delete old data
        DB::beginTransaction();
        try{
            self::getInstance('RolePermission')->delete($role->id);
            DB::commit();
            //Insert updated one
            $res=self::getInstance('RolePermission')->saveUpdate($request);
            if($res)
            {

                return $this->response("Permission updated successFully","view",200);
            }
            else
                throw new \Exception($res);
        }
        catch (\Exception $e)
        {
            DB::rollback();
            throw $e;
            return $this->response("Can't assign role",'view',422);
        }

    }



}