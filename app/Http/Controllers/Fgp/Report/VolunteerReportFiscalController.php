<?php
namespace App\Http\Controllers\Fgp\Report;

use App\Http\Controllers\Fgp\Finance\FinanceController;
use App\Traits\ReportGenerator;
use Exception;
use Illuminate\Http\Request;

class VolunteerReportFiscalController
{
    use ReportGenerator;

    public function generateVolReport(Request $request, $report_type)
    {
        $fields = [
            'created_at' => 'Post Date',
            'period_no' => 'Stipend#',
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

        try {
            $bulk = app(FinanceController::class)->getAll($request, $type = 'volunteer', $id = null);
            $data = $bulk['data'];
            $data = $this->mapData($data, $fields, $report_type === 'pdf');
            $data['table'] = 'Volunteers Report';

            $filename = $this->generate($report_type, $fields, $data, 'VolunteerReportFiscal', []);
            if ($filename) {
                return response()->download(storage_path("reports/$filename"))->deleteFileAfterSend();
            } else {
                abort(500);
            }
        } catch (Exception $e) {
            return abort(500, $e->getMessage());
        }
    }
}
