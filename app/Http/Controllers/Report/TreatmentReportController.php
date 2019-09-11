<?php


namespace app\Http\Controllers\Report;


use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TreatmentReportController extends BaseController
{
    private $clayout;

    public function __construct()
    {
        parent::__construct();
        $this->clayout = $this->layout . '.pages.reports.treatment.';
    }

    public function index(Request $request)
    {
        $range = null;
        $dateRange = $request->dateRange;
        if ($request->has('dateRange') && $request->dateRange != '')
            $range = explode('-', $request->dateRange);

        $totalSurgery = $this->totalSurgeryByProvider($range);
        $totalRabies = $this->totalRabiesByProvider($range);
        return view($this->clayout . 'index', compact('dateRange', 'totalSurgery', 'totalRabies'));
    }

    private function totalProviderQuery($range, $total = false)
    {
        $condition = "1=1";
        $condition = '(applications.status="Approved" OR is_provider_view=1)';
        if (!is_null($range)) {
            $start = date('Y-m-d 00:00:00', strtotime($range[0]));
            $end = date('Y-m-d 23:29:29', strtotime($range[1]));
            $condition .= " AND app_pet_treatment.created_at >= '$start' AND app_pet_treatment.created_at <= '$end'";
        }

        $selectQ = 'organization.cname';
        if ($total)
            $selectQ = DB::raw('"Total" as cname');


        $query = DB::table('organization')
            ->leftJoin('application_pet', 'organization.id', 'application_pet.provider_id')
            ->leftJoin('app_pet_treatment', 'app_pet_treatment.pet_id', 'application_pet.pet_id')
            ->leftJoin('applications', 'applications.id', 'application_pet.application_id')
            ->leftJoin('treatments', 'app_pet_treatment.treatment_id', 'treatments.id')
            ->leftJoin('pets', 'pets.id', 'application_pet.pet_id')
            ->select($selectQ,
                DB::raw("COUNT(IF(LOWER(species)='dog' AND $condition,species,NULL)) AS dog_applied"),
                DB::raw("COUNT(IF(LOWER(species)='dog' AND 
                                        NOT ISNULL(app_pet_treatment.treatment_date) 
                                           AND $condition,species,NULL)) AS dog_performed"),
                DB::raw("COUNT(IF(LOWER(species)='cat' AND $condition,species,NULL)) AS cat_applied"),
                DB::raw("COUNT(IF(LOWER(species)='cat' AND
                            NOT ISNULL(app_pet_treatment.treatment_date) 
                            AND $condition,species,NULL)) AS cat_performed"),
                DB::raw("COUNT(IF($condition,application_pet.provider_id,NULL)) AS total_applied"),
                DB::raw("COUNT(IF(NOT ISNULL(app_pet_treatment.treatment_date) 
                            AND $condition,species,NULL)) AS total_performed")
            )->where('organization.is_approved', 1);

        return $query;
    }


    public function totalSurgeryByProvider($range)
    {

        $result1 = $this->totalProviderQuery($range, true)
            ->where('treatments.treatment_name', 'surgery')
            ->orderBy('cname', 'ASC');

        $result = $this->totalProviderQuery($range)
            ->where('treatments.treatment_name', 'surgery')
            ->orderBy('cname', 'ASC')
            ->groupBy('application_pet.provider_id');

        return $result->union($result1)->get();
    }

    public function totalRabiesByProvider($range)
    {

        $result1 = $this->totalProviderQuery($range, true)
            ->whereRaw('lower(treatments.treatment_name)="rabbies"')
            ->orderBy('cname', 'ASC');

        $result = $this->totalProviderQuery($range)
            ->whereRaw('lower(treatments.treatment_name)="rabbies"')
            ->orderBy('cname', 'ASC')
            ->groupBy('application_pet.provider_id');

        return $result->union($result1)->get();
    }


    public function getRabiesChart(Request $request)
    {
        $range = null;
        $dateRange = $request->dateRange;
        if ($request->has('dateRange') && $request->dateRange != '')
            $range = explode('-', $request->dateRange);

        $data = $this->totalRabiesByProvider($range);
        return $this->chartDataFormatter($data);
    }


    public function getSurgeryChart(Request $request)
    {
        $range = null;
        $dateRange = $request->dateRange;
        if ($request->has('dateRange') && $request->dateRange != '')
            $range = explode('-', $request->dateRange);

        $data = $this->totalSurgeryByProvider($range);
        return $this->chartDataFormatter($data);
    }

    private function chartDataFormatter($data)
    {
        $providerLabel = array();
        $dogApplied = array();
        $dogPerformed = array();
        $catApplied = array();
        $catPerformed = array();
        foreach ($data as $d) {
            if (strtolower($d->cname) != 'total') {
                array_push($providerLabel, $d->cname);
                array_push($dogApplied, $d->dog_applied);
                array_push($dogPerformed, $d->dog_performed);
                array_push($catApplied, $d->cat_applied);
                array_push($catPerformed, $d->cat_performed);
            }
        }
        $formatted = array(
            'label' => $providerLabel,
            'dogApplied' => $dogApplied,
            'dogPerformed' => $dogPerformed,
            'catApplied' => $catApplied,
            'catPerformed' => $catPerformed,
        );
        return response()->json($formatted);
    }
}