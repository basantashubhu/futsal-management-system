<?php


namespace App\Lib\Queue;


use App\Models\Application;
use App\Models\Organization;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EmailQueue
{
    private $table = "email_queues";
    protected $mailDetails = array();
    private $appid, $clientid, $to,$model;

    /**
     * EmailQueue constructor.
     * @param $mailer
     * @param $to
     * @param $data
     * @param string $processName
     * @param string $attachment
     */
    public function __construct($mailer, $to, $data, string $processName = "", string $attachment = "", $model)
    {
        $this->mailDetails['mailer'] = $mailer;
        $this->mailDetails['to'] = $to;
        $this->mailDetails['data'] = $data;
        $this->mailDetails['processName'] = $processName;
        $this->mailDetails['attachment'] = $attachment;
        $this->mailDetails['model'] = $model;
        $this->model = $model;
        if (array_key_exists('id',$this->mailDetails['data'])){

            $this->appid = $this->mailDetails['data']['id'];
        }
        else{
            $this->appid= 0;
        }
        if ($model == 'application'):
            $application = Application::find($this->appid);
            $this->clientid = $application->client->id;
        elseif ($model == 'organization'):
            $organization = Organization::find($this->appid);
        if ($organization && $organization->contactPerson){
            $this->clientid = $organization->contactPerson->id;
        }
        else{
            $this->clientid = 1;

        }
        endif;
    }

    public function InsertintoDb()
    {

        $data = array(
            'name' => $this->mailDetails['processName'],
            'payload' => json_encode($this->mailDetails),
            'to' => $this->mailDetails['to'],
            'table_name'=>$this->model,
            'application_id' => $this->appid,
            'client_id' => $this->clientid,
            'reserved_at' => Carbon::now(),
            'created_at' => Carbon::now()
        );
        $insetion = DB::table($this->table)->insert($data);
        return $insetion;
    }
}