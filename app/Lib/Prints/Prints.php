<?php


namespace App\Lib\Prints;


use App\Exceptions\TemplateNotFound;
use App\Lib\Capture\ScreenCapture;
use App\Lib\Template\TemplateMerge;
use App\Models\EmailTemplate;

class Prints
{

    protected $template, $data = array(), $code;


    public function __construct($code, $data)
    {

        $this->code = $code;
        $this->data = $data;

    }

    protected function merge()
    {
        $this->template = TemplateMerge::makeTemplate($this->template, $this->data);
        return $this;
    }

    protected function getTemplateFromDB()
    {
        if ($temp = EmailTemplate::where('temp_code', $this->code)->first()) {
            $this->template = $temp;
            return $this;
        }
        throw  new TemplateNotFound($this->code . ' template is not found in the database', 404);
    }


    public function getTemplate()
    {
        return $this->template;
    }


    public function mergeTemplate()
    {
        $this->getTemplateFromDB()->merge();
    }
    public static function mergePrint($code, $data = array())
    {
        $print = new static($code, $data);
        $print->mergeTemplate();
        return $print->getTemplate();
    }
}