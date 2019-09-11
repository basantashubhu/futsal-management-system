<?php


namespace App\Lib\Exporter;


class Exporter
{

    public $exporter;

    public function __construct(Exportable $exporter)
    {
        $this->exporter = $exporter;
    }

    public function export()
    {
        $this->exporter->export();
        return $this->exporter->getFile();
    }

    public function getFilename(){
        return $this->exporter->getFilename();

    }
}