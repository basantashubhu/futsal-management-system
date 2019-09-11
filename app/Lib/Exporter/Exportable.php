<?php


namespace App\Lib\Exporter;


interface Exportable
{
    public function export();

    public function getFile();
}