<?php


namespace App\Lib\Exporter;


use App\Lib\Capture\ScreenCapture;

class PDFExporter implements Exportable
{
    protected $filename, $data, $field, $status = false, $file, $printview, $fileOriginalName;
    protected $folder = 'reports';
    protected $orientation = 'landscape';

    /**
     * CSVExporter constructor.
     * @param $filename
     * @param $data
     */
    public function __construct($data, $field, $blade, $filename = '', $orientation = 'landscape')
    {
        $filename = $filename == '' ? random_string() : $filename;
        $this->filename = $filename;
        $this->data = $data;
        $this->field = $field;
        $this->printview = 'default.print.' . $blade;
        $this->orientation = $orientation;
    }

   


    /**
     * @return $this
     */
    public function export()
    {
        $fields = $this->field;
        $datas = $this->data;
        $content = view($this->printview, compact('fields', 'datas'));
        $this->file = $this->makePdf($content);
        $this->status = true;
        return $this;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getFile()
    {
        if ($this->status) {
            return $this->file;
        }
        throw new \Exception('File not Formed Status with name ' . $this->filename);
    }

    /*
    *
    *   Get  the filename only : rakesh shrestha
    *
    */

    public function getFileName(){
        return $this->fileOriginalName;
    }

    public function makePdf($content)
    {
        $screenCapture = new ScreenCapture();
        $unq_id = md5(uniqid());
        $this->fileOriginalName = $unq_id;

        $abPath = storage_path($this->folder . DIRECTORY_SEPARATOR);
        if (!is_dir(storage_path($this->folder))) {
            mkdir($abPath, 777);
        }

        $fullPath = $path = storage_path('reports' . DIRECTORY_SEPARATOR . $unq_id . '.pdf');
        
        $path = $screenCapture->load($content, $this->orientation,$fullPath);

        //$path = str_replace($abPath, '', $path);
        return $path;
    }

    public static function pdfExport($field,$data,$fileName, $mode)
    {
        if (!file_exists(storage_path('reports'))) {
            mkdir(storage_path('reports'), 0777, true);
        }
        $path = storage_path('reports');

        $fileName = $fileName . uniqid(date('_Y_m_d_H_i_s_')) . '.pdf';
        $fullPath = $path . DIRECTORY_SEPARATOR . $fileName;

        $view = view('default.print.reportPdf', compact('field', 'data'));
        $screenCapture = new ScreenCapture();
        $path = $screenCapture->load($view, $mode,$fullPath);
        return $fileName;
    }
}