<?php


namespace App\Http\Controllers\RoleManagement;


use App\Http\Controllers\BaseController;

class RoleManagementController extends BaseController
{
    protected $clayout="";
    public function __construct()
    {
        parent::__construct();
        $this->clayout=$this->layout.'.pages.roleManagement';
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view($this->clayout.'.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function pages()
    {
        return view($this->clayout.'.pages.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function role()
    {
        return view($this->clayout.'.role.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function permission()
    {
        return view($this->clayout.'.permission.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function rolePermission()
    {
        return view($this->clayout.'.rolePermission.index');
    }

    public function userPermission()
    {
        return view($this->clayout.'.userPermission.index');
    }

}