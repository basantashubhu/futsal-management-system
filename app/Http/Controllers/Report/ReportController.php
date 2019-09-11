<?php


namespace App\Http\Controllers\Report;


use App\Http\Controllers\BaseController;
use App\Lib\Exporter\CSVExporter;
use App\Lib\Exporter\JSONExporter;
use App\Lib\Exporter\PDFExporter;
use App\Models\Budget;
use App\Models\ReportLog;
use App\Repo\ApplicationRepo;
use App\Repo\BudgetRepo;
use App\Repo\PetRepo;
use App\Repo\ReportRepo;
use App\Repo\SupportReportRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends BaseController
{
    private $clayout;
    private static $repo;

    /**
     * ReportController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->clayout = $this->layout . '.pages.reports';
    }

    public static function getInstance($model = 'ReportLog')
    {
        $repo = new ReportRepo($model);
        return $repo;
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function advSearch()
    {
        return view($this->clayout . '.incomeEligible.modal.advSearch');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getReport(Request $request)
    {
        $repo = self::getInstance();
        $data = $repo->selectReport($request);
        return response()->json($data);

    }

    public function getPostMail(Request $request)
    {
        $repo = self::getInstance();
        $data = $repo->selectPostMailList($request);
        return response()->json($data);
    }

    public function getReportLog(Request $request, $target)
    {
        if ($target == "Account Summary")
            $target = 'statement';
        $target = str_replace(" ", "_", $target);
        return self::getInstance()->selectDataTable($request, $target);
    }

    /**
     * Data for Pet Type Report
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPetReport()
    {
        $repo = self::getInstance();
        $data = $repo->selectPetReport();
        return response()->json($data);
    }

    public function getClientReport()
    {
        $repo = self::getInstance();
        $data = $repo->selectClientReport();
        return response()->json($data);
    }

    private function generate($format, $field, $data, $fileName, $mode = '')
    {

        switch (strtolower($format)) {
            case 'csv':
                unset($data['table']);
                return CSVExporter::arrayToCSV($field, $data, $fileName);
                break;
            case 'json':
                unset($data['request']);
                unset($data['table']);
                return JSONExporter::jsonExport($data, $fileName);
                break;
            case 'pdf':
                return PDFExporter::pdfExport($field, $data, $fileName, $mode);
                break;
            default:
                return false;
        }
    }

    /**
     * remove the extra data and make order
     * @param $mapField
     * @param $data
     * @return array
     */
    private function cleaner($mapField, $data)
    {
        $dataArr = [];
        foreach ($data as $d) {
            $singleRow = [];
            foreach ($mapField as $map) {
                if (array_key_exists($map, $d)) ;
                $singleRow[$map] = $d->$map;
            }
            array_push($dataArr, $singleRow);
        }
        return $dataArr;

    }

    /**
     * generate Ledger Statement
     * @param Request $request
     * @param $format
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function generateStatement(Request $request, $format, $return = false)
    {
        $repo = self::getInstance();
        try {
            // dd($request->all());
            $data = $repo->selectStatementReport($request);
            $field = array('Transaction Date', 'Provider', 'Type', 'City', 'Reference', 'Invoice No', 'Voucher No', 'Dr Amount', 'Cr Amount', 'Balance');
            if (getSiteSettings('batch_invoice_show') == 'True')
                $mapField = array('created_at', 'cname', 'type', 'city', 'ref_type', 'batch_no', 'voucher_no', 'dr_amount', 'cr_amount', 'balance');
            else
                $mapField = array('created_at', 'cname', 'type', 'city', 'ref_type', 'invoice_id', 'voucher_no', 'dr_amount', 'cr_amount', 'balance');

            $data = $this->cleaner($mapField, $data);

            $data = $this->calculateStatementTotal($data);
            if ($request->has('city')):
                $data['request'] = ['Provider' => $request->providerId, 'Date Range' => $request->dateRange, 'Type' => $request->type, 'City' => $request->city];
            else:
                $data['request'] = ['Date Range' => $request->dateRange];
            endif;
            $data['table'] = 'Showing Results of Statement';

            $fileName = $this->generate($format, $field, $data, 'statement', 'landscape');

            if ($return)
                return $fileName;

            if ($fileName != 0)
                $this->storeReportLog('statement', $fileName);

            return $this->response('Statement Report Generated Successfully', 'view', 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->response($e->getMessage(), 'view', 500);
        }
    }

    /**
     * @param $data
     * @return mixed
     */
    public function calculateStatementTotal($data)
    {
        $drTotal = 0;
        $crTotal = 0;
        foreach ($data as $d) {
            $drTotal += $d['dr_amount'];
            $crTotal += $d['cr_amount'];
        }

        $d = array(
            "created_at" => null,
            "cname" => null,
            "type" => null,
            "city" => null,
            "ref_type" => null,
            "invoice_id" => null,
            "voucher_no" => "Total",
            "dr_amount" => $drTotal,
            "cr_amount" => $crTotal,
            "balance" => $drTotal - $crTotal,
        );
        array_push($data, $d);
        return $data;
    }

    /**
     *
     * @param Request $request
     * @param $format
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function generateProvider(Request $request, $format, $return = false)
    {
        $repo = self::getInstance();
        DB::beginTransaction();
        try {

            $data = $repo->selectProviderReport($request);
            $data = $data['data'];
            $field = array('Service Provider', 'Type', 'Owner Name', 'AppId', 'Total Pets', 'Copay', 'Invoice Amt.', 'Status');
            $mapField = array('service_provider', 'type', 'client_name', 'id', 'no_of_pet', 'copay', 'inv_amt', 'status');
            $data = $this->cleaner($mapField, $data);
            $data = $this->calculateProviderTotal($data);
            if ($request->has('city') || $request->has('zip')):
                $data['request'] = ['Provider' => $request->providerId, 'Date Range' => $request->dateRange, 'Type' => $request->type, 'City' => $request->city, 'State' => $request->state, 'Zip Code' => $request->zip];
            else:
                $data['request'] = ['Date Range' => $request->dateRange, 'Provider' => $request->providerId,];
            endif;
            $data['table'] = 'Showing Results of Provider Report';
            $fileName = $this->generate($format, $field, $data, 'provider', 'landscape');

            DB::commit();
            if ($return)
                return $fileName;
            if ($fileName)
                $this->storeReportLog('provider', $fileName);
            return $this->response('Provider Report Generated Successfully', 'view', 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->response($e->getMessage(), 'view', 500);
        }
    }

    /**
     * total for provider Report
     * @param $data
     * @return mixed
     */
    public function calculateProviderTotal($data)
    {
        $pet = 0;
        $copay = 0;
        $invoice = 0;

        foreach ($data as $d) {
            $pet += $d['no_of_pet'];
            $copay += $d['copay'];
            $invoice += $d['inv_amt'];
        }

        $d = array(
            "service_provider" => "",
            "type" => "",
            "client_name" => "",
            "id" => 'Total',
            "no_of_pet" => $pet,
            "copay" => $copay,
            "inv_amt" => $invoice,
            "status" => ""
        );
        array_push($data, $d);
        return $data;
    }


    /**
     * @param Request $request
     * @param $format
     * @param bool $return
     * @return $this|bool|\Illuminate\Http\JsonResponse|string
     */
    public function generatePet(Request $request, $format, $return = false)
    {
        $range = null;
        if ($request->has('dateRange') && $request->dateRange != '')
            $range = explode('-', $request->dateRange);

        $data = '';
        $pet = new PetReportController();
        if ($request->has('type')) {
            if ($request->type == 'SP')
                $data = $pet->getPetByIEApplication($range);
            else
                $data = $pet->getPetByNPApplication($range);
        } else {

            $data = $pet->getPetByProvider($range);
        }

        $field = array('Provider', 'Cats', 'Dogs', 'Total');
        $mapField = array('cname', 'cats', 'dogs', 'total');
        $data = $this->cleaner($mapField, $data);
        //$data = $this->calculatePetTotal($data);
        $data['request'] = ['Account Type' => $request->type, 'Date Range' => $request->dateRange];
        $data['table'] = 'Showing Results of Pet Report';
        $fileName = $this->generate($format, $field, $data, 'pet', 'portrait');
        if ($return)
            return $fileName;

        if ($fileName != 0)
            $this->storeReportLog('pet', $fileName);
        return $this->response('Pet Report Generated Successfully', 'view', 200);
    }

    public function calculatePetTotal($data)
    {
        $dog = 0;
        $cat = 0;
        $total = 0;

        foreach ($data as $d) {
            $dog += $d['dogs'];
            $cat += $d['cats'];
            $total += $d['total'];
        }

        $d = array(
            'cname' => 'Total',
            'cats' => $cat,
            'dogs' => $dog,
            'total' => $total
        );

        array_push($data, $d);
        return $data;
    }

    /**
     * @param Request $request
     * @param $format
     * @return $this|\Illuminate\Http\JsonResponse
     */
    public function generateCitizen(Request $request, $format, $return = false)
    {
        $repo = self::getInstance();
        try {
            $data = $repo->selectReport($request);
            $data = $data['data'];
            $field = array('Client', 'Phone', 'City', 'Zip', 'Total Pets', 'No. of Application', 'Total invoice', 'Total Copay');
            $mapField = array('client_name', 'cell_phone', 'city', 'zip_code', 'number_of_pet', 'no_of_application', 'total_invoice', 'paid_copay');
            $data = $this->cleaner($mapField, $data);
            $data = $this->calculateCitizenTotal($data);
            if ($request->has('city') || $request->has('zipCode') || $request->has('state')):
                $data['request'] = ['Date Range' => $request->dateRange, 'City' => $request->city, 'State' => $request->state, 'Zip Code' => $request->zipCode];
            else:
                $data['request'] = ['Date Range' => $request->dateRange];
            endif;
            $data['table'] = 'Showing Results of Citizen Report';
            $fileName = $this->generate($format, $field, $data, 'citizen', 'landscape');
            if ($return)
                return $fileName;

            if ($fileName != 0)
                $this->storeReportLog('citizen', $fileName);
            return $this->response('Citizen Report Generated Successfully', 'view', 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->response($e->getMessage(), 'view', 500);
        }
    }

    /**
     * @param $data
     */
    public function calculateCitizenTotal($data)
    {
        $pet = 0;
        $app = 0;
        $invoice = 0;
        $copay = 0;

        foreach ($data as $d) {
            $pet += $d['number_of_pet'];
            $app += $d['no_of_application'];
            $invoice += $d['total_invoice'];
            $copay += $d['paid_copay'];
        }

        $d = array(
            "client_name" => null,
            "cell_phone" => null,
            "city" => null,
            "zip_code" => "Total",
            "number_of_pet" => $pet,
            "no_of_application" => $app,
            "total_invoice" => $invoice,
            "paid_copay" => $copay
        );
        array_push($data, $d);
        return $data;
    }

    public function generateFundReport(Request $request, $format, $return = false)
    {
        //dd($request->all());
        $repo = new BudgetRepo('Budget');
        try {
            $data = $repo->selectDataTable($request);
            $data = $data['data'];
            $field = array('Date', 'Id', 'User', 'Particulars', 'Account', 'References', 'Reference No', 'Type', 'Received', 'Payment', 'Balance');
            $mapField = array('budget_date', 'alt_id', 'name', 'particulars', 'table_name', 'ref_type', 'ref_no', 'type', 'dr_amount', 'cr_amount', 'balance', 'cname', 'client_name');
            $data = $this->cleaner($mapField, $data);
            $data = $this->calculateFundTotal($data);
            $data['request'] = ['Account Type' => $request->account_type, 'Application Type' => $request->application_type, 'Date Range' => $request->dateRange];
            $data['table'] = 'Showing Results of Fund Management Report';
            $fileName = $this->generate($format, $field, $data, 'fund', 'landscape');
            if ($return)
                return $fileName;

            if ($fileName != 0)
                $this->storeReportLog('fund', $fileName);
            return $this->response('Fund Report Generated Successfully', 'view', 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->response($e->getMessage(), 'view', 500);
        }
    }

    public function calculateFundTotal($data)
    {

        $drTotal = 0;
        $crTotal = 0;
        $balance = 0;

        $items = [];
        foreach ($data as $d) {
            if ($d['table_name'] == 'applications')
                $d['table_name'] = $d['client_name'];
            elseif ($d['table_name'] == 'organization')
                $d['table_name'] = $d['cname'];
            else
                $d['table_name'] = 'Federal Government';
            unset($d['cname']);
            unset($d['client_name']);
            $drTotal += $d['dr_amount'];
            $crTotal += $d['cr_amount'];
            array_push($items, $d);
        }
        $total = Budget::where('table_name', 'govt')->first()->dr_amount;
        $balance = $total + ($drTotal - $crTotal);
        $d = array(
            "budget_date" => null,
            "alt_id" => null,
            "name" => null,
            "particulars" => null,
            "table_name" => null,
            "ref_type" => null,
            "ref_no" => null,
            "type" => "Total",
            "dr_amount" => $drTotal,
            "cr_amount" => $crTotal,
            "balance" => $balance,
        );
        array_push($items, $d);
        return $items;
    }

    private function storeReportLog($report_name, $filename)
    {
        $report = new ReportLog();
        $report->report_type = 'Export';
        $report->report_date = date('Y-m-d');
        $report->report_name = strtolower($report_name);
        $report->file_name = $filename;
        $report->userc_id = Auth::id();
        $report->save();
        return $report;
    }

    /**
     * @param Request $request
     * @param $target
     * @param $format
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function exportReport(Request $request, $target, $format)
    {
        if ($target == 'statement')
            $fileName = $this->generateStatement($request, $format, true);
        elseif ($target == 'provider')
            $fileName = $this->generateProvider($request, $format, true);
        elseif ($target == 'pet')
            $fileName = $this->generatePet($request, $format, true);
        elseif ($target == 'citizen')
            $fileName = $this->generateCitizen($request, $format, true);
        elseif ($target == 'fund')
            $fileName = $this->generateFundReport($request, $format, true);
        elseif ($target == 'support')
            $fileName = $this->generateSupportReport($request, $format);
        else
            return back();

        $filePath = storage_path('reports') . DIRECTORY_SEPARATOR . $fileName;

        if (file_exists($filePath))
            return response()->download($filePath)->deleteFileAfterSend(true);
        else
            return back();
    }

    public function generateSupportReport(Request $request, $format)
    {
        $repo = new SupportReportRepo();
        try {
            $data = $repo->selectDataTable($request);
            $data = $data['data'];
            $field = array('Assign Date', 'Assign From', 'Assign To', 'Total Time', 'Type', 'Category', 'Department', 'status');
            $mapField = array('assigned_date', 'assign_from', 'assign_to', 'total_time', 'support_type', 'support_category', 'support_department', 'status');
            $data = $this->cleaner($mapField, $data);
            if ($request->has('assign_to') || $request->has('assign_from') || $request->has('status') || $request->has('support_type') || $request->has('support_category') || $request->has('support_department')):
                $data['request'] = [
                    'Date Range' => $request->dateRange,
                    'Assign To' => $request->assign_to,
                    'Assign From' => $request->assign_from,
                    'Status' => $request->status,
                    'Support Type' => $request->support_type,
                    'Support Category' => $request->support_category,
                    'Support Department' => $request->support_department,
                ];
            else:
                $data['request'] = ['Date Range' => $request->dateRange];
            endif;
            $data['table'] = 'Showing Results of Support Report';
            $fileName = $this->generate($format, $field, $data, 'support', 'landscape');
            return $fileName;
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->response($e->getMessage(), 'view', 500);
        }
    }

    public function generateNonExpireApplicationReport(Request $request, $format)
    {
        $repo = new PetRepo('Pet');
        try {
            $data = $repo->petExpiration($request);
            $field = array('Date', 'AppID', 'Pet Owner', 'Pet ID', 'Pet Name', 'Breed/color/Traits', 'Service Provider', 'Vet', 'Contingent', 'Expiry Date', 'status');
            $mapField = array('application_date', 'alt_id', 'owner_name', 'pet_id', 'pet_name', 'breed_color', 'service_provider', 'vet_name', 'max_contingent', 'expiry_date', 'status');

            $data = $this->cleaner($mapField, $data);

            if ($request->has('assign_to') || $request->has('assign_from') || $request->has('status') || $request->has('support_type') || $request->has('support_category') || $request->has('support_department')):
                $data['request'] = [
                    'Date Range' => $request->dateRange,
                    'Assign To' => $request->assign_to,
                    'Assign From' => $request->assign_from,
                    'Status' => $request->status,
                    'Support Type' => $request->support_type,
                    'Support Category' => $request->support_category,
                    'Support Department' => $request->support_department,
                ];
            else:
                $data['request'] = ['Expired Date Range' => $request->dateRange];
            endif;
            $data['table'] = 'Showing Results of Non Expired Application Report';

            $fileName = $this->generate($format, $field, $data, 'Non_Expired_Application', 'landscape');

            if ($fileName != 0)
                $this->storeReportLog('Non_Expired_Application', $fileName);
            return $this->response('Statement Report Generated Successfully', 'view', 200);
        } catch (\Exception $e) {
            return $this->response($e->getMessage(), 'view', 500);
        }
    }

    public function generateReportQuery(Request $request, $format)
    {
        $rawQuery = $request->rawQuery;

        $queryArr = explode(' ', trim($rawQuery));
        $queryType = $queryArr[0];
        if (strtolower($queryType) == 'select') {
            $data = DB::select($rawQuery);

            //check if there is data or not
            if (count($data) > 0) {
                $field = array_keys((array)$data[0]);
                try {
                    $data = $this->cleaner($field, $data);
                    $fileName = $this->generate($format, $field, $data, 'rawQuery', 'landscape');

                    if ($fileName)
                        $this->storeReportLog('raw_query', $fileName);

                    return $this->response('Report Generated Successfully', 'view', 200);
                } catch (\Exception $e) {
                    throw  $e;
                }
            }
        } else
            return $this->response('Please Insert Valid Select Query', 'view', 500);
    }


}