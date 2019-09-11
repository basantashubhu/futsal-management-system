<?php

namespace App\Http\Controllers\Fgp\Report;

use App\Http\Controllers\Controller;
use App\Models\Fgp\ReportLog;
use App\Repo\FGP\FinanceRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinanceReportController extends Controller
{
    use \App\Traits\ReportGenerator;

    public function postedVolunteerReport(Request $request, $format)
    {
        $repo = new FinanceRepo('Fgp\StipendCalc');
        $data = $repo->selectDataTableVolunteer($request)['data'];

        $fields = [
            'created_at' => 'Post Date',
            'period_no' => 'Period #',
            'vol_name' => 'Volunteer Name',
            'site_name' => 'Site Name',
            'county' => 'County',
            'eto_earned' => 'ETO Earned',
            'eto_balance' => 'ETO Balance',
            'time_total' => 'Total Hours',
            'time_total_amt' => '$ Total Hours',
            'items_amount_total' => '$ Items Total',
            'total' => '$ Total',
        ];

        $data = $this->mapData($data, $fields, $format === 'pdf');

        $data['table'] = 'Posted Volunteer Report';

        $filename = $this->generate($format, $fields, $data, 'PostedVolunteerReport', []);

        if ($request->saveLog) {
            $this->storeReportLog('fiscal_volunteers', $filename);
        }

        return ['report' => $filename, 'gen' => !!$filename];
    }

    public function postedStipendReport(Request $request, $format)
    {
        $repo = new FinanceRepo('Fgp\StipendCalc');
        $data = $repo->selectDataTablePeriod($request)['data'];

        $fields = [
            'created_at' => 'Post Date',
            'end_date' => 'Period Date',
            'period_no' => 'Period #=',
            'status' => 'Status',
            'total_sites' => 'Total Sites=',
            'total_vols' => 'Total Volunteers=',
            'eto_earned' => 'ETO Earned>',
            'time_total' => 'Total Hours>',
            'time_total_amt' => '$ Total Hours>',
            'amt_total' => '$ Items Total>',
            'total' => '$ Total>',
        ];

        $data = $this->mapData($data, $fields, $format === 'pdf');

        $data['table'] = 'Posted Stipend Period Report';

        $filename = $this->generate($format, $fields, $data, 'PostedVolunteerReport', []);

        if ($request->saveLog) {
            $this->storeReportLog('finance_stipend_period', $filename);
        }

        return ['report' => $filename, 'gen' => !!$filename];
    }

    public function postedSiteReport(Request $request, $format)
    {
        $repo = new FinanceRepo('Fgp\StipendCalc');
        $data = $repo->selectDataTableSites($request)['data'];

        $fields = [
            'created_at' => 'Post Date',
            'end_date' => 'Period Date',
            'period_no' => 'Period #=',
            'site_name' => 'Site Name',
            'county' => 'County',
            'total_vols' => 'Total Volunteers=',
            'eto_earned' => 'ETO Earned>',
            'time_total' => 'Total Hours>',
            'time_total_amt' => '$ Total Hours>',
            'items_amount_total' => '$ Items Total>',
            'total' => '$ Total>',
        ];

        $data = $this->mapData($data, $fields, $format === 'pdf');

        $data['table'] = 'Posted Site Report';

        $filename = $this->generate($format, $fields, $data, 'PostedSiteReport', []);

        if ($request->saveLog) {
            $this->storeReportLog('fiscal_sites', $filename);
        }

        return ['report' => $filename, 'gen' => !!$filename];
    }

    public function ApproveVolunteerReport(Request $request, $format)
    {
        $repo = new FinanceRepo('Fgp\StipendCalc');
        $data = $repo->selectDataTableVolunteer($request)['data'];

        $fields = [
            'created_at' => 'Post Date',
            // 'end_date' => 'Period Date',
            'period_no' => 'Period #=',
            'vol_name' => 'Volunteer Name',
            'county' => 'County',
            // 'total_vols' => 'Total Volunteers=',
            'eto_earned' => 'ETO Earned>',
            'eto_balance' => 'ETO Balance>',
            'time_total' => 'Total Hours>',
            'time_total_amt' => '$ Total Hours>',
            'items_amount_total' => '$ Items Total>',
            'total' => '$ Total>',
        ];

        $data = $this->mapData($data, $fields, $format === 'pdf');

        $data['table'] = 'Approved Volunteer Report';

        $filename = $this->generate($format, $fields, $data, 'PostedSiteReport', []);

        if ($request->saveLog) {
            $this->storeReportLog('fiscal_volunteers', $filename);
        }

        return ['report' => $filename, 'gen' => !!$filename];
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

}
