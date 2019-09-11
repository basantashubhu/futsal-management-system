<?php


namespace App\Http\Controllers\Report;


use App\Http\Controllers\BaseController;
use App\Models\Budget;
use App\Models\InvoiceItem;
use App\Models\Payment;
use App\Repo\RevenueReportRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RevenueReportController extends BaseController
{

    private static $repo;
    private $clayout;

    /**
     * RevenueReportController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->clayout=$this->layout.'.pages.reports.revenueReport.';
    }

    /**
     * @param $model
     * @return RevenueReportRepo
     */
    public static function getInstance($model)
    {
        if(self::$repo==null)
            self::$repo=new RevenueReportRepo($model);
        return self::$repo;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $fundStanding=$this->revenueData();
        $rabiesData=$this->getRabiesData(true);
        $surgeryData=$this->getSurgeryData(true);
        $fundActivity=$this->fundActivity();
        return view($this->clayout.'index',compact('fundStanding','fundActivity','surgeryData','rabiesData'));
    }

    /**
     * @return array
     */
    public function revenueData($dateRange=null)
    {
        $start=date('Y-m-d',strtotime('First day of january'));
        $end=date('Y-m-d',strtotime('last day of december'));
        if($dateRange)
        {
            $range=explode('-',$dateRange);
            $start=date('Y-m-d',strtotime($range[0]));
            $end=date('Y-m-d',strtotime($range[1]));
        }

        $total=Budget::where('table_name','govt')->first()->dr_amount;
        $ieTotal=Budget::select(DB::raw("SUM(cr_amount)-SUM(dr_amount) as amt"))
            ->where('table_name','!=','govt')
            ->where('type','IE')
            ->whereBetween('budget_date',[$start,$end])
            ->pluck('amt')->first();
        $npTotal=Budget::select(DB::raw("SUM(cr_amount)-SUM(dr_amount) as amt"))
            ->where('table_name','!=','govt')
            ->where('type','NP')
            ->whereBetween('budget_date',[$start,$end])
            ->pluck('amt')->first();

        $remaining=$this->getRemaining($total,$ieTotal,$npTotal);

        return array(
            'Starting balance'=>$total,
            'NP Total Contingent'=>$npTotal,
            'IE Total Contingent'=>$ieTotal,
            'Remaining Balance'=>$remaining,
        );
    }

    /**
     * @param $total
     * @param $ieTotal
     * @param $npTotal
     * @return mixed
     */
    public function getRemaining($total,$ieTotal,$npTotal)
    {
        $remaining=$total-($ieTotal+$npTotal);
        if($remaining<0)
            return ($remaining*-1);
        return $remaining;
    }


    /**
     * @return mixed
     */
    public function getIeTotal()
    {
        return DB::table('payment')->
            join('applications',function ($join){
            $join->on('payment.table_id', '=', 'applications.id');
            $join->on('payment.table_name', '=', DB::raw('"applications"'));
            })
            ->join('clients','applications.client_id','clients.id')
            ->whereNull('clients.org_id')
            ->sum('trans_amount');
    }

    /**
     * @return mixed
     */
    public function getNpTotal()
    {
        return DB::table('payment')->
        join('applications',function ($join){
            $join->on('payment.table_id', '=', 'applications.id');
            $join->on('payment.table_name', '=', DB::raw('"applications"'));
        })
            ->join('clients','applications.client_id','clients.id')
            ->whereNotNull('clients.org_id')
            ->sum('trans_amount');
    }

    /**
     * @return array
     */
    public function revenueTotalChart(Request $request)
    {
        $dateRange=$request->dateRange;

        $start=date('Y-m-d',strtotime('First day of january'));
        $end=date('Y-m-d',strtotime('last day of december'));
        if($dateRange)
        {
            $range=explode('-',$dateRange);
            $start=date('Y-m-d',strtotime($range[0]));
            $end=date('Y-m-d',strtotime($range[1]));
        }

        $total=Budget::where('table_name','govt')->first()->dr_amount;
        $ieTotal=Budget::select(DB::raw("SUM(cr_amount)-SUM(dr_amount) as amt"))->where('table_name','!=','govt')->where('type','IE')
            ->whereBetween('budget_date',[$start,$end])
            ->pluck('amt')
            ->first();
        $npTotal=Budget::select(DB::raw("SUM(cr_amount)-SUM(dr_amount) as amt"))
            ->where('table_name','!=','govt')
            ->where('type','NP')
            ->whereBetween('budget_date',[$start,$end])
            ->pluck('amt')
            ->first();

        $remaining=$this->getRemaining($total,$ieTotal,$npTotal);

        return array(
            array(
                'label'=>'NP Total',
                'value'=>$this->neutralizeNegative($npTotal)
            ),array(
                'label'=>'IE Total',
                'value'=>$this->neutralizeNegative($ieTotal)
            ),
            array(
                'label'=>'Remaining',
                'value'=>$this->neutralizeNegative($remaining)
            ),
        );
    }

    /**
     * @return array
     */
    public function fundActivity($dateRange=null)
    {
        $start=date('Y-m-d',strtotime('First day of january'));
        $end=date('Y-m-d',strtotime('last day of december'));
        if($dateRange)
        {
            $range=explode('-',$dateRange);
            $start=date('Y-m-d',strtotime($range[0]));
            $end=date('Y-m-d',strtotime($range[1]));
        }


        $total=Budget::where('table_name','govt')->first()->dr_amount;
        $rabiesSurCharge=$this->getRabiesCharge($start,$end);
        $ieTotal=$this->getIeInvoice($start,$end);
        $npTotal=$this->getNpInvoice($start,$end);
        $copay=$this->getCopay($start,$end);

        return array(
            'Starting Balance'=>$total,
            'Rabies Surcharge Received'=>$rabiesSurCharge,
            'Copay Received'=>$copay,
            'IE Invoiced'=>$ieTotal,
            'NP Invoiced'=>$npTotal,
            'Remaining Balance'=>($total+$rabiesSurCharge+$copay)-($ieTotal+$npTotal),
        );
    }

    /**
     * @return array
     */
    public function fundChartTotalChart(Request $request)
    {
        $dateRange=$request->dateRange;
        $start=date('Y-m-d',strtotime('First day of january'));
        $end=date('Y-m-d',strtotime('last day of december'));
        if($dateRange)
        {
            $range=explode('-',$dateRange);
            $start=date('Y-m-d',strtotime($range[0]));
            $end=date('Y-m-d',strtotime($range[1]));
        }

        return array(
            array(
                'label'=>'Rabies Surcharge',
                'value'=>$this->neutralizeNegative($this->getRabiesCharge($start,$end))
            ),array(
                'label'=>'Copay',
                'value'=>$this->neutralizeNegative($this->getCopay($start,$end))
            ),
            array(
                'label'=>'IE Invoiced',
                'value'=>$this->neutralizeNegative($this->getIeInvoice($start,$end))
            ),
            array(
                'label'=>'NP Invoiced',
                'value'=>$this->neutralizeNegative($this->getNpInvoice($start,$end))
            ),
            array(
                'label'=>'Remaining Balance',
                'value'=>$this->neutralizeNegative($this->getRemainingFundActivity($start,$end))
            ),
        );
    }

    public function getIeInvoice($start,$end)
    {
        return DB::table('invoice_line_item as item')
            ->join('clients','item.client_id','clients.id')
            ->whereNull('clients.org_id')
            ->whereBetween('service_date',[$start,$end])
            ->sum('amount_total');
    }

    public function getNpInvoice($start,$end)
    {
        return DB::table('invoice_line_item as item')
            ->join('clients','item.client_id','clients.id')
            ->whereNotNull('clients.org_id')
            ->whereBetween('service_date',[$start,$end])
            ->sum('amount_total');
    }

    public function getRemainingFundActivity($start,$end)
    {
        $total=Budget::where('table_name','govt')->first()->dr_amount;
        $ieTotal=$this->getIeInvoice($start,$end);
        $npTotal=$this->getNpInvoice($start,$end);
        $rabies=$this->getRabiesCharge($start,$end);
        $copay=$this->getCopay($start,$end);
        $remaining = ($total+$rabies+$copay)-($ieTotal+$npTotal);
        if($remaining<0)
            return (float)$remaining*(-1);
        else
            return $remaining;

    }

    public function getCopay($start,$end)
    {
        return Payment::where('trans_type','revenue')
            ->whereBetween('trans_date',[$start,$end])
            ->sum('trans_amount');
    }

    public function getRabiesCharge($start,$end)
    {
        $amt=InvoiceItem::where('service_description','like','%Rabbies%')
            ->whereBetween('service_date',[$start,$end])
            ->count();
        $rabbiesSurcharge=getSiteSettings('rabies_surcharge_amount')?getSiteSettings('rabies_surcharge_amount'):3;
        return $amt*$rabbiesSurcharge;

    }

    public function getRabiesData($src=false)
    {
        $data=DB::table('applications')
            ->join('application_pet as ap','ap.application_id','applications.id')
            ->join('app_pet_treatment as apt','apt.pet_id','ap.pet_id')
            ->join('treatments','treatments.id','apt.treatment_id')
            ->join('organization','ap.provider_id','organization.id')
            ->whereNotNull('apt.treatment_date')
            ->where('treatment_name','like','%Rabbies%')
            ->select(
                DB::raw('COUNT(IF(`organization`.`type` = "Non Profit",ap.pet_id,NULL)) AS NP'),
                DB::raw('COUNT(IF(`organization`.`type` = "Service Provider",ap.pet_id,NULL)) AS IE'),
                DB::raw('Year(application_date) as date')
            )->groupBy(DB::raw('Year(application_date)'))->orderBy('date','asc')->get();

        if($src)
            return $data;

        $yrs=[];
        $ie=[];
        $np=[];

        foreach ($data as $d)
        {
            array_push($yrs,$d->date);
            array_push($ie,$d->IE);
            array_push($np,$d->NP);
        }

        $report['date']=$yrs;
        $report['ie']=$ie;
        $report['np']=$np;

        return $report;
    }

    public function getSurgeryData($src=false)
    {
        $data=DB::table('applications')
            ->join('application_pet as ap','ap.application_id','applications.id')
            ->join('app_pet_treatment as apt','apt.pet_id','ap.pet_id')
            ->join('treatments','treatments.id','apt.treatment_id')
            ->join('organization','ap.provider_id','organization.id')
            ->whereNotNull('apt.treatment_date')
            ->where('treatment_name','like','%Surgery%')
            ->select(
                DB::raw('COUNT(IF(`organization`.`type` = "Non Profit",ap.pet_id,NULL)) AS NP'),
                DB::raw('COUNT(IF(`organization`.`type` = "Service Provider",ap.pet_id,NULL)) AS IE'),
                DB::raw('Year(application_date) as date')
            )->groupBy(DB::raw('Year(application_date)'))->orderBy('date','asc')->get();

        if($src)
            return $data;

        $yrs=[];
        $ie=[];
        $np=[];
        foreach ($data as $d)
        {
            array_push($yrs,$d->date);
            array_push($ie,$d->IE);
            array_push($np,$d->NP);
        }

        $report['date']=$yrs;
        $report['ie']=$ie;
        $report['np']=$np;

        return $report;
    }

    /**
     * For FundStanding DateFilter
     */
    public function getFundStanding(Request $request)
    {
        $dateRange=$request->dateRange;
        $fundStanding=$this->revenueData($dateRange);
        return view($this->clayout.'include.partials.fundStanding',compact('fundStanding','dateRange'));
    }

    public function getFundActivity(Request $request)
    {
        $dateRange=$request->dateRange;
        $fundActivity=$this->fundActivity($dateRange);
        return view($this->clayout.'include.partials.fundActivity',compact('fundActivity','dateRange'));
    }

    public function neutralizeNegative($val)
    {
        if(is_null($val))
            return 0;
        elseif($val<0)
            return $val*(-1);
        else
            return $val;
    }
}