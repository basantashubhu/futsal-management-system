<?php


namespace App\Http\Controllers\Report;


use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetReportController extends BaseController
{
    private static $repo;
    private $clayout;
    public function __construct()
    {
        parent::__construct();
        $this->clayout = $this->layout . '.pages.reports.pet.';
    }

    public function index(Request $request)
    {
        $range=null;
        $dateRange=$request->dateRange;
        if($request->has('dateRange') && $request->dateRange!='')
            $range = explode('-', $request->dateRange);

        $totalIE=$this->getPetByIEApplication($range);
        $totalNP=$this->getPetByNPApplication($range);
        $totalProcedure=$this->getPetByProvider($range);
        $totalSurgeryProfit=$this->totalSurgeryBYProfit($range);
        $totalIESurgeryBYProfit=$this->totalIESurgeryBYProfit($range);
        $totalNPSurgeryBYProfit=$this->totalNPSurgeryBYProfit($range);
        return view($this->clayout.'index',compact('totalProcedure','totalIE','totalNP',
            'totalSurgeryProfit','totalIESurgeryBYProfit','totalNPSurgeryBYProfit','dateRange'));
    }

    /**
     * Query for Profit Provider
     *
     */
    private function providerQuery()
    {
        return DB::table('organization')
            ->leftJoin('application_pet', 'organization.id', 'application_pet.provider_id')
            ->leftJoin('pets', 'pets.id', 'application_pet.pet_id');
    }

    /**
     * Query for rest
     */
    private function invQuery()
    {
        return DB::table('organization')
            ->leftJoin('application_pet','organization.id','application_pet.provider_id')
            ->leftJoin('applications','applications.id','application_pet.application_id')
            ->leftJoin('clients','clients.id','applications.client_id')
            ->leftJoin('pets','pets.id','application_pet.pet_id');
    }


    /**
     * data of total pet service provided by All organization
     * @param $range
     * @return \Illuminate\Support\Collection
     */
    public function getPetByProvider($range)
    {
        $condition = '1=1';
        if (!is_null($range)) {
            $start = date('Y-m-d 00:00:00', strtotime($range[0]));
            $end = date('Y-m-d 23:29:29', strtotime($range[1]));
            $condition = "organization.created_at >= '$start' AND organization.created_at <= '$end'";
        }

        $result1 = $this->providerQuery()
            ->select(DB::raw('"total" as cname'),
                DB::raw("COUNT(IF(LOWER(species)='dog' AND $condition,species,NULL)) AS dogs"),
                DB::raw("COUNT(IF(LOWER(species)='cat' AND $condition,species,NULL)) AS cats"),
                DB::raw("COUNT(IF($condition,provider_id,NULL)) AS total")
            )->where('organization.is_approved', 1)
            ->orderBy('cname', 'ASC');


        $result = $this->providerQuery()
            ->select('organization.cname',
                DB::raw("COUNT(IF(LOWER(species)='dog' AND $condition,species,NULL)) AS dogs"),
                DB::raw("COUNT(IF(LOWER(species)='cat' AND $condition,species,NULL)) AS cats"),
                DB::raw("COUNT(IF($condition,provider_id,NULL)) AS total")
            )->where('organization.is_approved', 1)
            ->orderBy('cname', 'ASC')->groupBy('provider_id');


        return $result->union($result1)->get();
    }

    /**
     * data of total pet service provided by IE
     * @param $range
     * @return \Illuminate\Support\Collection
     */
    public function getPetByIEApplication($range)
    {
        $condition='1=1';
        if(!is_null($range))
        {
            $start = date('Y-m-d 00:00:00', strtotime($range[0]));
            $end = date('Y-m-d 23:29:29', strtotime($range[1]));
            $condition="organization.created_at >= '$start' AND organization.created_at <= '$end'";
        }

        $result1=$this->invQuery()
            ->select(
                DB::raw('"total" as cname'),
                DB::raw("COUNT(IF(LOWER(species)='dog' AND $condition AND ISNULL(clients.org_id),species,NULL)) AS dogs"),
                DB::raw("COUNT(IF(LOWER(species)='cat' AND $condition AND ISNULL(clients.org_id),species,NULL)) AS cats"),
                DB::raw("COUNT(IF(ISNULL(clients.org_id) AND $condition, application_pet.provider_id,NULL)) AS total")
            )->where('organization.is_approved',1)
            ->orderBy('cname','ASC');

        $result = $this->invQuery()
            ->select('organization.cname',
                DB::raw("COUNT(IF(LOWER(species)='dog' AND $condition AND ISNULL(clients.org_id),species,NULL)) AS dogs"),
                DB::raw("COUNT(IF(LOWER(species)='cat' AND $condition AND ISNULL(clients.org_id),species,NULL)) AS cats"),
                DB::raw("COUNT(IF(ISNULL(clients.org_id) AND $condition, application_pet.provider_id,NULL)) AS total")
            )->where('organization.is_approved',1)
            ->orderBy('cname','ASC')
            ->groupBy('application_pet.provider_id')->union($result1)->get();

        return $result;
    }

    /**
     * data of total pet service provided by np
     * @param $range
     * @return \Illuminate\Support\Collection
     */
    public function getPetByNPApplication($range)
    {
        $condition='1=1';
        if(!is_null($range))
        {
            $start = date('Y-m-d 00:00:00', strtotime($range[0]));
            $end = date('Y-m-d 23:29:29', strtotime($range[1]));
            $condition="organization.created_at >= '$start' AND organization.created_at <= '$end'";
        }

        $result1 = $this->invQuery()
            ->select(
                DB::raw('"total" as cname'),
                DB::raw("COUNT(IF(LOWER(species)='dog' AND $condition AND NOT ISNULL(clients.org_id),species,NULL)) AS dogs"),
                DB::raw("COUNT(IF(LOWER(species)='cat' AND $condition AND NOT ISNULL(clients.org_id),species,NULL)) AS cats"),
                DB::raw("COUNT(IF(NOT ISNULL(clients.org_id) AND $condition, application_pet.provider_id,NULL)) AS total")
            )->where('organization.is_approved',1)
            ->orderBy('cname','ASC');


        $result = $this->invQuery()
            ->select('organization.cname',
                DB::raw("COUNT(IF(LOWER(species)='dog' AND $condition AND NOT ISNULL(clients.org_id),species,NULL)) AS dogs"),
                DB::raw("COUNT(IF(LOWER(species)='cat' AND $condition AND NOT ISNULL(clients.org_id),species,NULL)) AS cats"),
                DB::raw("COUNT(IF(NOT ISNULL(clients.org_id) AND $condition, application_pet.provider_id,NULL)) AS total")
            )->where('organization.is_approved',1)
            ->orderBy('cname','ASC')
            ->groupBy('application_pet.provider_id')
            ->union($result1)->get();

        return $result;
    }

    /**
     * data of total data at different rate
     * @param $range
     * @return array
     */
    public function totalSurgeryBYProfit($range)
    {
        $condition = '1=1';
        if (!is_null($range)) {
            $start = date('Y-m-d 00:00:00', strtotime($range[0]));
            $end = date('Y-m-d 23:29:29', strtotime($range[1]));
            $condition = "organization.created_at >= '$start' AND organization.created_at <= '$end'";
        }

        $result1 = $this->providerQuery()
            ->select(
                DB::raw("'Total' AS provider_rate"),
                DB::raw("CASE
                            WHEN LOWER(TYPE) = 'service provider'
                            THEN COUNT(IF($condition,TYPE,null))
                           WHEN LOWER(TYPE) = 'non Profit' AND $condition
                            THEN COUNT(IF($condition,TYPE,null))
                          END AS no_surgeries")
            )->where('organization.is_approved', 1)
            ->orderBy('cname', 'ASC');


        $result = $this->providerQuery()
            ->select(
                DB::raw("CASE
                            WHEN LOWER(TYPE) = 'service provider'
                            THEN \"No of Surgeries done at For-Profit Rate\"
                             WHEN LOWER(TYPE) = 'non Profit'
                              THEN \"No of Surgeries done at Non-Profit Rate\"
                          END AS provider_rate"),
                DB::raw("CASE
                            WHEN LOWER(TYPE) = 'service provider'
                            THEN COUNT(IF($condition,TYPE,null))
                           WHEN LOWER(TYPE) = 'non Profit'
                            THEN COUNT(IF($condition,TYPE,null))
                          END AS no_surgeries")
            )->where('organization.is_approved', 1)
            ->orderBy('cname', 'ASC');

        $result=$result->groupBy('type')->union($result1)->get();
        return $this->calculatePercentage($result);
    }

    /**
     * data of total IE at different rate
     * @param $range
     * @return array
     */
    public function totalIESurgeryBYProfit($range)
    {
        $condition = '1=1';
        if (!is_null($range)) {
            $start = date('Y-m-d 00:00:00', strtotime($range[0]));
            $end = date('Y-m-d 23:29:29', strtotime($range[1]));
            $condition = "organization.created_at >= '$start' AND organization.created_at <= '$end'";
        }

        $result1 = $this->invQuery()
            ->select(
                DB::raw("'Total' AS provider_rate"),
                DB::raw("CASE
                            WHEN LOWER(TYPE) = 'service provider'
                            THEN 
                            COUNT(IF($condition AND ISNULL(clients.org_id),type,NULL))
                           WHEN LOWER(TYPE) = 'non Profit'
                            THEN COUNT((IF($condition AND ISNULL(clients.org_id),type,NULL)))
                          END AS no_surgeries")
            )->where('organization.is_approved', 1);


        $result = $this->invQuery()
            ->select(
                DB::raw("CASE
                            WHEN LOWER(TYPE) = 'service provider' 
                            THEN \"No of Surgeries done at For-Profit Rate\"
                             WHEN LOWER(TYPE) = 'non Profit'
                              THEN \"No of Surgeries done at Non-Profit Rate\"
                          END AS provider_rate"),
                DB::raw("CASE
                            WHEN LOWER(TYPE) = 'service provider'
                            THEN   COUNT(IF($condition AND ISNULL(clients.org_id),type,NULL))
                           WHEN LOWER(TYPE) = 'non Profit'
                            THEN   COUNT(IF($condition AND ISNULL(clients.org_id),type,NULL))
                          END AS no_surgeries")
            )->where('organization.is_approved', 1);

        $result= $result->groupBy('type')->union($result1)->get();
        return $this->calculatePercentage($result);
    }

    /**
     * data of total NP at different rate
     * @param $range
     * @return array
     */
    public function totalNPSurgeryBYProfit($range)
    {
        $condition = '1=1';
        if (!is_null($range)) {
            $start = date('Y-m-d 00:00:00', strtotime($range[0]));
            $end = date('Y-m-d 23:29:29', strtotime($range[1]));
            $condition = "organization.created_at >= '$start' AND organization.created_at <= '$end'";
        }

        $result1 = $this->invQuery()
            ->select(
                DB::raw("'Total' AS provider_rate"),
                DB::raw("CASE
                            WHEN LOWER(TYPE) = 'service provider' 
                            THEN 
                            COUNT(IF($condition AND NOT ISNULL(clients.org_id),type,NULL))
                           WHEN LOWER(TYPE) = 'non Profit' 
                            THEN COUNT((IF($condition AND NOT ISNULL(clients.org_id),type,NULL)))
                          END AS no_surgeries")
            )->where('organization.is_approved', 1);


        $result = $this->invQuery()
            ->select(
                DB::raw("CASE
                            WHEN LOWER(TYPE) = 'service provider' 
                            THEN \"No of Surgeries done at For-Profit Rate\"
                             WHEN LOWER(TYPE) = 'non Profit'
                              THEN \"No of Surgeries done at Non-Profit Rate\"
                          END AS provider_rate"),
                DB::raw("CASE
                            WHEN LOWER(TYPE) = 'service provider'
                            THEN   COUNT(IF($condition AND NOT ISNULL(clients.org_id),type,NULL))
                           WHEN LOWER(TYPE) = 'non Profit'
                            THEN   COUNT(IF($condition AND NOT ISNULL(clients.org_id),type,NULL))
                          END AS no_surgeries")
            )->where('organization.is_approved', 1);

        $result=$result->groupBy('type')->union($result1)->get();
        return $this->calculatePercentage($result);
    }

    /**
     * common function for calculating the percentage
     * @param $data
     * @return array
     */
    public function calculatePercentage($data)
    {
        $total=end($data);
        $total=end($total);

        $dataList=array();
        foreach($data as $d)
        {
            if($total->no_surgeries!=0)
                $percentage=($d->no_surgeries/$total->no_surgeries)*100;
            else
                $percentage=0;
            $d->percentage=round($percentage,2);
            array_push($dataList,$d);
        }
        return $dataList;
    }


    /**
     * chart data for total surgery
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function totalSurgeryChartData(Request $request)
    {
        $range=null;
         if($request->has('dateRange') && $request->dateRange!='')
            $range = explode('-', $request->dateRange);

        $result=$this->totalSurgeryBYProfit($range);

        return $this->chartData($result);
    }

    /**
     * chart data for IE
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function ieSurgeryChartData(Request $request)
    {
        $range=null;
         if($request->has('dateRange') && $request->dateRange!='')
            $range = explode('-', $request->dateRange);

        $result=$this->totalIESurgeryBYProfit($range);


        return $this->chartData($result);
    }

    /**
     * chart data for Np
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function npSurgeryChartData(Request $request)
    {
        $range=null;
         if($request->has('dateRange') && $request->dateRange!='')
            $range = explode('-', $request->dateRange);

        $result=$this->totalNPSurgeryBYProfit($range);

        return $this->chartData($result);
    }

    /**
     * Process the data in chart.js format
     * @param $result
     * @return \Illuminate\Http\JsonResponse
     */
    private function chartData($result)
    {
        $label=array();
        $data=array();
        foreach ($result as $res)
        {
            if(strtolower($res->provider_rate)!='total' && !is_null($res->provider_rate))
            {
                array_push($label,$res->provider_rate);
                array_push($data,$res->percentage);
            }
        }

        return response()->json(['label'=>$label,'data'=>$data]);
    }
}