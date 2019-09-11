<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\BaseController;
use App\Models\Application;
use App\Models\ApplicationPet;
use App\Models\ApplicationPetTreatments;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Organization;
use App\Models\Payment;
use App\Models\Pet;
use App\Models\Settings\Lookups;
use App\Repo\ReportRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProviderReportController extends BaseController
{
    private $clayout;
    private static $repo;

    /**
     * ReportController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->clayout = $this->layout . '.pages.reports.provider.';
    }

    public static function getInstance()
    {
        $repo = new ReportRepo('ReportLog');
        return $repo;
    }

    public function index(Request $request)
    {
        $pid = null;
        $dateRange = $request->dateRange;
        $range = null;
        if ($request->has('provider')) {
            $pid = explode(',', $request->provider);
        }

        if ($request->has('dateRange'))
            $range = explode('-', $request->dateRange);

        $status = Lookups::where('code', 'application_status')->where('is_deleted', false)->get();
        $providers = Organization::where('is_deleted', 0)->get();
        $report = $this->reports($pid, $range);
        return view($this->clayout . 'index', compact('report', 'status', 'providers', 'pid', 'dateRange'));
    }

    public function getAll(Request $request)
    {
        return self::getInstance()->selectProviderReport($request);
    }


    protected function reports($pid, $dateRange)
    {
        $report = array();
        $report['total_invoice'] = $this->getInvoiceDetails($pid, $dateRange);
        $report['certificates'] = $this->getCertificateDetails($pid,$dateRange);
        $report['treatments'] = $this->servicePerformed($pid,$dateRange);
        $report['application'] = $this->applicationDetails($pid,$dateRange);
        return $report;
    }

    protected function servicePerformed($pid,$dateRange)
    {

        $treated = DB::table('applications')
            ->join('app_pet_treatment as apt','apt.application_id','applications.id')
            ->join('application_pet as ap', 'apt.application_id', 'ap.application_id')
            ->where(function($query){
                $query->where('applications.status','Approved')->orWhere('is_provider_view',1);
            })->groupBy('apt.id');


        if (is_null($pid) && is_null($dateRange))
        {
            $total = count($treated->get());
            $treated = count($treated->whereNotNull('treatment_date')->get());
        }
        elseif (is_null($pid))
        {
            $start = date('Y-m-d 00:00:00', strtotime($dateRange[0]));
            $end = date('Y-m-d 23:29:29', strtotime($dateRange[1]));

            $total = count($treated->whereBetween('applications.created_at', [$start, $end])->get());
            $treated = count($treated->whereNotNull('treatment_date')->whereBetween('applications.created_at',[$start, $end])->get());

        }
        else
        {
            $total = count($treated->whereIn('ap.provider_id', $pid)->groupBy('applications.id')->get());
            $treated = count($treated->whereNotNull('treatment_date')->whereIn('ap.provider_id', $pid)->get());
        }

        //$treated = count($treated);
        $remain = $total - $treated;
        return array(
            'total' => $total,
            'treated' => $treated,
            'untreated' => $remain
        );
    }

    public function getInvoiceDetails($pid, $dateRange)
    {

        $paid = DB::table('payment')
            ->join('invoice_line_item as item', 'item.inv_id', 'payment.inv_id');

        if (is_null($pid) && is_null($dateRange))
            $total = InvoiceItem::sum('amount_total');
        elseif (is_null($pid)) {
            $start = date('Y-m-d 00:00:00', strtotime($dateRange[0]));
            $end = date('Y-m-d 23:29:29', strtotime($dateRange[1]));

            $total = InvoiceItem::whereBetween('created_at', [$start, $end])->sum('amount_total');
            $paid = $paid->whereBetween('item.created_at', [$start, $end]);
        } else {
            $total = InvoiceItem::whereIn('provider_id', $pid)->sum('amount_total');
            $paid = $paid->whereIn('item.provider_id', $pid);
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

    public function getCertificateDetails($pid, $dateRange)
    {

        $petCount = DB::table('applications')
            ->join('application_pet','applications.id','application_pet.application_id')
            ->join('pets', 'pets.id', 'application_pet.pet_id')
            ->select(DB::raw('count(pets.species) as data'), 'pets.species as label')
            ->where(function($query){
                $query->where('applications.status','Approved')->orWhere('is_provider_view',1);
            })->whereNotNull('pets.species');

        if (is_null($pid) && is_null($dateRange))
            $total = $petCount->count();

        elseif (is_null($pid)) {
            $start = date('Y-m-d 00:00:00', strtotime($dateRange[0]));
            $end = date('Y-m-d 23:29:29', strtotime($dateRange[1]));

            $total = $petCount->whereBetween('applications.created_at', [$start, $end])->count();
            $petCount = $petCount->whereBetween('pets.created_at', [$start, $end]);

        } else {
            $total = $petCount->whereIn('application_pet.provider_id', $pid)->count();
            $petCount = $petCount->whereIn('application_pet.provider_id', $pid);
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

    public function totalPet()
    {
        $total = Pet::count();
        $petCount = DB::table('pets')
            ->select(DB::raw('count(pets.species) as data'), 'pets.species as label')
            ->groupBy('pets.species')->get();
        $data = array('total' => $total);
        foreach ($petCount as $pet):
            $data[$pet->label] = $pet->data;
        endforeach;

        return $data;
    }

    public function applicationDetails($pid,$dateRange)
    {
        $appCount = DB::table('applications')
            ->join('application_pet as ap', 'applications.id', 'ap.application_id')
            ->join('clients', 'clients.id', 'applications.client_id')
            ->select(DB::raw('CASE WHEN clients.org_id IS NOT NULL
	                            THEN count(clients.org_id)
		                    ELSE count(clients.id)
	                END AS data'),
                DB::raw('CASE WHEN clients.org_id IS NOT NULL THEN "NP"
		                ELSE "IE"
	                END AS label'));

        if (is_null($pid))
            $total = Application::where('is_deleted', 0)->where(function($query){
                $query->where('applications.status','Approved')->orWhere('is_provider_view',1);
            })->count();
        else {
            $total = count(ApplicationPet::whereIn('provider_id', $pid)->groupBy('application_id')->get());
            $appCount = $appCount->whereIn('ap.provider_id', $pid);
        }


        if (is_null($pid) && is_null($dateRange))
            $total = Application::where('is_deleted', 0)->where(function($query){
                $query->where('applications.status','Approved')->orWhere('is_provider_view',1);
            })->count();
        elseif (is_null($pid)) {
            $start = date('Y-m-d 00:00:00', strtotime($dateRange[0]));
            $end = date('Y-m-d 23:29:29', strtotime($dateRange[1]));


            $total = count(ApplicationPet::whereBetween('created_at', [$start, $end])->groupBy('application_id')->get());
            $appCount = $appCount->whereBetween('applications.created_at', [$start, $end]);

        } else {
            $total = count(ApplicationPet::whereIn('provider_id', $pid)->groupBy('application_id')->get());
            $appCount = $appCount->whereIn('ap.provider_id', $pid);
        }

        $appCount = $appCount ->where(function($query){
            $query->where('applications.status','Approved')->orWhere('is_provider_view',1);
        })->groupBy('label', 'ap.application_id')->get();


        $data = array('total' => $total);
        foreach ($appCount as $app):
            if (array_key_exists($app->label, $data)) {
                $data[$app->label] = $data[$app->label] + 1;
            } else {
                $data[$app->label] = 1;
            }

        endforeach;

        if (!array_key_exists('IE', $data))
            $data['IE'] = 0;
        if (!array_key_exists('NP', $data))
            $data['NP'] = 0;

        return $data;
    }


}
