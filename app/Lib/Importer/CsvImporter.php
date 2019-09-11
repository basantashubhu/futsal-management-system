<?php

namespace App\Lib\Importer;

use Illuminate\Support\Facades\DB;

class CsvImporter implements Importer
{
    public $file, $total;
    public $datas = array();
    /**
     * @var array|false|null
     */
    public $header;

    /**
     * CsvImporter constructor.
     * @param $file
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    public function convert($delimiter = ',')
    {

        if (!file_exists($this->file) || !is_readable($this->file)) {
            throw new \Exception('File Not Found or the file is corrupted. Please try again with another file');
        }

        $dynamicHead = function ($head) {
            return preg_replace('![^a-zA-Z0-9_]*!', '', $head);
        };

        $header = null;
        $data = array();
        if (($handle = fopen($this->file, 'r')) !== false) {

            while (($row = fgetcsv($handle, 10000, $delimiter)) !== false) {

                if (!$header) {
                    $header = array_map('strtolower', $row);
                    $header = array_map($dynamicHead, $header);
                } else {
                    $data[] = array_combine($header, $row);
                }
            }

            fclose($handle);
        }
        $this->header = $header;
        $this->datas = $data;
        $this->total = count($data);
        return $this;
    }

    public function getSingleIndex($index)
    {
        $this->convert();
        $count = 1;
        foreach ($this->datas as $data) {
            if (++$count == $index) {
                return $data;
            }
        }
    }

    public function total()
    {
        return $this->total;
    }

    public function insertintoDB($table)
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table($table)->truncate();
        foreach ($this->datas as $data) {
            \DB::table($table)->insert($data);
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        return $this;
    }

    /**
     * @return array
     */
    public function getDatas(): array
    {
        return $this->datas;
    }

}
