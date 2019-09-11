<?php

namespace App\Http\Controllers\GlobalEmailSend;

use App\Lib\FileZipper\Config;
use App\Lib\SwiftMailer\SwiftMailer;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmailFile;
use App\Lib\File\FileUploader;
use App\Http\Requests\EmailSendRequest;
use App\Models\Note;
use App\Models\EmailLog;
use App\Repo\GlobalEmailRepo;
use App\Repo\ApplicationRepo;
use App\Repo\InvoiceRepo;
use App\Repo\OrganizationRepo;
use App\Lib\Exporter\CSVExporter;
use App\Lib\Exporter\JSONExporter;
use App\Lib\Exporter\PDFExporter;
use App\Lib\Exporter\TxtExporter;
use DB;
use App\Models\Client;
use App\Models\File;
use App\Models\SaveLoadEmail;
use App\Lib\Filter\EmailQueueFilter\SaveLoadEmailFilter;
use App\Lib\Filter\ClientFilter\ClientFilter;

class GlobalEmailSendController extends BaseController
{
    private $clayout = "";

    public function __construct()
    {
        parent::__construct();
        $this->clayout = $this->layout . '.pages.globalEmailSend.';
    }

    public function getForm(Request $request)
    {
        $table = $request->table;
        $from = $request->from ? $request->from : 'support@zeuslogic.com';
        $to = $request->to ? $request->to : 'support@zeuslogic.com';
        return view($this->clayout . 'index', compact('table', 'to', 'from'));
    }

    public function index(Request $request, $to, $id)
    {
        $table = $request->table;
        $from = $request->from ? $request->from : auth()->user()->email;
//        $to = $request->to ? $request->to : 'support@zeuslogic.com';
        return view($this->clayout . 'modal.sendEmail', compact('table', 'to', 'from', 'id'));
    }

    public function exportData(Request $request, $table)
    {
        if ($table == 'applications'):
            $data = (new ApplicationRepo('Application'))->getReportData($request);
            $fields = array('Date', 'Status', 'Copay', 'Total Pets', 'Client Name', 'Phone Number', 'Email Number', 'Provider Name');
            $mapField = array('date', 'status', 'copay', 'no_of_pet', 'owner_name', 'cell_phone', 'personal_email', 'service_provider');
            $data = cleaner($mapField, $data);
            $data['request'] = ['Application ID' => $request->applicationID, 'Status' => $request->statusSingle, 'Date Range' => $request->dateRange, 'SSN' => $request->ssn, 'Copay' => $request->copay, 'Client Name' => $request->clientName, 'Phone Number' => $request->cellPhone, 'Email Address' => $request->email, 'City' => $request->city, 'Zip' => $request->zipCode];
            $data['table'] = 'Showing Results of Applications Table';
        elseif ($table == 'pets'):
            $data = DB::table('pets')->get();
            foreach ($data as $d):
                $client = Client::find($d->client_id);
                $d->owner_name = $client->fname . ' ' . $client->mname . ' ' . $client->lname;
            endforeach;
            $fields = array('Id', 'Pet Name', 'Species', 'Sex', 'Breed', 'Color', 'Age Type', 'Age', 'Weight', 'Owner Name');
            $mapField = array('alt_id', 'pet_name', 'species', 'sex', 'breed', 'color', 'age_type', 'age_of_pet', 'weight', 'owner_name');
            $data = cleaner($mapField, $data);
            $data['request'] = ['Species' => $request->species, 'Breed' => $request->breed, 'Owner Name' => $request->ownername, 'Email Address' => $request->owneremail, 'Phone Number' => $request->ownerphone];
            $data['table'] = 'Showing Results of Pets Table';
        elseif ($table == 'invoice_header'):
            $data = (new InvoiceRepo('Invoice'))->getReportData($request);
            $fields = array('Date', 'Number', 'Status', 'App ID', 'Client Name', 'Provider', 'Total');
            $mapField = array('date', 'invoice_number', 'invoice_status', 'applicationId', 'client_name', 'cname', 'invoice_total');
            $data = cleaner($mapField, $data);
            $data['request'] = ['Client Name' => $request->ownername];
            $data['table'] = 'Showing Results of Invoice Table';
        else:
            if ($request->singleStatus == '0'):
                $status = 'Pending';
            elseif ($request->singleStatus == '1'):
                $status = 'Approved';
            elseif ($request->singleStatus == '2'):
                $status = 'Review';
            else:
                $status = 'Denial';
            endif;
            $data = (new OrganizationRepo('Organization'))->getExportData($request);
            $fields = array('Name', 'Type', 'License Number', 'Email', 'Phone', 'Address', 'City', 'State', 'Zip');
            $mapField = array('cname', 'type', 'lic_no', 'company_email', 'phone', 'add1', 'city', 'state', 'zip_code');
            $data = cleaner($mapField, $data);
            $data['request'] = ['Provider Name' => $request->name, 'Status' => $status, 'Phone Number' => $request->ownerphone, 'City' => $request->city, 'Zip' => $request->zipCode];
            $data['table'] = 'Showing Results of Providers Table';
        endif;
        if (count($data) > 0) {
            $type = ['csv', 'txt', 'json', 'pdf'];
            $fileNames = [];
            foreach ($type as $t):
                $export = $this->reportFactory($t, $fields, $data);
                $exporter = new \App\Lib\Exporter\Exporter($export);
                $t = $exporter->export();
                $path = storage_path('reports' . DIRECTORY_SEPARATOR);
                $t = str_replace($path, '', $t);
                array_push($fileNames, $t);
            endforeach;
            return $fileNames;
        }
    }

