<?php


namespace App\Lib\Filter\EmailQueueFilter;


use App\Lib\Filter\AbstractFilter;

class SaveLoadEmailFilter extends AbstractFilter
{
	public function name($name = '')
    {
        if ($name != '') {
            return $this->builder->where('code', 'LIKE', "%$name%");
        }
        return $this->builder;
    }
}