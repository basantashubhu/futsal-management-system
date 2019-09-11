<?php


namespace app\Http\Controllers\Report;


use App\Http\Controllers\BaseController;
use App\Models\ReportTemplate;
use Illuminate\Http\Request;

class ReportTemplateController extends BaseController
{
    private $clayout;

    public function __construct()
    {
        parent::__construct();
        $this->clayout = $this->layout . '.pages.reports.masterReport.modal.';
    }

    public function view(Request $request)
    {
        $target = $request->target;
        return view($this->clayout . 'storeTemplate', compact('target'));
    }

    public function loadView(Request $request)
    {
        $section=$request->section;
        $templates=ReportTemplate::where('section',$section)->where('userc_id',auth()->id())->get();
        return view($this->clayout.'loadTemplate',compact('templates','section'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'key_val' => 'required',
            'section' => 'required',
            'report_name' => 'required',
        ]);
        try {
            $report = new ReportTemplate();
            $report->section = $request->section;
            $report->key_val = json_encode($request->key_val);
            $report->report_name = $request->report_name;
            $report->userc_id = auth()->id();
            $report->save();
            return $this->response('Template save successfully', 'view', 200);
        } catch (\Exception $e) {
            return $this->response('Failed to save template', 'view', 500);
        }
    }

    public function load(Request $request)
    {
        $template=ReportTemplate::find($request->id);
        return response()->json($template);
    }


}