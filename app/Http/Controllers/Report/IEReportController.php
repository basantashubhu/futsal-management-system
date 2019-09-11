<?php


namespace App\Http\Controllers\Report;


use App\Http\Controllers\BaseController;
use App\Models\Client;
use App\Models\Payment;
use App\Repo\ApplicationRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IEReportController extends BaseController
{

    private $clayout;
    public function __construct()
    {
        parent::__construct();
        $this->clayout=$this->layout . '.pages.reports.incomeEligible';
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $range=null;
        $dateRange=$request->dateRange;
        if ($request->has('dateRange'))
        {
            $range = explode('-', $request->dateRange);
        }

        if($range==null)
        {
            $range[0]=date('Y-m-d 00:00:00',strtotime('Jan 1'));
            $range[1]=date('Y-m-d 23:59:59',strtotime('Dec 31'));
        }


        $report = $this->reports($range);
        return view($this->clayout . '.index',compact('report','dateRange'));
    }

    protected function reports($dateRange)
    {
        $report = array();
        $report['total_invoice'] = $this->getInvoiceDetails($dateRange);
        $report['certificates'] = $this->getCertificateDetails($dateRange);
        $report['treatments'] = $this->servicePerformed($dateRange);
        $report['copay'] = $this->copayAmount($dateRange);
        return $report;
    }

    protected function servicePerformed($dateRange)
    {

        $treated = DB::table('applications')
            ->join('clients','applications.client_id','clients.id')
            ->join('app_pet_treatment as apt','apt.application_id','applications.id')
            ->join('application_pet as ap', 'apt.application_id', 'ap.application_id')
            ->where(function($query){
                $query->where('applications.status','Approved')->orWhere('is_provider_view',1);
            })->whereNull('clients.org_id')->groupBy('apt.id');


        if ( is_null($dateRange))
        {
            $total = count($treated->get());
            $treated = count($treated->whereNotNull('treatment_date')->get());
        }
        else
        {
            $start = date('Y-m-d 00:00:00', strtotime($dateRange[0]));
            $end = date('Y-m-d 23:29:29', strtotime($dateRange[1]));

            $total = count($treated->whereBetween('clients.created_at', [$start, $end])->get());
            $treated = count($treated->whereNotNull('treatment_date')->whereBetween('clients.created_at',[$start, $end])->get());

        }


        //$treated = count($treated);
        $remain = $total - $treated;
        return array(
            'total' => $total,
            'treated' => $treated,
            'untreated' => $remain
        );
    }

    public function getInvoiceDetails($dateRange)
    {

        $paid = DB::table('payment')
            ->join('invoice_line_item as item', 'item.inv_id', 'payment.inv_id')
            ->join('clients', 'item.client_id', 'clients.id')
            ->whereNull('clients.org_id');

       $total=DB::table('invoice_header as invoice')
            ->join('clients', 'invoice.client_id', 'clients.id')
            ->whereNull('clients.org_id')
            ->where('invoice_status','Approved');

        if (is_null($dateRange))
            $total = $total->sum('invoice_total');
        else {
            $start = date('Y-m-d 00:00:00', strtotime($dateRange[0]));
            $end = date('Y-m-d 23:29:29', strtotime($dateRange[1]));

            $total = $total->whereBetween('clients.created_at', [$start, $end])->sum('invoice_total');
            $paid = $paid->whereBetween('clients.created_at', [$start, $end]);
        }

        $paid = $paid->groupBy('item.inv_id')->distinct()->sum('trans_amount');
        $unpaid = $total - $paid;
        $data = array(
            'total' => $total,
            'paid' => $paid,
            'unpaid' => $unpaid
        );

        return $data;

    }

    public function getCertificateDetails($dateRange)
    {

        $petCount = DB::table('applications')
            ->join('clients','applications.client_id','clients.id')
            ->join('application_pet','applications.id','application_pet.application_id')
            ->join('pets', 'pets.id', 'application_pet.pet_id')
            ->select(DB::raw('count(pets.species) as data'), 'pets.species as label')
            ->where(function($query){
                $query->where('applications.status','Approved')->orWhere('is_provider_view',1);
            })->whereNull('clients.org_id')->whereNull('pets.species');

        if (is_null($dateRange))
            $total = $petCount->count();

        else{
            $start = date('Y-m-d 00:00:00', strtotime($dateRange[0]));
            $end = date('Y-m-d 23:29:29', strtotime($dateRange[1]));

            $total = $petCount->whereBetween('clients.created_at', [$start, $end])->count();
            $petCount = $petCount->whereBetween('pets.created_at', [$start, $end]);
        }
        $petCount = $petCount->groupBy('pets.species')->get();

        $data = array('total' => $total);
        if ($total != 0):
            foreach ($petCount as $pet):
                $data[strtolower($pet->label)] = $pet->data;
            endforeach;
        else:
            $data['dog'] = 0;
            $data['cat'] = 0;
        endif;

        if (!array_key_exists('dog', $data))
            $data['dog'] = 0;
        if (!array_key_exists('cat', $data))
            $data['cat'] = 0;

        return $data;
    }

    public function copayAmount($dateRange)
    {
        $appCount = DB::table('applications')
            ->join('application_pet as ap', 'applications.id', 'ap.application_id')
            ->join('clients', 'clients.id', 'applications.client_id')
            ->whereNull('clients.org_id');

        if (is_null($dateRange))
            $totalCopay = ($appCount->count())*getSiteSettings('copay_amount');
        else {
            $start = date('Y-m-d 00:00:00', strtotime($dateRange[0]));
            $end = date('Y-m-d 23:29:29', strtotime($dateRange[1]));
            $totalCopay = ($appCount->whereBetween('clients.created_at', [$start, $end])->count())*getSiteSettings('copay_amount');
        }

        $paid=Payment::where('trans_type','revenue')->sum('trans_amount');
        $unPaid=$totalCopay-$paid;

        return array(
            'total'=>$totalCopay,
            'paid'=>$paid,
            'unpaid'=>$unPaid
        );
    }

    public function getApplicationByClient(Request $request,Client $client)
    {
        $repo=new ApplicationRepo('application');

        return $repo->getApplicationByClient($request,$client->id);
    }
}