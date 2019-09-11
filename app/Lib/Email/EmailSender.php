<?php


namespace App\Lib\Email;


use App\Http\Controllers\Application\ProcessController;
use App\Http\Controllers\Email_Log\EmailLogController;
use App\Http\Controllers\Note\NoteController;
use App\Http\Controllers\Organization\OrganizationProcessController;
use App\Http\Requests\NoteRequest;
use App\Lib\Queue\EmailQueue;
use App\Models\Application;
use App\Models\Organization;
use App\Models\User;
use App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class EmailSender
{
    private $process;

    public function __construct($from = 'application')
    {
        if ($from == 'application')
            $this->process = new ProcessController();
        else
            $this->process = new OrganizationProcessController();
    }

    public function sendEmail($mailer, $to, $data, $processName = "", $attachment = "", $model = 'application')
    {
        if (getSiteSettings('email_mode') == 'queue') {
            $emailqueue = new EmailQueue($mailer, $to, $data, $processName, $attachment, $model);
            $emailqueue->InsertintoDb();
            return $this;
        } else {
            return $this->send($mailer, $to, $data, $processName, $attachment, $model);
        }
    }


    public function send($mailer, $to, $data, $processName = "", $attachment = "", $model)
    {
        if (array_key_exists(0, $data)):
            $id = $data[0]['id'];
        else:
            $id = $data['id'];
        endif;
        $modelObj = $data;
        if ($data instanceof Model)
            $arrData = $data->getAttributes();
        else {
            $arrData = $data;
            if ($model == 'application')
                $modelObj = Application::find($id);
            elseif ($model == 'organization')
                $modelObj = Organization::find($id);
            elseif ($model == 'users')
                $modelObj = User::find($id);
            elseif ($model == 'clients')
                $modelObj = Client::find($id);
        }

        try {
            Mail::to($to)->send(EmailFactory::getMailer($mailer, $arrData, $attachment));
            $this->makeLog($modelObj, $to, 'Success');
            $this->makeNote($modelObj, $processName);
            if ($processName != "") {
                $this->process->changeProcessStatus($modelObj, $processName);
            }
            return true;

        } catch (\Exception $e) {
            ;
            $reason = $e->getMessage();
            $this->makeLog($modelObj, $to, 'Failure', $reason);
            //return false;
            throw  $e;

        }
    }

    public function makeNote($model, $processName)
    {
        $note = new NoteController();
        $data['table_name'] = $model->getTable();
        $data['table_id'] = $model->id;
        $data['note_type'] = 'Email Note';
        $data['activity'] = 'Email';
        $data['start'] = date('y-m-d H:i:s');
        $data['end'] = date('y-m-d H:i:s');
        $data['title'] = $processName;
        $data['notes'] = $processName !== '' ? $processName : 'Email send';
        $data['status'] = 'done';
        $note->noteStore(new NoteRequest($data));
    }

    private function makeLog($model, $to, $status, $reason = null)
    {
        if ($model instanceof Model) {
            $data['table'] = $model->getTable();
            $data['table_id'] = $model->id;
        } else {
            $data['table'] = 'dummy';
            $data['table_id'] = 1;
        }
        $data['from'] = env('MAIL_FROM_ADDRESS', 'hello@example.com');
        $data['to'] = $to;
        $data['sub'] = ucfirst($model->getTable()) . ' Status Changed';
        $data['msg'] = $reason != null ? $reason : "test";
        $data['sent_status'] = $status;
        $data['sent_date'] = date('Y-m-d H:i:s');

        /*----------Add to Log----------------*/
        $emailLog = new EmailLogController();
        $emailLog->store($data);
    }
}