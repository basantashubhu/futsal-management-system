<?php


namespace App\Lib\Template;


use App\Models\EmailTemplate;

class TemplateMerge
{
    public $template, $data;

    public function __construct(String $template, $data)
    {
        $this->template = htmlspecialchars($template);
        $this->data = $data;

    }

    /**
     * @return mixed
     */
    public function getTemplate()
    {
        return htmlspecialchars_decode($this->template); //here
    }


    public function merge()
    {
        $temp = $this->template;
        foreach ($this->data as $key => $val):
            $temp = str_replace("{" . $key . "}", $val, $temp);
        endforeach;
        $this->template = $temp;
        return $this;
    }

    public static function makeTemplate(EmailTemplate $template, $data)
    {
        $template = new static($template->temp_html, $data);

        return $template->merge()->getTemplate();
    }

    public static function makeTempTemplate($template, $data)
    {
        $template = new static($template, $data);

        return $template->merge()->getTemplate();
    }
}