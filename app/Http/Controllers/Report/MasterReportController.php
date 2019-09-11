<?php


namespace app\Http\Controllers\Report;


use App\Http\Controllers\BaseController;
use App\Lib\File\PDFMerger;
use App\Models\Client;
use App\Models\FileMerge as FileModel;
use App\Models\Organization;
use App\Models\ReportLog;
use App\Models\Settings\Lookups;
use App\Repo\ApplicationRepo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\File;
use App\Models\Application;
use App\Models\DeliveryMethod;
use App\Models\Note;
use App\Http\Controllers\Application\ProcessController;

class MasterReportController extends BaseController
{
    private $clayout;
    const DS = DIRECTORY_SEPARATOR;
    private $process;

    public function __construct()
    {
        parent::__construct();
        $this->clayout = $this->layout . '.pages.reports.masterReport.';
        $this->process = new ProcessController();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {

        $target = $request->has('target') ? str_replace('_', ' ', $request->target) : 'Account Summary';
        return view($this->clayout . 'index', compact('target'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function statementModal()
    {
        $reportFormat = Lookups::where('code', 'report_format')->orderBy('sequence_num', 'ASC')->get();
        $providers = Organization::where('is_approved', 1)->where('is_deleted', 0)->get();
        return view($this->clayout . 'modal.statementSearch', compact('providers', 'reportFormat'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function providerModal()
    {
        $reportFormat = Lookups::where('code', 'report_format')->orderBy('sequence_num', 'ASC')->get();
        $providers = Organization::where('is_approved', 1)->where('is_deleted', 0)->get();
        return view($this->clayout . 'modal.providerSearch', compact('providers', 'reportFormat'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function petModal()
    {
        $reportFormat = Lookups::where('code', 'report_format')->orderBy('sequence_num', 'ASC')->get();
        $providers = Organization::where('is_approved', 1)->where('is_deleted', 0)->get();
        return view($this->clayout . 'modal.petSearch', compact('providers', 'reportFormat'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function citizenModal()
    {
        $reportFormat = Lookups::where('code', 'report_format')->orderBy('sequence_num', 'ASC')->get();
        return view($this->clayout . 'modal.citizenSearch', compact('providers', 'reportFormat'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function nonExpiredApplicationModal()
    {
        $providers = Organization::where('is_approved', 1)->where('is_deleted', 0)->get();
        $reportFormat = Lookups::where('code', 'report_format')->orderBy('sequence_num', 'ASC')->get();
        return view($this->clayout . 'modal.nonExpiredApplicationSearch', compact('providers', 'reportFormat'));
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sqlModal()
    {
        $reportFormat = Lookups::where('code', 'report_format')->orderBy('sequence_num', 'ASC')->get();
        return view($this->clayout . 'modal.querySearch', compact('reportFormat'));
    }

    /**
     * @param $target
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function loadRightSection($target)
    {
        if ($target == 'files'):
            $title = 'Mail';
            // $lists = File::all();
            return view($this->clayout . 'include.mailSection', compact('target', 'title'));
        else:
            $modalTarget = $target;
            if ($target == 'Account_Summary')
                $modalTarget = 'statement';
            elseif ($target == 'Non_Expired_Application')
                $modalTarget = 'nonExpiredApplication';
            elseif ($target == 'raw_query')
                $modalTarget = 'sql';

            $target = str_replace('_', ' ', $target);
            return view($this->clayout . 'include.rightSection', compact('target', 'modalTarget'));
        endif;
    }

    public function generateMailList(Request $request)
    {
        $reportName = ($request->has('report_name') && $request->report_name != '') ? $request->report_name : 'Post_Mail_' . date('m_d_Y_H_i_s');

        $letterMerge = new PDFMerger();
        $denialMerge = new PDFMerger();
        $ref = [];
        DB::beginTransaction();
        try {
            $appId=[];

            foreach ($request->id as $id) {
                $files = File::where('table', 'applications')->where('table_id', $id)->get();
                $app = Application::find($id);
                $denialCnt = 0;
                $lttrCnt = 0;
                foreach ($files as $file):
                        $filePath = storage_path('uploads' . DIRECTORY_SEPARATOR . $file->file_name);
                        if (file_exists($filePath)) {
                            $app->is_printed = 1;
                            $app->save();
                            if (strtolower($file->document_type) == 'letter' && $file->document_title != 'Copay Reminder' && $file->document_title != 'Denial letter') {
                                $letterMerge->addPDF($filePath);
                                $lttrCnt++;
                            } elseif (strtolower($file->document_type) == 'certificate') {
                                array_push($appId,$id);
                            } elseif ($file->document_title == 'Denial letter') {
                                $denialMerge->addPDF($filePath);
                                $denialCnt++;
                            }
                            $file->status = 'Prints';
                            $file->print_attempts = $file->print_attempts + 1;
                            $file->save();
                            array_push($ref, $file->id);
                        }

                endforeach;
            }
            $letterName = $lttrCnt>0?$reportName . '_Approval.pdf':null;
            $certName = count($appId)>0?$reportName . '_Certificate.pdf':null;
            $denialName = $denialCnt>0?$reportName . '_Denial.pdf':null;

            if ($lttrCnt == 0 && count($appId)<=0 && $denialCnt == 0)
                throw new \Exception('No File to print');

            if ($lttrCnt > 0)
                    $letterMerge->merge('file', storage_path('uploads' . DIRECTORY_SEPARATOR . $letterName));

            if($denialCnt > 0)
                $denialMerge->merge('file', storage_path('uploads' . DIRECTORY_SEPARATOR . $denialName));

            if(count($appId)>0)
            {
                $appRepo=new ApplicationRepo('Application');
                $data=$appRepo->getDetailsForSurgery($appId);
                $certName=$this->generateFile($data,'Surgery Certificates IE');
            }


            $merge = new FileModel();
            $merge->report_name = $reportName;
            $merge->approval_letter = $letterName;
            $merge->surgery_certificate = $certName;
            $merge->denial_letter = $denialName;
            $merge->ref_id = implode(',', $ref);
            $merge->userc_id = Auth::id();
            $merge->user_id = Auth::id();
            $merge->created_at = Carbon::now();
            $merge->save();
            DB::commit();
            return $this->response('File Generated Successfully', ['merge_id' => $merge->id], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
            return $this->response($e->getMessage(), $ref, 500);
        }

    }

    public function viewFile($id)
    {
        $pid = $id;
        $file = FileModel::find($id);
        $id = explode(',', $file->ref_id);
        $app = File::whereIn('id', $id)->groupBy('table_id')->get();
        $applications = [];
        foreach ($app as $a):
            array_push($applications, Application::find($a->table_id));
        endforeach;
        $track = DeliveryMethod::where('table', 'file_merge')->where('table_id', $pid)->first();
        return view($this->clayout . 'modal.viewFileOriginal', compact('applications', 'track'));
    }

    public function viewPdfFile($type, $id)
    {
        $file = FileModel::find($id);
        if (!is_null($file)) {
            if ($file->count()) {
                if (file_exists(storage_path('uploads/' . $file->$type))) {
                    return response()->file(storage_path('uploads/' . $file->$type));
                } else {
                    return back();
                }
            }
        }
        return "false";
    }

    public function undoReport($id)
    {
        $file = FileModel::find($id);
        $ids = explode(',', $file->ref_id);
        $file->is_deleted = true;
        $file->save();
        $app = [];
        foreach ($ids as $id):
            $file = File::find($id);
            $file->status = 'New';
            $file->save();
            $application = Application::find($file->table_id);
            array_push($app, $application->id);
            $application->is_printed = 0;
            $application->save();
        endforeach;
        return $this->response("Reports Undo Successfully", ['merge_id' => $app], 200);
    }

    public function getForm()
    {
        $date = date('Y-m-d');
        $app_id = File::where('status', 'New')->where('table', 'applications')->select('table_id')->distinct()->pluck('table_id');
        $applications = Application::where('is_deleted', 0)->whereIn('id', $app_id)
            ->where(function ($query) {
                $query->where('status', 'Approved')->orWhere('is_provider_view', 1);
            })->where('is_printed', 0)->orderBy('created_at', 'desc')->get();
        return view($this->clayout . 'include.generateForm', compact('applications'));
    }

    public function reportSentForm($id)
    {
        $track = DeliveryMethod::where('table', 'file_merge')->where('table_id', $id)->first();
        return view($this->clayout . 'modal.mailTrackingForm', compact('id', 'track'));
    }

    public function reportMailSent(Request $request, $id)
    {
        try {
            $tracking = new DeliveryMethod;
            $tracking->table = 'file_merge';
            $tracking->table_id = $id;
            $tracking->sent_method = $request->sent_method;
            $tracking->sent_tracking_no = $request->sent_tracking_no;
            $tracking->sent_date = $request->sent_date;
            $tracking->save();

            $file = FileModel::find($id);
            $file->is_send = true;
            $file->save();

            $id = explode(',', $file->ref_id);
            $app = File::whereIn('id', $id)->groupBy('table_id')->get();
            $applications = [];
            foreach ($app as $a):
                array_push($applications, Application::find($a->table_id));
            endforeach;
            foreach($applications as $app):
                $note = new Note;
                $note->table_name = 'applications';
                $note->table_id = $app->id;
                $note->segment = 'applications';
                $note->start = date('Y-m-d', strtotime($request->sent_date));
                $note->end = date('Y-m-d', strtotime($request->sent_date));
                $note->note_type = 'Email';
                $note->priority = 'Normal';
                $note->status = 'Sent';
                $note->activity = 'Mail Letter sent';
                $note->title = 'Approval Mail Letter Sent';
                $note->notes = 'Approval Mail Letter sent via '. $request->sent_method;
                $note->save();

                $this->process->changeProcessStatus($app, 'Approval Letter & Certificate Postal Mail To Applicant');
            endforeach;


            return $this->response("Report Mail Sent Successfully", "view", 200);
        } catch (\Exception $e) {
            return $this->response("Couldn't update" . $request->status, "view", 500);
        }
    }
    public function updateMailSent(Request $request, $id)
    {
        try {
            $tracking = DeliveryMethod::find($id);
            $tracking->sent_method = $request->sent_method;
            $tracking->sent_tracking_no = $request->sent_tracking_no;
            $tracking->sent_date = $request->sent_date;
            $tracking->save();

            $file = FileModel::find($id);
            $file->is_send = true;
            $file->save();

            return $this->response("Updated Successfully", "view", 200);
        } catch (\Exception $e) {
            return $this->response("Couldn't update" . $request->status, "view", 500);
        }
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
                'Content-Type' => 'application/pdf'
            ];
            return response()->download($path, $file, $headers);
        else:
            return $this->response("File not Found", "view", 404);
        endif;
    }

    public function getPostFile($fileName)
    {
        $filePath = storage_path('uploads' . DIRECTORY_SEPARATOR . $fileName);
        if ($filePath) {
            return response()->file($filePath);
        } else {
            return back();
        }
    }
}