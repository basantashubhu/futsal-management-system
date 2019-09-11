\<?php



require_once('connection.php');
$timeStamp=$argv[1];

restore($timeStamp,$host,$port,$db_name,$db_user,$db_pass);

/*-------------function to restore db--------------------*/
function restore($timeStamp,$host,$port,$db_name,$db_user,$db_pass)
{
    /*---------------------check if database can be connected or not--------------------------*/
    $connect = new mysqli($host, $db_user, $db_pass, $db_name,$port);
    if ($connect->connect_error) {
        $errorMessage = "[" . date('Y-m-d H:i:s') . "] can't connect to database";
        errorLog($errorMessage);
        exit;
    }

    //Down The Application
    $command='php ' . BASE_PATH . DS . "artisan down";
    backUpDB(); //take Back up of current DB

    $logContent = readDataFromFile();
    $fileName = $logContent->$timeStamp;

    try {
        $output=restoreDatabase($fileName,$host,$port,$db_name,$db_user,$db_pass);
//        $command='php ' . BASE_PATH . DS . "artisan up";
//        shell_exec($command);
    } catch (\Exception $e) {

    }

}

function errorLog($errorMessage)
{
    $file = fopen(LOG_PATH . DS . 'database_backup_error.log', 'a');
    $errorMessage = $errorMessage . PHP_EOL . '-----------------------------------------------------------------------------------------------------' . PHP_EOL;
    fwrite($file, $errorMessage);
    fclose($file);
    exit;
}

//backup the Current DB
function backUpDB()
{
    $command = 'php ' . __DIR__ . DS . "DBBackup.php 2>&1";
    exec($command);
}

function readDataFromFile()
{
    $file = 'database_schedule_log.json';
    $filePath = LOG_PATH. DS . $file;
    if (file_exists($filePath)):
        $content = file_get_contents($filePath);
        $content = json_decode($content);
        return $content;
    else:
        return $this->response("File not Found", "view", 404);
    endif;
}

/*restore DB from previous full backup*/

function restoreDatabase($fileName,$host,$port,$db_name,$db_user,$db_pass)
{
    $command = "mysql -h $host -u $db_user --port=$port --password=$db_pass $db_name < $fileName". " 2>&1";
    $res=exec($command,$output);
    return $res;
}
