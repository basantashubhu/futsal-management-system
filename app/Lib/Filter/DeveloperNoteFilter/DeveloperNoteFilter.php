<?php


namespace App\Lib\Filter\DeveloperNoteFilter;


use App\Lib\Filter\AbstractFilter;

class DeveloperNoteFilter extends AbstractFilter
{
    public function status($status = '')
    {
        if ($status != '') {
            return $this->builder->whereIn('is_done', $status);
        }
        return $this->builder;
    }

}