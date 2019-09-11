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

namespace App\Http\Controllers\RoleManagement;


use App\Http\Controllers\BaseController;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use App\Repo\RoleRepo;
use Illuminate\Http\Request;

class RoleController extends BaseController
{
    private static $repo=null;

    protected $clayout="";
    public function __construct()
    {
        parent::__construct();
        $this->clayout=$this->layout.'.pages.roleManagement.role';
    }


    private static function getInstance($model)
    {
        if(self::$repo==null)
            self::$repo=new RoleRepo($model);
        return self::$repo;
    }

    public function all(Request $request)
    {
        return self::getInstance('Role')->selectDataTable($request);
    }

    public function create()
    {
        return view($this->clayout.'.modal.add');
    }

    public function edit(Role $role)
    {
        return view($this->clayout.'.modal.edit',compact('role'));
    }

    public function delete(Role $role)
    {
        return view($this->clayout.'.modal.delete',compact('role'));
    }

    /**
     * @param RoleRequest $request
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function store(RoleRequest $request)
    {
        $res=self::getInstance('Role')->saveUpdate($request);
        if($res)
            return $this->response("Role added successFully","view",200);
        else
            return $this->response("Can't add role",'view',422);
    }

    /**
     * @param RoleRequest $request
     * @param Role $role
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function update(RoleRequest $request,Role $role)
    {
        $res=self::getInstance($role)->saveUpdate($request);

        if($res)
            return $this->response("Role updated successFully","view",200);
        else
            return $this->response("Can't update role",'view',422);
    }

    public function destroy(Role $role)
    {
        $res=self::getInstance($role)->softDelete();

        if($res)
            return $this->response("Role deleted successFully","view",200);
        else
            return $this->response("Can't delete role",'view',422);
    }
}