    public function reportFactory($type, $fields, $data)
    {
        switch ($type) {
            case 'csv':
                return new CSVExporter($data, $fields, 'ApplicationReports');
                break;
            case 'json':
                return new JSONExporter($data);
                break;
            case 'txt':
                return new TxtExporter($data);
                break;
            case 'pdf':
                return new PDFExporter($data, $fields, 'applicationpdf');
                break;
            default:
                throw new \Exception("Method Not Allowed " . $type);
                break;
        }
    }

    public function sendEmail(EmailSendRequest $request)
    {
        try {
            //sends mail
            $this->sendMail($request);

            //makes email log of sent mail
            $this->makeLog($request);

            //makes note of sent mail
            $note = $this->makeNote($request);

            //saves file to database
            $this->attachFile($request, $note, 'notes', 'Sent');

            return $this->response("Mail send Succesfully.", 'view', 200);
        } catch (\Exception $e) {
            throw $e;
            return $this->response("Mail not sent.", 'view', 422);
        }

    }

    protected function sendMail(Request $request)
    {
        try {
            $obj = new \stdClass();
            $obj->subject = $request->subject;
            $obj->message = $request->message;
            $obj->attachment = [];
            if ($request->file):
                foreach ($request->file as $file):
                    array_push($obj->attachment, $file);
                endforeach;
            endif;
            $config = $this->getConfig();
            $mailer = new SwiftMailer();
            $mailer->overrideMailerConfig($config);;
            Mail::to($request->to)->send(new SendEmailFile($obj));
            $mailer->resetConfig();

        } catch (\Exception $e) {
            throw $e;
            return $this->response($e->getMessage(), 'view', 422);
        }

    }


    protected function getConfig()
    {
        if (auth()->check() && $emailsettings = auth()->user()->emailsettings) {
            $config = [
                'driver' => 'smtp',
                'host' => $emailsettings->server,
                'username' => $emailsettings->email,
                'password' => $emailsettings->password,
                'port' => '587',
                'encryption' => 'tls'
            ];
            return $config;
        }
        throw  new \Exception('Email Setting Not Found');
    }

