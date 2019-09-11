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
 * @create date 2019-04-01 20:46:57
 * @modify date 2019-04-01 20:46:57
 * @desc [description]
 */

namespace App\Http\Controllers\Fgp\Report;

use App\Http\Controllers\BaseController;
use App\Lib\Exporter\CSVExporter;
use App\Lib\Exporter\JSONExporter;
use App\Lib\Exporter\PDFExporter;
use App\Models\Fgp\PayPeriod;
use App\Models\Fgp\ReportLog;
use App\Models\Fgp\Site;
use App\Models\Member;
use App\Repo\Fgp\ReportRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends BaseController
{
    use \App\Traits\ReportGenerator;

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

    public function generateVolunteer(Request $request, $format, $return = false)
    {
        $repo = self::getInstance();
        try {
            $data = $repo->generateVolunteer($request);

            $fields = array(
                'alt_id' => 'Volunteer ID',
                'vol_ssn' => 'SSN',
                'salutation' => 'Salutation',
                'title' => 'Volunteer Title',
                'first_name' => 'First Name',
                'middle_name' => 'Middle Name',
                'last_name' => 'Last Name',
                'add1' => 'Address 1',
                'add2' => 'Address 2',
                'city' => 'City',
                'zip_code' => 'Zip Code',
                'state' => 'State',
                'county' => 'County',
                'supervisor_name' => 'Supervisor',
                'hired_date' => 'Hired Date',
                'tel_phone' => 'Volunteer Telephone Number',
                'cell_phone' => 'Volunteer Cell',
                'email' => 'Volunteer Email',
                'vendor_id' => 'FSF Vendor ID',
            );

            $data = $this->mapData($data, $fields, $format === 'pdf');

            $data['table'] = 'Report of Time Sheets';
            $data['request'] = [
                'Sites' => 'All', 'Supervisors' => 'All', 'County' => 'All',
            ];

            foreach ($request->all() as $key => $v):
                if ($key === 'sites') {
                    $data['request']['Sites'] = Site::whereIn('id', $v)->pluck('site_name')->implode(', ');
                }
                if ($key === 'supervisors') {
                    $data['request']['Supervisors'] = Member::selectRaw('concat(first_name,  " ", last_name) as fullname')->whereIn('user_id', $v)->get()->pluck('fullname')->implode(', ');
                }
                if (in_array($key, ['region', 'county', 'city'])) {
                    $data['request'][ucfirst($key)] = implode(', ', $v);
                }
            endforeach;

            $fileName = $this->generate($format, $fields, $data, 'volunteer_summary', []);

            if ($return) {
                return $fileName;
            }

            if ($fileName) {
                $this->storeReportLog('volunteers', $fileName);
            }

            return $this->response('Volunteer Report Generated Successfully', 'view', 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->response($this->get_full_message($e), 'view', 500);
        }
    }

    public function generateTimeSheet(Request $request, $format, $return = false)
    {
        $repo = self::getInstance();
        try {
            $data = $repo->generateTimeSheet($request);

            $fields = array(
                'stipend_period_no' => 'Period #',
                'st_period' => 'Period DateRaw',
                'date' => 'Schedule Date',
                'vol_name' => 'Volunteer Name',
                'site_name' => 'Site',
                'vol_sup_name' => 'Supervisor',
                'item_name' => 'Item',
                'time_in' => 'Time In',
                'time_out' => 'Time In',
                'break_out' => 'Break Out',
                'break_in' => 'Break In',
                'total_hrs' => 'Total Hours',
                'Food_Service' => 'Meal',
                'Mileage_Reimbursements' => 'Travel',
            );

            $data = $this->mapData($data, $fields, $format == 'pdf');

            $data['table'] = 'Report of Time Sheets';
            $data['request'] = [
                'Periods' => 'All',
                'Sites' => 'All',
            ];

            foreach ($request->all() as $key => $v):
                if ($key == 'period_no') {
                    $data['request']['Periods'] = PayPeriod::selectRaw('concat("Period(",period_no, ") ", date_format(start_date, "%m/%d"), " - ",date_format(end_date, "%m/%d/%y")) as period_date')->whereIn('id', $v)
                        ->get()->pluck('period_date')->all();
                }
                if ($key == 'tsStatus') {
                    $data['request']['Status'] = $v;
                }
                if ($key == 'sites') {
                    $data['request']['Sites'] = Site::whereIn('id', $v)->pluck('site_name')->all();
                }
                if ($key == 'ts_supervisor') {
                    $data['request']['Supervisors'] = Member::select('first_name', 'last_name')->whereIn(DB::raw('concat(first_name, " ", last_name)'), $v)->get()->map(function ($val) {return $val->fullname();})->all();
                }
            endforeach;

            $fileName = $this->generate($format, $fields, $data, 'timesheet_summary', []);

            if ($return) {
                return $fileName;
            }

            if ($fileName) {
                $this->storeReportLog('timesheets', $fileName);
            }

            return $this->response('TimeSheet Report Generated Successfully', 'view', 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->response($e->getMessage(), 'view', 500);
        }
    }

    public function generateHoliday(Request $request, $format, $return = false)
    {
        $repo = self::getInstance();
        try {
            $data = $repo->generateHoliday($request);
            $fields = array('Name', 'Date', 'Description', 'Type', 'State');
            $mapField = array('name', 'hol_date', 'description', 'cal_type', 'state_r');
            $data = cleaner($mapField, $data);
            $data['table'] = 'Report of Time Sheets';
            $data['request'] = '';

            $data['request'] = [];
            if ($request->region !== '') {
                $data['request']['Region'] = $request->region;
            }
            if ($request->county !== '') {
                $data['request']['County'] = $request->county;
            }
            if ($request->city !== '') {
                $data['request']['City'] = $request->city;
            }

            $fileName = $this->generate($format, $fields, $data, 'holiday', 'portrait');

            if ($return) {
                return $fileName;
            }

            if ($fileName) {
                $this->storeReportLog('holiday', $fileName);
            }

            return $this->response('Holiday Report Generated Successfully', 'view', 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->response($e->getMessage(), 'view', 500);
        }
    }

    public function generateSites(Request $request, $format, $return = false)
    {
        $repo = self::getInstance();
        try {
            $data = $repo->generateSites($request);

            $fields = array(
                'site_code' => 'Site Code',
                'site_name' => 'Site Name',
                'add1' => 'Address 1',
                'add2' => 'Address 2',
                'city' => 'City',
                'zip_code' => 'Zip Code',
                'state' => 'State',
                'county' => 'County',
                'site_phone' => 'Site Phone',
                'site_alt_phone' => 'Site Alternative Phone',
                'fax' => 'Fax',
                'cont_per_fname' => 'Contact First Name',
                'cont_per_mname' => 'Contact Middle name',
                'cont_per_lname' => 'Contact Last Name',
                'cont_cell_no' => 'Contact Cell Number',
                'cont_email' => 'Contact Email',
                'supervisor_name' => 'Supervisor Assignment',
            );

            $data = $this->mapData($data, $fields, $format == 'pdf');

            if ($format == 'csv') {

                $head1 = array_map(function ($key) {
                    return [$key => $key];
                }, array_keys($fields));
                $head1 = array_collapse($head1);

                $head2 = array_map(function ($h) {
                    if (strrpos($h, 'Phone') !== false || $h == 'Fax') {
                        return 'INT(20)';
                    }

                    return 'string(191)';
                }, $fields);

                array_unshift($data, $head1, $fields, $head2);
                $fields = false;
            } else {

                $data['table'] = 'Report of Sites';
                $data['request'] = [
                    'Supervisors' => 'All',
                ];

                foreach ($request->all() as $key => $v):
                    if ($key == 'supervisors') {
                        $data['request']['Supervisors'] = Member::selectRaw('concat(first_name, " ", last_name) as fullname')->whereIn('user_id', $v)->get()->pluck('fullname')->implode(', ');
                    }
                    if (in_array($key, ['region', 'county', 'city'])) {
                        $data['request'][ucfirst($key)] = implode(', ', $v);
                    }
                endforeach;
            }

            $fileName = $this->generate($format, $fields, $data, 'sitesReport', []);

            if ($return) {
                return $fileName;
            }

            if ($fileName) {
                $this->storeReportLog('sites', $fileName);
            }

            return $this->response('Site Report Generated Successfully', 'view', 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->response($e->getMessage(), 'view', 500);
        }
    }

    protected function generate($format, $field, $data, $fileName, $mode = '')
    {

        switch (strtolower($format)) {
            case 'csv':
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
    protected function cleaner($mapField, $data)
    {
        $dataArr = [];
        if (count($data) > 0) {
            foreach ($data as $d) {
                $singleRow = [];
                foreach ($mapField as $map) {
                    if (array_key_exists($map, $d)) {
                        $singleRow[$map] = $d->$map;
                    }

                }
                array_push($dataArr, $singleRow);
            }
        }
        return $dataArr;

    }
    /**
     * @param $report_name
     * @param $filename
     * @return ReportLog
     */
    protected function storeReportLog($report_name, $filename)
    {
        $report = new ReportLog();
        $report->report_type = 'Export';
        // $report->report_date = date('Y-m-d');
        $report->report_name = strtolower($report_name);
        $report->file_name = $filename;
        $report->userc_id = Auth::id();
        $report->save();
        return $report;
    }

    public function getReportLog(Request $request, $target)
    {
        if ($target == "Account Summary") {
            $target = 'statement';
        }

        $target = str_replace(" ", "_", $target);
        return self::getInstance()->selectDataTable($request, $target);
    }

    public function delete($id)
    {
        return view('default.fgp.reports.masterReports.modal.deleteReport', compact('id'));
    }

    public function destroyReport(Request $request, $id)
    {
        try {
            $report = ReportLog::find($id);
            $report->is_deleted = true;
            $report->userd_id = auth()->id();
            $report->save();
            return $this->response('Report Deleted Successfully', 'view', 200);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function financeReport($view = null)
    {
        return view('default.fgp.reports.finance.index', compact('view'));
    }
}
