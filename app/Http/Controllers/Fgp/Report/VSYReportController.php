<?php

namespace App\Http\Controllers\Fgp\Report;

use App\Http\Controllers\Controller;
use App\Lib\Exporter\CSVExporter;
use App\Lib\Exporter\Exporter;
use App\Lib\Exporter\JSONExporter;
use App\Lib\Exporter\PDFExporter;
use App\Lib\Exporter\TxtExporter;
use App\Models\Fgp\ReportLog;
use App\Repo\FGP\StipendCalcRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VSYReportController extends Controller
{
    private $layout = 'default.fgp.reports.vsy_report';

    public function __invoke()
    {
        return $this->view('index');
    }

    public function getData(Request $request, $type = 'datatable')
    {

        return (new StipendCalcRepo('Fgp\StipendCalc'))->selectReportDataTable($request, $type);
    }

    public function export(Request $request, $type, $returnFileName = false)
    {
        try {
            $returnFileName = $request->returnFileName ?: $returnFileName;
            $data = $this->getData($request, 'array');
            $data['table'] = "DE VSY Report";
            $data['request'] = [['Date Range', $request->range]];
            $fields = [
                ['', 'Cumulative', 'Cumulative', 'Monthly', 'Monthly', 'Monthly', 'Monthly', 'Annual'],
                ['Month', 'Hours', 'Hours', 'VSY', 'VSY', 'Hours', 'Vols.', 'VSY'],
                ['', 'Actual', 'Goal', 'Actual', 'Goal', 'Actual', 'Active', 'Goal'],
            ];
            $exportable = $this->reportFactory($type, $fields, $data);
            $exporter = new Exporter($exportable);
            $file_name = $exporter->export();
            if ($returnFileName) {
                $this->storeReportLog('de_vsy', basename($file_name));
                return $file_name;
            }
            return !$returnFileName ? response()->download($file_name)->deleteFileAfterSend(true) : $file_name;
        } catch (\Exception $e) {
            return response(['errors' => ['message' => $e->getMessage() . $e->getFile() . $e->getLine()]], 500);
        }
    }

    public function printChart(Request $request)
    {
        $returnFileName = true;
        return $this->export($request, 'pdf', $returnFileName);
    }

    public function downloadPrint(Request $request)
    {
        if (file_exists($file = $request->filename)) {
            return response()->download($file)->deleteFileAfterSend(true);
        }
        abort(404);
    }

    private function view(string $view, array $compact = [])
    {
        $compact['layout'] = $this->layout;
        return view($this->layout . '.' . $view, $compact);
    }

    private function reportFactory($type, $fields, $data)
    {
        switch ($type) {
            case 'csv':
                return new CSVExporter($data, $fields, 'Fgp_vsy_report');
                break;
            case 'json':
                return new JSONExporter($data);
                break;
            case 'txt':
                return new TxtExporter($data);
                break;
            case 'pdf':
                return new PDFExporter($data, $fields, 'fgp_vsy_report', 'Fgp_vsy_report', []);
                break;
            default:
                throw new \Exception("Method Not Allowed " . $type);
                break;
        }
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