    protected function makeNote(Request $request)
    {

        $id = $request->appid ? $request->appid : 0;
        $note = new Note();
        $note->table_name = $request->table ? $request->table : 'Application';
        $note->table_id = $id;
        $note->start = date('Y-m-d');
        $note->end = date('Y-m-d');
        $note->reminder_timestamp = date('Y-m-d');
        $note->activity = 'Email';
        $note->title = $request->subject;
        $note->notes = $request->message;
        $note->status = 'Success';
        $note->user_id = auth()->user()->id;
        $note->save();
        return $note;
    }

    protected function makeLog(Request $request)
    {
        $id = $request->appid ? $request->appid : 0;
        $emailLog = new EmailLog();
        $emailLog->table = $request->table ? $request->table : 'applications';
        $emailLog->table_id = $id;
        $emailLog->from = auth()->user()->email;
        $emailLog->to = $request->to;
        $emailLog->sub = $request->subject;
        $emailLog->msg = $request->message;
        $emailLog->sent_status = 'Success';
        $emailLog->sent_date = date('Y-m-d');
        $emailLog->save();

    }

    protected function attachFile(Request $request, $note, $table, $status)
    {

        if ($request->file):
            foreach ($request->file as $file1):
                $file = new File();
                $file->table = $table;
                $file->table_id = $note->id;
                $file->document_segment = $request->table;
                $file->document_type = 'File';
                $file->document_title = 'Exporter File Send';
                $file->file_name = $file1;
                $file->status = $status;
                $file->save();
            endforeach;
        endif;
    }

    public function viewFile(Request $request)
    {
        $path = storage_path('reports' . DIRECTORY_SEPARATOR . $request->file);
        return response()->file($path);
    }

    public function loadSaveEmail(Request $request)
    {
        $table = $request->table;
        $templates = SaveLoadEmail::where('section', $table)->get();
        return view($this->clayout . 'modal.loadEmail', compact('table', 'templates'));
    }

    public function loadSaveEmailAll(Request $request)
    {
        $perpage = $request->pagination['perpage'];
        $offset = ($request->pagination['page'] - 1) * $perpage;
        $result = DB::table('save_load_emails')
            ->select('save_load_emails.*')
            ->where('save_load_emails.section', $request->table)
            ->where('save_load_emails.is_deleted', 0);

        /* apply filter */
        $filter = new SaveLoadEmailFilter($request);
        $result = $filter->getQuery($result);
        $totalResult = count($result->get());

        if (isset($request->sort['field']))
            $result = $result->orderBy($request->sort['field'], $request->sort['sort']);
        if (!is_null($perpage))
            $result = $result->limit($perpage)->offset($offset);

        $result = $result->get();

//        $query = $request->datatable['query'] ? $request->datatable['query'] : false;


        $data = [
            'meta' => [
                'page' => $request->pagination['page'],
                'pages' => ceil($totalResult / $perpage),
                'perpage' => $perpage,
                'total' => $totalResult,
                'sort' => $request->sort['sort'],
                'field' => $request->sort['field']
            ],
            'data' => $result
        ];
        return $data;
    }

    public function saveEmailTemplate(Request $request)
    {
        $email = new SaveLoadEmail;
        $email->section = $request->table;
        $email->subject = $request->subject;
        $email->message = $request->message;
        if ($request->hasFile('file')):
            $email->attachment = true;
        else:
            $email->attachment = false;
        endif;
        $email->save();
        $this->attachFile($request, $email, 'save_load_emails', 'Draft');
        return $email->id;
    }

    public function saveTemplate($id)
    {
        $code = $this->getSession() ? $this->getSession() : '';
        return view($this->clayout . 'modal.saveEmail', compact('id', 'code'));
    }

