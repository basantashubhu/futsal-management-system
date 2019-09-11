<?php

namespace App\Http\Controllers\PDF;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Lib\PDF\PDFParser;

class PDFController extends BaseController
{
    public function index(Request $request)
    {
        if($request->file()) {
            $files = $request->file();
            foreach ($files as $key => $file) {
                $pdfDetail = new PDFParser($file);
                var_dump($pdfDetail);
            }
        }
    }
}
