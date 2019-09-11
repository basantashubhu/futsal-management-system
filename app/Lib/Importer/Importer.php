<?php


namespace App\Lib\Importer;


interface Importer
{
    public function convert();

    public function insertintoDB($table);
}