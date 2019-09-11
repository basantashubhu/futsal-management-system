<?php


namespace App\Http\Controllers\Note;


use Carbon\Carbon;
use App\Models\File;
use App\Models\Note;
use App\Models\Client;
use App\Models\Member;
use App\Repo\NoteRepo;
use App\Models\Fgp\Site;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Models\Fgp\Volunteer;
use App\Models\Settings\Lookups;
use App\Http\Requests\NoteRequest;
use Illuminate\Support\Facades\DB;
use App\Lib\Notification\Notification;
use App\Http\Controllers\BaseController;

class NoteController extends BaseController
{
    use \App\Traits\ReportGenerator;

    private static $repo = null;
    private $note_types = ['todo', 'task', 'reminder'];

    public function __construct()
    {
        parent::__construct();
        $this->layout .= '.pages.note.';
    }

    public function create(Application $application)
    {
        return view($this->layout . 'modal.add', compact('application'));
    }

    public function index()
    {
        $notes = Note::whereIn('note_type', $this->note_types)->where('is_deleted', 0)->get();
        return view($this->layout . 'index', compact('notes'));
    }

    public function todos(Request $request)
    {
        $notes = Note::whereIn('note_type', $this->note_types)->where('note_type', 'todo')
            ->when(!$request->date, function($query) {
                $query->where('todo_timestamp', DB::raw('curdate()'));
            })
            ->when($request->date, function($query, $date) {
                $range = array_map(function($d) {
                    return date('Y-m-d', strtotime($d));
                }, explode('-', $date));
                $query->whereBetween(request()->date_type, $range);
            })
            ->where('is_completed', 0)->where('is_deleted', 0)
            ->get();
        return view($this->layout . 'includes.todo', compact('notes'));
    }
    public function reminders(Request $request)
    {
        $notes = Note::whereIn('note_type', $this->note_types)->where('note_type', 'reminder')
            ->when(!$request->date, function($query) {
                $query->where('reminder_timestamp', DB::raw('curdate()'));
            })
            ->when($request->date, function($query, $date) {
                $range = array_map(function($d) {
                    return date('Y-m-d', strtotime($d));
                }, explode('-', $date));
                $query->whereBetween(request()->date_type, $range);
            })
            ->where('is_completed', 0)->where('is_deleted', 0)
            ->get();
        return view($this->layout . 'includes.reminders', compact('notes'));
    }

    public function AllEvents()
    {
        $events = Note::select('id', 'title', 'start', 'end', 'description', 'className')->where('note_type', 'Reminder')->where('is_deleted', false)->get();
        return response()->json($events);
    }

    public function store(Request $request)
    {

        $events = $request->all();
        $event = new Note();
        foreach ($events as $key => $val):
            $event->$key = $val;
        endforeach;
        $event->table_name = 'Client';
        $event->table_id = auth()->id();
        $event->user_id = auth()->id();
        $event->userc_id = auth()->id();
        if ($event->note_type == 'Reminder') {
            $event->note_type = 'Reminder';
            $event->url = "calender";
            $event->is_notification = true;
        }
        $event->save();
        return $this->response("Notes created successFully", "view", 200);
    }


    public function storeNote(Request $request, $id)
    {
        $notes = $request->all();
        $note = new Note();
        foreach ($notes as $key => $val):
            $note->$key = $val;
        endforeach;
        $note->table_name = 'applications';
        $note->table_id = $id;
        $note->user_id = auth()->id();
        $note->userc_id = auth()->id();
        $note->save();
        return $this->response("Notes created successFully", "view", 200);
    }

    public function editEvent($id)
    {
        $event = Note::find($id);
        return view('default.pages.calendar.modal.editEvent', compact('event'));
    }

    public function updateEvent(Request $request, $id)
    {
        $events = $request->all();
        $event = Note::find($id);
        foreach ($events as $key => $val):
            $event->$key = $val;
        endforeach;
        $event->user_id = auth()->id();
        $event->userc_id = auth()->id();
        if ($event->note_type == 'Reminder') {
            $event->note_type = 'Reminder';
            $event->url = "calender";
            $event->is_notification = true;
        }
        $event->save();
        return $event;
    }

