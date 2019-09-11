<?php
require __DIR__ . "/vendor/autoload.php";

$env = new \Dotenv\Dotenv(__DIR__);
$env->load();

/*--------DEFINING CONSTANT VAIRABLE---------------*/
define('DS', DIRECTORY_SEPARATOR);
define('LOG_PATH', __DIR__ . DS . 'storage' . DS . 'logs');
define('STORAGE_PATH', __DIR__ . DS . 'storage');
define('BASE_PATH', __DIR__);

/*-------------------Setting UP DB CONNECTION PROPERTY--------------------------*/
$host = getenv('DB_HOST');
$port = getenv('DB_PORT');
$db_name = getenv('DB_DATABASE');
$db_user = getenv('DB_USERNAME');
$db_pass = getenv('DB_PASSWORD');
