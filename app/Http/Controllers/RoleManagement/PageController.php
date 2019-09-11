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
use App\Http\Requests\PageRequest;
use App\Models\Page;
use App\Repo\PageRepo;
use Illuminate\Http\Request;

class PageController extends BaseController
{
    private static $repo=null;

    protected $clayout="";
    public function __construct()
    {
        parent::__construct();
        $this->clayout=$this->layout.'.pages.roleManagement.pages';
        $this->middleware(function($req, $next) {
            $user = $req->user();
            if (!$user || !in_array($user->role_id, [1,2,7])) {
                exit;
            }
            return $next($req);
        })->only('getAction');
    }

    /**
     * @param $model
     * @return PageRepo|null
     */
    private static function getInstance($model)
    {
        if(self::$repo==null)
            self::$repo=new PageRepo($model);
        return self::$repo;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function all(Request $request)
    {
        return self::getInstance('Page')->selectDataTable($request);
    }

    public function getAction(Page $page)
    {
        $action=$page->action;
        return response()->json(explode('|',$action));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view($this->clayout.'.modal.add');
    }

    /**
     * @param Page $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Page $page)
    {
        return view($this->clayout.'.modal.edit',compact('page'));
    }

    public function delete(Page $page)
    {
        return view($this->clayout.'.modal.delete',compact('page'));
    }

    public function store(PageRequest $request)
    {
        $res=self::getInstance('Page')->saveUpdate($request);
        if($res)
            return $this->response("Page added successFully","view",200);
        else
            return $this->response("Can't add page",'view',422);
    }

    public function update(PageRequest $request,Page $page)
    {
        $res=self::getInstance($page)->saveUpdate($request);

        if($res)
            return $this->response("Page updated successFully","view",200);
        else
            return $this->response("Can't update page",'view',422);
    }

    public function destroy(Page $page)
    {
        $res=self::getInstance($page)->softDelete();

        if($res)
            return $this->response("Page deleted successFully","view",200);
        else
            return $this->response("Can't delete page",'view',422);
    }
}