    public function getAllNotes($id)
    {
        return Note::where('vol_id', $id)->where('is_deleted', false)->latest()->get();
    }

    public function getOrganizationNotes($id, $status)
    {
        return $this->getTableData('organization', $id, $status);
    }

    protected function getTableData($table, $id, $status)
    {
        if($status = 'notDone')
            $status1 = 'Not Done';
        elseif($status = 'done')
            $status1 = 'Done';
        return Note::where('table_name', $table)->where('table_id', $id)->where('status', $status1)->where('is_deleted', false)->latest()->get();
    }

    public function createNote(Request $request, $volId=null)
    {
        if ($volId){
            $volunteer = Volunteer::find($volId);
            $currentUser = auth()->user()->member()->first();
            return view($this->layout . 'modal.addNote',compact('currentUser','volunteer'));
        }
        $currentUser = auth()->user()->member()->first();
        return view($this->layout . 'modal.addNote',compact('currentUser'));
    }


    /**
     * @param $model
     * @return NoteRepo|null
     */
    private static function getInstance($model)
    {

        self::$repo = new NoteRepo($model);
        return self::$repo;
    }

    public static function getRepo($model){
        self::$repo = new NoteRepo($model);
        return self::$repo;
    }

    public function noteStore(Request $request)
    {
        if($request->has('title'))
            $request->validate(['title' => 'required', 'note_type' => 'required']);
        if ($request->has('note_title'))
            $request->validate(['note_title' => 'required', 'note_type' => 'required']);

        if ($request->has('full_validate')) {
            $this->validate($request, [
                'vol_id' => 'required',
                'site_id' => 'required',
                'reminder_timestamp' => 'nullable|date',
                'todo_timestamp' => 'nullable|date',
            ], [], [
                'vol_id' => 'Volunteer',
                'site_id' => 'Site',
            ]);
        }

        try {
            $range = $request->start ? explode('-',$request->start) : false;
            $noteData = $request->only([
                'vol_id', 'site_id', 'userc_date', 'userc_id',
                'note_desc', 'note_type', 'note_code',
                'status', 'priority', 'is_comlpeted', 'is_seen','seen_date',
                'is_active', 'title', 'url', 'attachfile','note_date'
            ]);
            $noteData['start'] = $range ? date('Y-m-d H:i:s',strtotime(trim($range[0]))) : null;
            $noteData['end'] = isset($range[1]) ? date('Y-m-d H:i:s',strtotime(trim($range[1]))) : null;
            $noteData['title'] = $request->input('note_title', $request->input('title'));

            if ($request->todo_timestamp)
            if ($todo_ts = strtotime($request->todo_timestamp))
            $noteData['todo_timestamp'] = date('Y-m-d H:i:s', $todo_ts);

            if ($request->reminder_timestamp)
            if ($reminder_ts = strtotime($request->reminder_timestamp))
            $noteData['reminder_timestamp'] = date('Y-m-d H:i:s', $reminder_ts);

            foreach ($request->only('site_id', 'vol_id') as $key => $value)
                $noteData[$key] = $value ?: '';

            $note = self::getRepo('Note')->saveUpdate($noteData);

            if ($request->hasFile('file')) {
                $files = [];
                foreach ($request->file('file') as $key => $file) {
                    $file->move(storage_path('uploads/notes'), $file_name = implode('_', [md5($file), $file->getClientOriginalName()]));
                    $files[] = [
                        'table' => 'notes', 'table_id' => $note->id,
                        'document_segment' => 'note', 'document_title' =>  $request->input("file_title.$key", $file->getClientOriginalName()),
                        'file_name' =>$file_name, 'document_type' => $file->getClientOriginalExtension(),
                        'created_at' => now(), 'updated_at' => now()
                    ];
                }
                File::insert($files);
            }

            if ($note) {
                return $this->response("Note Added SuccessFully", "view", 200);
            } else {
                return $this->response("Can't add Notes", 'view', 422);
            }
        } catch (\Exception $e) {
            return $this->response(implode('<br>', ["Can't add Notes.", '', $e->getMessage()]), 'view', 422);
        }
    }

