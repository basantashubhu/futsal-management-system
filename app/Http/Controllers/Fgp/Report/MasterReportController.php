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
 * @create date 2019-04-01 20:31:42
 * @modify date 2019-04-01 20:31:42
 * @desc [description]
 */

namespace App\Http\Controllers\Fgp\Report;

use App\Http\Controllers\BaseController;
use App\Models\Fgp\ReportLog;
use App\Models\Settings\Lookups;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MasterReportController extends BaseController
{
    private $clayout;
    const DS = DIRECTORY_SEPARATOR;
    private $process;

    public function __construct()
    {
        parent::__construct();
        $this->clayout = $this->layout . '.fgp.reports.masterReports.';
    }
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $users = User::where('role_id', '!=', 3)->where('is_deleted', false)->get();
        $target = $request->has('target') ? str_replace('_', ' ', $request->target) : 'Volunteer';
        $modalTarget = "volunteers";
        return view($this->clayout . 'index', compact('target', 'users', 'modalTarget'));
    }
    /**
     * @param $target
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loadRightSection($target)
    {
        $users = User::where('role_id', '!=', 3)->where('is_deleted', false)->get();
        if ($target == 'files'):
            $title = 'Mail';
            // $lists = File::all();
            return view($this->clayout . 'include.mailSection', compact('target', 'title', 'users'));
        else:
            $modalTarget = $target;
            if ($target == 'Account_Summary') {
                $modalTarget = 'statement';
            } elseif ($target == 'Non_Expired_Application') {
            $modalTarget = 'nonExpiredApplication';
        } elseif ($target == 'raw_query') {
            $modalTarget = 'sql';
        }

        $target = ucwords(str_replace('_', ' ', $target));
        return view($this->clayout . 'include.rightSection', compact('target', 'modalTarget', 'users'));
        endif;
    }
    public function volunteerModal()
    {
        $reportFormat = Lookups::where('code', 'report_format')->orderBy('sequence_num', 'ASC')->get();
        return view($this->clayout . 'modal.volunteerSearch', compact('reportFormat'));
    }
    public function timesheetsModal()
    {
        $reportFormat = Lookups::where('code', 'report_format')->orderBy('sequence_num', 'ASC')->pluck('value');
        $tsStatus = Lookups::where('code', 'timesheet_status')->orderBy('sequence_num', 'ASC')->pluck('value');
        return view($this->clayout . 'modal.timesheetsModal', compact('reportFormat', 'tsStatus'));
    }
    public function sitesModal()
    {
        $reportFormat = Lookups::where('code', 'report_format')->orderBy('sequence_num', 'ASC')->get();
        return view($this->clayout . 'modal.sitesModal', compact('reportFormat'));
    }
    public function holidayModal()
    {
        $reportFormat = Lookups::where('code', 'report_format')->orderBy('sequence_num', 'ASC')->get();
        return view($this->clayout . 'modal.holidayModal', compact('reportFormat'));
    }

    public function financeStipendModal()
    {
        $reportFormat = Lookups::where('code', 'report_format')->orderBy('sequence_num', 'ASC')->pluck('value');
        return view($this->clayout . 'modal.financeStipendModal', compact('reportFormat'));
    }
    public function financeSitesModal()
    {
        $reportFormat = Lookups::where('code', 'report_format')->orderBy('sequence_num', 'ASC')->pluck('value');
        return view($this->clayout . 'modal.financeSitesModal', compact('reportFormat'));
    }
    public function financeVolunteersModal()
    {
        $reportFormat = Lookups::where('code', 'report_format')->orderBy('sequence_num', 'ASC')->pluck('value');
        return view($this->clayout . 'modal.financeVolunteerModal', compact('reportFormat'));
    }
    public function financeDeVsyModal()
    {
        $reportFormat = Lookups::where('code', 'report_format')->orderBy('sequence_num', 'ASC')->pluck('value');
        return view($this->clayout . 'modal.deVsyModal', compact('reportFormat'));
    }

    public function downloadFile(ReportLog $report)
    {
        $file = $report->file_name;
        $path = storage_path('reports' . self::DS . $file);

        if (file_exists($path)):
            $headers = [
                'Content-Description' => 'File Transfer',
                'Content-Disposition' => 'attachment; filename="' . $file . '"',
                'Content-Transfer-Encoding' => 'binary',
                'Content-Type' => 'application/pdf',
            ];
            return response()->download($path, $file, $headers);
        else:
            return $this->response("File not Found", "view", 404);
        endif;
    }
}
