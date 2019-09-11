<?php


namespace App\Lib\Prints;


use App\Lib\Capture\ScreenCapture;

class MainPrint
{
    public function makePdf($content)
    {
        $screenCapture = new ScreenCapture();
        $path = $screenCapture->load(htmlspecialchars_decode($content));
        $abPath = storage_path('uploads' . DIRECTORY_SEPARATOR);
        $path = str_replace($abPath, '', $path);
        return $path;

    }
}