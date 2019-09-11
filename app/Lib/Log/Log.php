<?php


namespace App\Lib\Log;


use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ReportLog\TextLogController;
use App\Mail\Log\LogMail;
use Illuminate\Support\Facades\Auth;

class Log
{

    /**
     * *  Set whether to send Log Email
     * @var bool
     */
    public static $sendEmail = true;


    /**
     * *Logs the given data in to the folder
     * @param string $data ('to be included in the log')
     * @param string $filename )
     * @param array $folders (sub folder made by the later index of this array)
     *
     */
    public static function log($data, $filename = '', array $folders = array())
    {
        $data = '[' . date('Y-m-d-H-i-s', time()) . '] ' . $data . "\r\n";
        //$log = new static;
        self::save($data, $filename, $folders);
        //$log->save($data, $filename, $folders);
        TextLogController::storeTextLog(['report_name'=>$filename,'file_name'=>$filename]);
        if (self::$sendEmail) self::sendMail($data);
    }
    public static function makeLog($data, $filename = '', array $folders = array())
    {
        $data = '[' . date('Y-m-d-H-i-s', time()) . '] ' . $data . "\r\n";
        //$log = new static;
        self::save($data, $filename, $folders);
        //$log->save($data, $filename, $folders);
        TextLogController::storeTextLog(['report_name'=>$filename,'file_name'=>$filename]);
        if (self::$sendEmail) self::sendMail($data);
    }
    /**
     * *Saves the log with given $data into log file
     * string $data ('to be included in the log')
     * @param string $filename )
     * @param array $folders (sub folder made by the later index of this array)
     *
     * @return boolean
     */

    public function save($data, $filename, $folders,$flag='a')
    {
        $filename = ($filename !== "") ? $filename . '.txt' : 'log-' . date('Y-m-d-H-i-s') . '.txt';
        defined('DS') or define('DS', DIRECTORY_SEPARATOR);
        $full_path = env('APP_LOG_FILE_PATH', storage_path() . '\logs');

        foreach ($folders as $folder) {
            $full_path = $full_path . DS . $folder;
            $path = realpath($full_path);
            if ($path !== false && is_dir($path)):
                $var = 0;
            else:
                mkdir($full_path, 777); //Makes the folder if not available
            endif;
        }

        $log_file = $full_path . DS . $filename;
        $this->fileAction($flag, $log_file, $data);
        TextLogController::storeTextLog(['report_name'=>$filename,'file_name'=>$filename]);
        return true;

    }

    /**
     * * Does the default needed action
     * @param string $method (eg a,r,w)
     * @param string $file
     * @param string $data
     * @return bool|int|string
     */
    protected function fileAction($method, $file, $data = '')
    {
        $fh = fopen($file, $method); //Write the data to the file
        if ($method == 'a' || $method == 'w')
            $fdata = fwrite($fh, $data);//Write the data to the file
        else
            $fdata = fread($fh, filesize($file));
        fclose($fh);
        return $fdata;
    }

    /**
     * *Send Log mail as Email
     * @param $data
     */
    public function sendMail($data)
    {
//         \Mail::to(env('APP_EXCEPTION_RECEIVER_EMAIL','kchaulagain@datatrax.net'))->send(new LogMail($data));
    }

    /**
     *logic to read File
     */
    public function read($fileName)
    {
        $data=$this->fileAction('r',$fileName);
        return $data;
    }
}