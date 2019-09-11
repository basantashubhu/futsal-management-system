<?php


require_once 'connection.php';

dbBackup($host, $db_name, $db_user, $db_pass, $port);

function dbBackup($host, $db_name, $db_user, $db_pass, $port)
{
    /*---------------------check if database can be connected or not--------------------------*/
    $connect = new mysqli($host, $db_user, $db_pass, $db_name, $port);
    if ($connect->connect_error) {
        $errorMessage = "[" . date('Y-m-d H:i:s') . "] can't connect to database";
        errorLog($errorMessage);
        exit;
    } else {

        //take application into maitinance mode
        $command = 'php ' . BASE_PATH . DS . "artisan down";
        exec($command);

        date_default_timezone_set("America/New_York");
        $currentDateTime = date("Y-m-d H:i:s");

        if (!file_exists(STORAGE_PATH . DS . 'backup')) {
            mkdir(STORAGE_PATH . DS . 'backup');
        }

        $fileName = STORAGE_PATH . DS . "backup" . DS . "backup[$db_name]-" . date("Y-m-d-H-i-s") . '.sql';
        $command = "mysqldump --opt -h $host -u $db_user --port=$port --password=$db_pass $db_name  > $fileName";
        exec($command, $output);

        $command = 'php ' . BASE_PATH . DS . "artisan up";
        shell_exec($command);

        if (filesize($fileName) <= 120) {
            $errorData = file_get_contents($fileName);
            unlink($fileName);
            errorLog("[" . date('Y-m-d H:i:s') . "] " . $errorData);
        } else {
            $date = date_create($currentDateTime);
            $timeStamp = date_timestamp_get($date);
            storeSuccessData($timeStamp, $fileName);
        }
    }
}

/*------------Function to write error in error log-------------------*/
function errorLog($errorMessage)
{
    $file = fopen(LOG_PATH . DS . 'database_backup_error.log', 'a');
    $errorMessage = $errorMessage . PHP_EOL . '-----------------------------------------------------------------------------------------------------' . PHP_EOL;
    fwrite($file, $errorMessage);
    fclose($file);
    exit;
}

/*------------Function to Store Success Data Backup-------------------*/
function storeSuccessData($timeStamp, $fileName)
{
    $dataImportFile = LOG_PATH . DS . 'database_schedule_log.json';
    if (file_exists($dataImportFile)) {
        $data = file_get_contents($dataImportFile);
        $dataInArray = json_decode($data);
        $dataInArray->$timeStamp = $fileName;
        $jsonData = json_encode($dataInArray);
        file_put_contents($dataImportFile, $jsonData);
    } else {
        $dataInArray[$timeStamp] = $fileName;
        $jsonData = json_encode($dataInArray);
        file_put_contents($dataImportFile, $jsonData);
    }
}
