<?php


namespace App\Http\Controllers\Report;


use App\Http\Controllers\BaseController;
use App\Http\Controllers\Settings\LookupsController;
use App\Models\Support;
use App\Models\User;
use App\Repo\SupportReportRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupportReportController extends BaseController
{

    /**
     * @var string
     */
    public $clayout;

    /**
     * SupportReportController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->clayout=$this->layout.'.pages.reports.support';
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $users=User::where('is_deleted',0)->get();
        $lookup=new LookupsController();

        $support_types=$lookup->getData('support_type');
        $support_categories=$lookup->getData('support_category');
        $support_departments=$lookup->getData('support_department');

        $data['support']=$this->getSupportData();
        $data['assigned']=$this->getTotal();
        return view($this->clayout.'.index',compact('data','users','support_types','support_categories','support_departments'));
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getData(Request $request)
    {
        $repo=new SupportReportRepo();
        return $repo->selectDataTable($request);
    }


    /**
     * @return array
     */
    public function getSupportData()
    {
        $total=$this->getAssign();
        $open=$this->getOpenSupport();
        $close=$this->getCloseSupport();

        return array(
            'total'=>$total,
            'open'=>$open,
            'close'=>$close
        );
    }

    /**
     * @return int
     */
    public function getAssign()
    {
        return count(DB::table('supports')->join('support_user','support_user.support_id','supports.id')->groupBy('supports.id')->get());
    }


    /**
     * @return int
     */
    public function getOpenSupport()
    {
        $openSupport=count(DB::table('supports')
        ->join('support_user','support_user.support_id','supports.id')
        ->whereNull('end_date')->groupBy('supports.id')->get());
        return $openSupport;
    }

    /**
     * @return int
     */
    public function getCloseSupport()
    {
        $closeSupport=count(DB::table('supports')
            ->join('support_user','support_user.support_id','supports.id')
            ->whereNotNull('end_date')->groupBy('supports.id')->get());
        return $closeSupport;
    }

    /**
     * @return array
     */
    public function getTotal()
    {
        $total=Support::where('is_deleted',0)->count();
        $assigned=$this->getAssign();
        $unassigned=$total-$assigned;

        return array(
            'total'=>$total,
            'assign'=>$assigned,
            'unassigned'=>$unassigned
        );
    }
}