    public function saveAsDraft(Request $request)
    {
        try {
            if ($request->subject == '' || $request->message == '')
                return $this->response('Some Fields are empty', 'view', 422);
            $email = new EmailLog;
            $email->table = $request->table;
            $email->table_id = 0;
            $email->from = $request->from;
            $email->to = $request->to;
            $email->sub = $request->subject ? $request->subject : 'Demo';
            $email->msg = $request->message;
            $email->sent_status = 'Draft';
            $email->sent_date = date('Y-m-d');
            $email->save();
            return $this->response('Email Save as Draft', 'view', 200);
        } catch (\Exception $e) {
            throw $e;
            return $this->response('Email doesnt save as Draft', 'view', 422);
        }
    }

    public function deleteEmail($id)
    {
        $email = SaveLoadEmail::find($id);
        $email->delete();
        return 'true';
    }

    public function save(Request $request, $id)
    {
        $email = $this->getCode($id);
        $email = $this->saveDraft($request, $email);
        $this->putInSession($id);

        return $this->response('Email Save Template', 'view', 200);
    }

    public function saveDraft(Request $request, SaveLoadEmail $email)
    {
        try {
            $email->section = $request->table;
            $email->subject = $request->subject;
            $email->message = $request->message;
            if ($request->hasFile('file')):
                $email->attachment = true;
            else:
                $email->attachment = false;
            endif;
            $email->save();
            $this->attachFile($request, $email, 'save_load_emails', 'Draft');
            return $email;
        } catch (\Exception $e) {
            throw $e;
            return $this->response('Email doesnt save as Draft', 'view', 422);
        }
    }

    public function select($id)
    {
        $email = SaveLoadEmail::find($id);
        $files = $email->files($id);
        $this->putInSession($email->code);
        return ['email' => $email, 'files' => $files];
    }

    public function getCode($code)
    {

        if ($code != '' && $emaildraft = SaveLoadEmail::where('code', $code)->first()) {
            return $emaildraft;
        } else {
            $emaildraft = new SaveLoadEmail();
            $emaildraft->code = $code;
            return $emaildraft;
        }
    }

    protected function putInSession($code)
    {
        session()->forget('template_name');
        session()->put('template_name', $code);
    }

    protected function removeSession()
    {
        session()->forget('template_name');
    }

    protected function getSession()
    {
        if ($code = session('template_name')) {
            return $code;
        }
        return false;
    }

    protected function deleteTemplate(SaveLoadEmail $emailTemplate)
    {
        $emailTemplate->delete();
        return $this->response('Email Template Deleted Successfully', 'view', 422);
    }

    public function emailSection()
    {
        return view($this->clayout . 'emailSection.email');
    }

    public function getEmailAll(Request $request, $status)
    {
        $perpage = $request->pagination['perpage'];
        $offset = ($request->pagination['page'] - 1) * $perpage;

        $result = DB::table('email__logs')
            ->select('email__logs.*')
            ->where('sent_status', $status)
            ->where('email__logs.is_deleted', false)->latest();
        $filter = new ClientFilter($request);
        $result = $filter->getQuery($result);
        $totalResult = count($result->get());

        if (isset($request->sort['field']))
            $result = $result->orderBy($request->sort['field'], $request->sort['sort']);
        if (!is_null($perpage))
            $result = $result->limit($perpage)->offset($offset);


        $result = $result->get();

        $data = [
            'meta' => [
                'page' => $request->pagination['page'],
                'pages' => ceil($totalResult / $perpage),
                'perpage' => $perpage,
                'total' => $totalResult,
                'sort' => $request->sort['sort'],
                'field' => $request->sort['field']
            ],
            'data' => $result
        ];
        return $data;
    }

    public function sentMail()
    {
        return view($this->clayout . 'emailSection.includes.sentMail');
    }

    public function draftMail()
    {
        return view($this->clayout . 'emailSection.includes.draftMail');
    }

    public function composeMail()
    {
        $from = auth()->user()->email;
        return view($this->clayout . 'emailSection.modal.compose', compact('from'));
    }

    public function viewSingle($id)
    {
        $email = EmailLog::find($id);
        return view($this->clayout . 'emailSection.modal.viewSingle', compact('email'));
    }
}
