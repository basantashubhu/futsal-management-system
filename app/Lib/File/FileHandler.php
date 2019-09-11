<?php


namespace App\Lib\File;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
class FileHandler
{
    public static function returnFile($path)
    {
        if (extension_loaded('fileinfo')) {
            if (!File::exists($path)) {
                abort(404);
            }

            $file = File::get($path);
            $type = File::mimeType($path);

            $response = Response::make($file, 200);
            $response->header("Content-Type", $type);

            return $response;
        }
        else{
            abort(412,'please enable the fileinfo extension or contact site administration');
        }
    }
}