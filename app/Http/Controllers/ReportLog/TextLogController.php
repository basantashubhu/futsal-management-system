<?php


namespace App\Http\Controllers\ReportLog;


use App\Http\Controllers\BaseController;
use App\Lib\Log\Log;
use App\Models\ReportLog;
use App\Repo\ReportLogRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TextLogController extends BaseController
{
    private $clayout;

    private static $repo = null;

    const DS = DIRECTORY_SEPARATOR;

    public function __construct()
    {
        parent::__construct();

        $this->clayout = $this->layout . '.pages.textLog';
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view($this->clayout . '.index');
    }

    /**
     *
     */
    public static function getInstance($model)
    {
        if (self::$repo == null)
            self::$repo = new ReportLogRepo($model);
        return self::$repo;
    }

    public function getAll(Request $request)
    {
        return self::getInstance('ReportLog')->selectDataTable($request);
    }
    public function getAllLog()
    {
        $logContent = $this->readDataFromFile();
        $data = [];
        $storagePath=addslashes(storage_path('backup'.DIRECTORY_SEPARATOR));
        if(!$logContent)
        {
            return $this->response("File not Found", "view", 500);
        }
        foreach ($logContent as $date => $fileName):
            $invData = [];
            date_default_timezone_set("America/New_York");
            $invData['date_time'] = date('Y-m-d H:i:s', $date);
            $invData['timestamp'] = $date;
            $invData['file_name'] = isset(explode('backup\\',$fileName)[1])?explode('backup\\',$fileName)[1]:$fileName;
            array_push($data, $invData);
        endforeach;
        return response()->json($data);
    }

    /**
     * @return $this|\Illuminate\Http\JsonResponse|mixed|string
     */
    private function readDataFromFile()
    {
        $file = 'database_schedule_log.json';
        $filePath = storage_path('logs' . self::DS . $file);
        if (file_exists($filePath)):
            $content = file_get_contents($filePath);
            $content = json_decode($content);
            return $content;
        else:
            return false;
        endif;
    }

    public function viewLog(ReportLog $reportLog)
    {
        $file = $reportLog->file_name;
        $filePath = storage_path('logs' . self::DS . $file);
        if (file_exists($filePath)):
            $content = file_get_contents($filePath);
            if (is_json($content)) {
                $content = json_decode($content);
                $content = json_encode($content, JSON_PRETTY_PRINT);
            }

            return view($this->clayout . '.modal.view', compact('content', 'reportLog'));
        else:
            return $this->response("File not Found", "view", 404);
        endif;
    }

    public function downLoadLog(ReportLog $reportLog)
    {
        $file = $reportLog->file_name;
        $path = storage_path('logs' . self::DS . $file);

        if (file_exists($path)):
            $headers = [
                'Content-Description' => 'File Transfer',
                'Content-Disposition' => 'attachment; filename="' . $file . '"',
                'Content-Transfer-Encoding' => 'binary',
                'Content-Type' => 'application/pdf'
            ];
            return response()->download($path, $file, $headers);

        else:
            return $this->response("File not Found", "view",404);
        endif;
        //dd($downloadAble);
    }

    public static function storeTextLog($textLog)
    {
        $log['report_type'] = 'text_log';
        $Log['report_Date']=date('Y-m-d');
        $log['report_name'] = $textLog['report_name'];
        $log['file_name'] = $textLog['file_name'];
        $log['userc_id']=Auth::check()?Auth::id():0;
        self::getInstance('ReportLog')->saveUpdate($log);
    }

    public function readLogMonitor($field)
    {
        if($field=='application')
            $fileName='ApplicationImportMonitor';
        elseif($field=='client')
            $fileName='ClientImportMonitor';
        elseif($field=='zip')
            $fileName='ZipImportMonitor';
        elseif($field=='breed')
            $fileName='BreedImportMonitor';
        elseif($field=='vet')
            $fileName='VetImportMonitor';
        elseif($field=='rate')
            $fileName='RateImportMonitor';
        elseif($field=='provider')
            $fileName='ProviderImportMonitor';
        else
            return $this->response('File not Found','view',404);

        $fileName=$fileName.'.txt';

        $full_path = env('APP_LOG_FILE_PATH', storage_path('logs'.DIRECTORY_SEPARATOR.'importer'));
        $full_path=$full_path.DIRECTORY_SEPARATOR.$fileName;

        if(!file_exists($full_path))
        {
            return $this->response('File not Found','view',404);
        }

        $log=new Log();

        $fileData=$log->read($full_path);
        $data=$this->readLatestData($fileData);
        return $this->response($data,'view',200);
    }

    public function readLatestData($fileData)
    {
        $data=explode('|',$fileData);
        $len=count($data);

        if($len!=1)
            return $data[$len-2];
        else
            return $data[0];
    }

}