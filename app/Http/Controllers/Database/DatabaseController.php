<?php


namespace App\Http\Controllers\Database;

use App\Http\Controllers\BaseController;
use App\Lib\Log\Log;

class DatabaseController extends BaseController
{
    private $clayout;
    const DS = DIRECTORY_SEPARATOR;

    public function __construct()
    {
        parent::__construct();
        $this->clayout = $this->layout . '.pages.database';
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view($this->clayout . '.index');
    }

    /**
     * @param $timeStamp
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function restoreConfirm($timeStamp)
    {
        return view($this->clayout . '.modal.restoreConfirm', compact('timeStamp'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function backupConfirm()
    {
        return view($this->clayout . '.modal.backupConfirm');
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        $logContent = $this->readDataFromFile();
        $data = [];
        $storagePath = addslashes(storage_path('backup' . DIRECTORY_SEPARATOR));
        if (!$logContent) {
            return $this->response("File not Found", "view", 500);
        }
        foreach ($logContent as $date => $fileName):
            $invData = [];
            date_default_timezone_set("America/New_York");
            $invData['date_time'] = date('Y-m-d H:i:s', $date);
            $invData['timestamp'] = $date;
            $invData['file_name'] = isset(explode('backup\\', $fileName)[1]) ? explode('backup\\', $fileName)[1] : $fileName;
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

    /**
     *
     */
    public function restore($timeStamp)
    {
        $command = 'php ' . base_path() . self::DS . "DBRestore.php " . $timeStamp;
        exec($command);
        return redirect('/');
    }

    public function backUpDB()
    {
        $command = 'php ' . base_path() . self::DS . "DBBackup.php 2>&1";
        exec($command, $output, $err);
    }

}