    public function viewSingle(Request $request, Note $note)
    {
        $volunteer = Volunteer::find($note->vol_id);
        return view($this->layout . '.includes.note-view.note_view', compact('note', 'volunteer'));
    }

    public function editNote(Note $note)
    {
        $volunteer = false;
        $currentUser = $note->user;
        $site = false;
        $start_date = date('Y-m-d',strtotime($note->start));
        $end_date = date('Y-m-d',strtotime($note->end));
        return view($this->layout . '.modal.edit', compact('note','volunteer','site','currentUser', 'start_date', 'end_date'));
    }

    public function noteUpdate(Request $request, Note $note)
    {
        $range=explode('-',$request->start);
        $noteData = $request->only([
            'vol_id', 'site_id', 'start', 'end', 'userc_date', 'userc_id', 'todo_timestamp', 'note_desc', 'note_type', 'note_code', 'status', 'priority', 'is_comlpeted', 'is_seen','seen_date', 'is_active', 'title', 'url', 'attachfile','reminder_timestamp','note_date'
        ]);
        $noteData['start'] = date('Y-m-d H:i:s',strtotime($request->start?trim($range[0]):$note->start));
        $noteData['end'] = date('Y-m-d H:i:s',strtotime($request->start?trim($range[1]):$note->end));

        if ($request->todo_timestamp || $note->todo_timestamp)
        $noteData['todo_timestamp'] = date('Y-m-d H:i:s',strtotime($request->todo_timestamp?:$note->todo_timestamp));

        if ($request->reminder_timestamp || $note->reminder_timestamp)
        $noteData['reminder_timestamp'] = date('Y-m-d H:i:s',strtotime($request->reminder_timestamp?:$note->reminder_timestamp));

        $note = self::getRepo($note)->saveUpdate($noteData);

        if (is_array($existing_files = $request->existing_files ?: []))
        foreach ($note->files as $file) {
            if (in_array($file->id, $existing_files)) continue;
            if (file_exists($ex_path = storage_path('uploads/notes/{$file->file_name}'))) {
                unlink($ex_path);
            }
            $file->delete();
        }

        if ($request->hasFile('file')) {
//                $request->file('note_files')->getClientOriginalExtension();
            $files = [];
            foreach ($request->file('file') as $key => $file) {
                $file->move(storage_path('uploads/notes'), $file_name = implode('_', [md5($file), $file->getClientOriginalName()]));
                $files[] = [
                    'table' => 'notes', 'table_id' => $note->id,
                    'document_segment' => 'note', 'document_title' => $request->input("file_title.$key", $file->getClientOriginalName()),
                    'file_name' => $file_name, 'document_type' => $file->getClientOriginalExtension(),
                    'created_at' => now(), 'updated_at' => now()
                ];
            }
            File::insert($files);
        }

        if ($note) {
            return $this->response("Note Updated SuccessFully", "view", 200);
        } else {
            return $this->response("Can't update Note", 'view', 422);
        }
    }

    public function delete(Note $note)
    {
        return view($this->layout . '.modal.delete', compact('note'));
    }

    public function destory(Note $note)
    {
        $note->is_deleted = 1;
        $res = $note->update();

        if ($res)
            return $this->response("Note deleted successFully", "view", 200);
        else
            return $this->response("Can't delete Note", 'view', 422);
    }

    public function getAll(Request $request)
    {
        $data = self::getInstance('Note')->selectDataTable($request);
        return $data;
    }
    public function getAllForDashboard(Request $request)
    {
        $data = self::getInstance('Note')->getAllForDashboard($request);
//        $data = Note::where('is_notification', false)->where('is_deleted', false)->get();
        return $data;
    }


