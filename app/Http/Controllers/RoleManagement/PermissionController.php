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
use App\Http\Requests\PermissionRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Repo\PermissionRepo;
use Illuminate\Http\Request;


class PermissionController extends BaseController
{
    private static $repo=null;

    protected $clayout="";
    public function __construct()
    {
        parent::__construct();
        $this->clayout=$this->layout.'.pages.roleManagement.permission';
    }

    /**
     * @param $model
     * @return PermissionRepo|null
     */
    private static function getInstance($model)
    {
        if(self::$repo==null)
            self::$repo=new PermissionRepo($model);
        return self::$repo;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view($this->clayout.'.index');
    }

    public function preview($id)
    {
        $role = Role::find($id);
        return view($this->clayout . '.modal.preview', compact('role'));
    }

    /**
     * @param Request $request
     * @return array
     */
    public function all(Request $request)
    {
        return self::getInstance('Permission')->selectDataTable($request);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $pages=self::getInstance('Page')->select(null,'page_name','id');
        return view($this->clayout.'.modal.add',compact('pages'));
    }

    /**
     * @param Permission $permission
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Permission $permission)
    {
        $pages=self::getInstance('Page')->select(null,'page_name','page_name','id');
        return view($this->clayout.'.modal.edit',compact('pages','permission'));
    }

    public function getPermission()
    {
        return self::getInstance('Permission')->select('name','name','id', 'page_id');
    }

    /**
     * @param Permission $permission
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function delete(Permission $permission)
    {
        return view($this->clayout.'.modal.delete',compact('permission'));
    }


    /**
     * @param PermissionRequest $request
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function store(PermissionRequest $request)
    {
        $formData=$request->all();
        $page_id=$formData['page_id'];
        $name=$formData['name'];

        /*-----------undet page_id and name to get selected action-----*/
        unset($formData['page_id']);
        unset($formData['name']);

        $action="";
        foreach ($formData as $key=>$value)
            $action.=$key."|";

        //creation of data to be inserted
        $data=array(
            'page_id'=>$page_id,
            'name'=>$name,
            'action'=>rtrim($action,'|')
        );

        $res=self::getInstance('Permission')->saveUpdate($data);
        if($res)
            return $this->response("Permission added successFully","view",200);
        else
            return $this->response("Can't add permission",'view',422);
    }

    /**
     * @param PermissionRequest $request
     * @param Permission $permission
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function update(PermissionRequest $request,Permission $permission)
    {
        $formData=$request->all();

        $page_id=$formData['page_id'];
        $name=$formData['name'];

        /*-----------undet page_id and name to get selected action-----*/
        unset($formData['page_id']);
        unset($formData['name']);

        $action="";
        foreach ($formData as $key=>$value)
            $action.=$key."|";

        //creation of data to be inserted
        $data=array(
            'page_id'=>$page_id,
            'name'=>$name,
            'action'=>rtrim($action,'|')
        );

        $res=self::getInstance($permission)->saveUpdate($data);

        if($res)
            return $this->response("Permission updated successFully","view",200);
        else
            return $this->response("Can't update permission",'view',422);
    }

    public function destroy(Permission $permission)
    {
        $res=self::getInstance($permission)->softDelete();

        if($res)
            return $this->response("Permission deleted successFully","view",200);
        else
            return $this->response("Can't delete permission",'view',422);
    }
}