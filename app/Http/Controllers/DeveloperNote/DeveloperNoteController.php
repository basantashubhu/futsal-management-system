<?php




namespace App\Http\Controllers\DeveloperNote;

use App\Http\Controllers\BaseController;
use App\Models\DeveloperNote;
use App\Repo\DeveloperNoteRepo;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Lib\Exporter\CSVExporter;
use App\Lib\Exporter\JSONExporter;
use App\Lib\Exporter\PDFExporter;
use App\Lib\Exporter\TxtExporter;

class DeveloperNoteController extends BaseController
{
    use \App\Traits\DeveloperNoteCrud;
    /**
     * @var null
     */
    private static $repo = null;
    /**
     * @var string
     */
    private $clayout = '';

    /**
     * ClientController constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->clayout = $this->layout . '.pages.developerNote.';
    }

    public function index()
    {
        return view($this->clayout . 'index');
    }

    /**
     * @param $model
     * @return DeveloperNoteRepo|null
     */
    private static function getInstance($model)
    {
        self::$repo = new DeveloperNoteRepo($model);
        return self::$repo;
    }

    public function store(Request $request)
    {
        $note = new DeveloperNote;
        $note->text = $request->text;
        $note->page = $request->page;
        $note->status = 'New';
        $note->userc_id = auth()->id();
        $note->save();
        return $this->response("Developer Note Sent Successfully", "view", 200);
    }

    public function pickupNote($id)
    {
        try {
            $note = DeveloperNote::find($id);
            if (!$note->user_id) {
                $note->user_id = auth()->id();
                $note->assigned_to = auth()->id();
                $note->save();

                return $this->response("Developer Note Picked Up", "view", 200);
            }

            return $this->response("Developer Note Already Picked", "view", 200);
        } catch (\Exception $e) {
            return $this->response("Error in Picking Up Developer Note", 'view', 422);
        }
    }

    public function completeNote($id)
    {
        try {

            $note = DeveloperNote::find($id);
            if ($note->user_id == auth()->id()) {
                $note->is_done = true;
                $note->is_done_by = auth()->id();
                $note->is_done_date = Carbon::now();
                $note->save();
            }

            return $this->response("Developer Note Completed Successfully", "view", 200);
        } catch (\Exception $e) {
            return $this->response("Error in Picking Up Developer Note", 'view', 422);
        }
    }

    public function unDone($id)
    {
        try {

            $note = DeveloperNote::find($id);
            if ($note->user_id == auth()->id() || auth()->user()->hasRole('superAdmin')) {
                $note->is_done = false;
                $note->is_done_by = 0;
                $note->save();
                return 'success';
            }

            return $this->response("Note Undone Successfully", "view", 200);
        } catch (\Exception $e) {
            return $this->response("Error in Picking Up Developer Note", 'view', 422);
        }
    }

    public function undoneNote($id)
    {
        return view($this->clayout . 'modal.undone', compact('id'));
    }

    public function getNotes()
    {
        $notes = DeveloperNote::where('is_deleted', false)->where('is_done', false)
            ->select('id', 'date', 'user_id', 'page', 'text', 'feedback', 'status', 'is_done', 'userc_id', 'created_at')
            ->with('user', 'creator')
            ->latest()
            ->get();
        return view($this->clayout . 'notes', compact('notes'));
    }

    public function getAll(Request $request)
    {
        return self::getInstance('DeveloperNote')->selectDataTable($request);
    }

    public function export(Request $request, $type)
    {
        try {
            if($request->status == 0):
                $status = 'Pending';
            elseif($request->status == 1):
                $status = 'Completed';
            else:
                $status = 'All';
            endif;
            $data = self::getInstance('DeveloperNote')->getReportData($request);
//        dd($data);
            $fields = array('Date', 'Assigned By', 'Pick Up By', 'Page', 'Status');
            $mapField = array('created_at', 'creatorname', 'reciever', 'page', 'status', 'text');
            $data = cleaner($mapField, $data);
            $status = $request->status ? $request->status : 'All';
            $data['request'] = ['Status' => $status];
            $data['table'] = 'Showing Results of Developers Table';
            if (count($data) > 0) {
                $export = $this->reportFactory($type, $fields, $data);
                $exporter = new \App\Lib\Exporter\Exporter($export);
                $filename = $exporter->export();
                return response()->download($filename)->deleteFileAfterSend(true);
            }
            return 'No Data Available For Current Filter';
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * @param $type
     * @param $data
     * @return CSVExporter|JSONExporter|PDFExporter|TxtExporter
     * @throws \Exception
     */
    public function reportFactory($type, $fields, $data)
    {
        switch ($type) {
            case 'csv':
                return new CSVExporter($data, $fields, 'DeveloperNoteReports');
                break;
            case 'json':
                return new JSONExporter($data);
                break;
            case 'txt':
                return new TxtExporter($data);
                break;
            case 'pdf':
                return new PDFExporter($data, $fields, 'multiline');
                break;
            default:
                throw new \Exception("Method Not Allowed " . $type);
                break;
        }
    }
}
