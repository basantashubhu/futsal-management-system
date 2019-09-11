<?php


namespace App\Lib\Filter\TextLogFilter;


use App\Lib\Filter\AbstractFilter;

class TextLogFilter extends AbstractFilter
{
    public function user($query = false)
    {
        if ($query) {
            return $this->builder->where('users.name', $query);
        }
        return $this->builder;
    }

    public function file($query = false)
    {
        if ($query) {
            return $this->builder->where('file_name', 'LIKE', "%$query%");
        }
        return $this->builder;
    }

}