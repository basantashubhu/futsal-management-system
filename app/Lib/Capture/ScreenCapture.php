<?php


namespace App\Lib\Capture;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Process\Process;

class ScreenCapture
{
    private $layout;
    private $pdf;

    public function __construct()
    {
        $this->layout = config('site.template');
    }

    /**
     * @param $view
     * @return string
     */
    public function load($view, $mode = 'portrait', $path='')
    {
        $time = strlen($view)/180000;
        // dd($time);
        $time = number_format($time,0) * 1000;
        if(strlen($view) < 180000){
            $time = 1000;
        }
        $this->pdf = $this->captureImage($view, $mode,$path, $time);
        return $this->pdf;
        //$this->response('export.pdf');
    }

    /**
     * @param $filename
     */
    public function response($filename)
    {

        $response = new Response(file_get_contents($this->pdf), 200, [
            'Content-Description' => 'File Transfer',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Content-Transfer-Encoding' => 'binary',
            'Content-Type' => 'application/pdf'
        ]);
//

        //return $response->send();
    }

    /**
     * @param $view
     * @return string
     */
    private function captureImage($view, $mode,$path, $time)
    {
        $filePath = $this->writeFile($view,$path);

        //$thisfileP>phantomProcess($path)->setTimeout(10)->mustRun();
        $this->phantomProcess($filePath, $mode, $time);
        return $filePath;
    }

    /**
     * @param $view
     * @return string
     */
    private function writeFile($view,$path='')
    {
        if($path=='')
            $path = storage_path('uploads' . DIRECTORY_SEPARATOR . md5(uniqid()) . '.pdf');
        file_put_contents($path, $view);
        return $path;
    }

    /**
     * @param $path
     * @return Process
     */
    private function phantomProcess($path, $mode, $time)
    {
        if (is_array($mode)):
            $command = app_path() . DIRECTORY_SEPARATOR . 'Lib' . DIRECTORY_SEPARATOR . 'Capture' . DIRECTORY_SEPARATOR . 'bin' . DIRECTORY_SEPARATOR . 'phantomjs ' . app_path() . DIRECTORY_SEPARATOR . 'Lib' . DIRECTORY_SEPARATOR . 'Capture' . DIRECTORY_SEPARATOR . 'timeCapture.js ' . $path . " $time";
        elseif ($mode == 'landscape'):
            $command = app_path() . DIRECTORY_SEPARATOR . 'Lib' . DIRECTORY_SEPARATOR . 'Capture' . DIRECTORY_SEPARATOR . 'bin' . DIRECTORY_SEPARATOR . 'phantomjs ' . app_path() . DIRECTORY_SEPARATOR . 'Lib' . DIRECTORY_SEPARATOR . 'Capture' . DIRECTORY_SEPARATOR . 'capture.js ' . $path;
        elseif($mode == 'no_footer'):
            $command = app_path() . DIRECTORY_SEPARATOR . 'Lib' . DIRECTORY_SEPARATOR . 'Capture' . DIRECTORY_SEPARATOR . 'bin' . DIRECTORY_SEPARATOR . 'phantomjs ' . app_path() . DIRECTORY_SEPARATOR . 'Lib' . DIRECTORY_SEPARATOR . 'Capture' . DIRECTORY_SEPARATOR . 'newcapture.js ' . $path;
        else:
            $command = app_path() . DIRECTORY_SEPARATOR . 'Lib' . DIRECTORY_SEPARATOR . 'Capture' . DIRECTORY_SEPARATOR . 'bin' . DIRECTORY_SEPARATOR . 'phantomjs ' . app_path() . DIRECTORY_SEPARATOR . 'Lib' . DIRECTORY_SEPARATOR . 'Capture' . DIRECTORY_SEPARATOR . 'footer_capture.js ' . $path;
        endif;
        return shell_exec($command);
        //return new Process($command);
    }
}