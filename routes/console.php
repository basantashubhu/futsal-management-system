<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
 */

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('make:route {base}', function($base) {
    $filename = basename($base) . '.php';
    $dir = base_path('routes/'.str_replace(basename($base), '', $base));
    $dir = str_replace('\\', '/', $dir);
    if(!is_dir($dir)) {
        mkdir($dir, 0775, true);
    }
    if(!file_exists($dir . $filename)) {
        file_put_contents($dir.$filename, '<?php'. PHP_EOL . PHP_EOL);
    }
    $this->comment("Created route $filename on $dir");
});