    public function todo()
    {
        $todo = Note::where('note_type', 'todo')->where('notes.userc_id', auth()->id())->where('is_completed', 0)
            ->join('users', 'users.id', 'notes.userc_id')
            ->select('notes.title as title', 'notes.id as id', 'users.name as creator','notes.created_at as date')
            ->get();
        if(count($todo) > 0){
            return $todo;
        }else{
            return 'false';
        }
    }



    public function markAsCompleted(Request $request)
    {
        foreach ($request->all() as $todoid) {
            $todo = Note::find($todoid);
            $todo->is_completed = true;
            $todo->status = 'Done';
            $todo->save();
        }
        return $this->response("Marked As Completed", "view", 200);
    }

    public function markComplete($id)
    {
        $todo = Note::find($id);
        $todo->is_completed = true;
        $todo->status = 'Done';
        $todo->save();
        return $this->response("Marked As Completed", "view", 200);
    }

    public function CreateTodo(Request $request)
    {
        try {
            $note = new Note();
            $note->note_type = 'Todo';
            $note->title = $request->all()['title'];
            $note->start = date('Y-m-d h:i:s');
            $note->user_id = auth()->id();
            $note->userc_id = auth()->id();
            $note->save();
            return $this->response("Marked As Completed", "view", 200);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function noteDone(Note $note)
    {
        $note->is_completed = true;
        $note->status = 'Done';
        $note->save();
        return $this->response("Marked As Completed", "view", 200);
    }

    public function volunteer_modal()
    {
        return view($this->layout . 'modal.select_volunteer_modal');
    }

    public function site_modal(Request $request)
    {
        return view($this->layout . 'modal.select_site_modal');
    }
    
    public function selectVolunteerSite(Volunteer $volunteer)
    {
        return $volunteer;
    }

    public function selectNoteSite($id)
    {
        return Site::where('id',$id)->with('address')->first();
    }

    public function allVolunteers()
    {
        $volunteers = Volunteer::select(DB::raw('CONCAT (first_name, " " ,last_name) as value, id '))->where('is_deleted', 0)->get();
        return $volunteers;
    }

    public function allSites()
    {
        $sites = Site::select('id','site_name as value')->where('is_deleted', 0)->get();
        return $sites;
    }

    public function download($file_name)
    {
        $path = storage_path("uploads/notes/$file_name");
        if (!file_exists($path)) abort(404);
        return response()->file($path);
    }

    public function export(Request $request, $format)
    {
        $ids = $request->ids ? explode(',', $request->ids) : false;

        $data = DB::table('notes')
                ->leftJoin('volunteers', 'volunteers.id', 'notes.vol_id')
                ->leftJoin('sites', 'sites.id', 'notes.site_id')
                ->leftjoin('members as m', 'notes.userc_id', 'm.user_id')
                ->where('notes.is_deleted', 0)
                ->select(['sites.site_name', 'notes.*',
                    DB::raw('CONCAT(volunteers.first_name," ",COALESCE(volunteers.middle_name,"")," ",volunteers.last_name) AS full_name'),
                    DB::raw('concat(m.first_name, " ",if(m.middle_name<>"", m.middle_name, ""), " ", m.last_name) as created_user'),
                ])
                ->whereIn('note_type', ['todo', 'task', 'reminder'])
                ->when($ids, function($query, $ids) {
                    $query->whereIn('notes.id', $ids);
                })
                ->get();
        
        $fields = array(
            'created_at' => 'Created Date',
            'title' => 'Title',
            'priority' => 'Priority=',
            'note_date' => 'Note Date',
            'todo_timestamp' => 'Todo Date',
            'reminder_timestamp' => 'Reminder Date',
            'full_name' => 'Volunteer',
            'site_name' => 'Site',
            'created_user' => 'Created User',
            'status' => 'Status='
        );
        
        $dataArr = $this->mapData($data, $fields, $format === 'pdf');
        
        $file = $this->generate($format, array_values($fields), $dataArr, 'notes', []);
        if($file) return response()->download(storage_path("reports/$file"))->deleteFileAfterSend(true);
        return response(['error' => "Error generating $format of notes."]);
    }

}