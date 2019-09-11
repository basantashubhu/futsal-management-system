<?php


namespace App\Lib\Exporter;


class TxtExporter implements Exportable
{

    protected $filename, $data, $status = false, $file;
    protected $folder = 'reports';

    /**
     * CSVExporter constructor.
     * @param $filename
     * @param $data
     */
    public function __construct($data, $filename = '')
    {
        $filename = $filename == '' ? random_string() : $filename;
        $this->filename = $filename;
        $this->data = $data;
    }

    /**
     * @return $this|bool
     * @throws \Exception
     */
    public function export()
    {
        $path = storage_path($this->folder);

        $fileName = $this->filename . uniqid(date('_Y_m_d_')) . '.txt';
        $fullPath = $path . DIRECTORY_SEPARATOR . $fileName;
        if (! is_dir($path)) {
            mkdir($path, 777);
        }
        $data = json_encode($this->data, JSON_PRETTY_PRINT);

        try {
            $file = fopen($fullPath, 'w');
            fwrite($file, $data);
            fclose($file);
            $this->status = true;
            $this->file = $fullPath;
        } catch (\Exception $e) {
            throw  $e;

            return false;
        }
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

}