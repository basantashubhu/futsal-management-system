<?php


namespace App\Lib\Importer;


class Import
{
    protected $model;

    public function __construct(Importable $importer)
    {
        $this->model = $importer;
    }

    public function import()
    {
        $this->model->import();
    }
}