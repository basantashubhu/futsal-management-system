<?php

namespace App\Http\Controllers\Prints;

use App\Http\Controllers\BaseController;
use App\Lib\Capture\ScreenCapture;
use App\Lib\Prints\AppPrint;
use App\Lib\Prints\OrgPrint;
use App\Lib\Prints\Printable;
use App\Lib\Prints\Prints;
use App\Models\Application;
use App\Models\Organization;
use Illuminate\Http\Request;

class PrintController extends BaseController
{
    protected $printview;
    protected $pdf = false;

    public function __construct()
    {
        parent::__construct();
        $this->printview = $this->layout . '.print.print';
    }

    public function performPrint($model, $id)
    {
        $model = $this->PrintFactory($model);
        $print = $model->print($id);
        $content = view($this->printview, compact('print'));
        if ($this->pdf) {
            $path = $model->makePdf($content);
        } else {
            return $content;
        }
    }

    public function PrintFactory($class)
    {
        switch ($class) {
            case 'application':
                $model = new AppPrint();
                break;
            case 'organization':
                $model = new  OrgPrint();
                break;
            default:
                throw new \Exception('Model' . $class . ' Not Found Exception');
                break;
        }
        return $model;
    }

}
