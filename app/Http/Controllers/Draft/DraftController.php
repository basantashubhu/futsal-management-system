<?php


namespace App\Http\Controllers\Draft;


use App\Http\Controllers\BaseController;
use App\Models\Draft;
use App\Repo\DraftRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DraftController extends BaseController
{
    private static $repo;
    private $clayout;

    /**
     * DraftController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->clayout=$this->layout.'.pages.draft';
    }

    /**
     * @param $target
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function saveConfirm($target)
    {
        return view($this->clayout.'.modal.saveConfirm',compact('target'));
    }

    /**
     * @param $model
     * @return DraftRepo
     */
    public static function getInstance($model)
    {
        self::$repo=new DraftRepo($model);
        return self::$repo;
    }

    /**
     * @param Request $request
     * @param $target
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request,$target)
    {
        $formData=$request->all();

        $data['data']=json_encode($formData);
        $data['section_name']=$target;
        $this->checkNoOfDraft($target);
        $res=self::getInstance('Draft')->saveUpdate($data);
        if($res)
            return $this->response('Application Save to Draft','view',200);
        else
            return $this->response('Sorry Failed to Save Draft','view',500);
    }

    public function  checkNoOfDraft($target)
    {
        $draft=Draft::where([
            ['is_deleted',0],
            ['section_name',$target],
            ['userc_id',Auth::id()]
        ]);
        $count=$draft->count();
        if($count==5)
        {
            $draft=$draft->first();
            self::getInstance($draft)->softDelete();
        }
    }
    /**
     * @param $target
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function load($target)
    {
        $drafts=Draft::where('section_name',$target)->where('is_deleted',0)->where('userc_id',Auth::id())->orderBy('created_at','Desc')->get();
        return view($this->clayout.'.modal.loadDraft',compact('drafts','target'));
    }

    /**
     * @param Draft $draft
     * @return Draft
     */
    public function getById(Draft $draft)
    {
        return response()->json(['draft'=>json_decode($draft->data),'class'=>$draft->section_name],200);
    }
}