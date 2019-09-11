<?php

namespace App\Lib\Filter\Fgp;


use App\Lib\Filter\AbstractFilter;

class EmailLogFilter extends AbstractFilter
{
    public function from($query = false)
    {
        if ($query) {
            return $this->builder->where('from', 'LIKE', "%$query%");
        }
        return $this->builder;
    }
    public function to($query = false)
    {
        if ($query) {
            return $this->builder->where('to', 'LIKE', "%$query%");
        }
        return $this->builder;
    }
    public function subject($query = false)
    {
        if ($query) {
            return $this->builder->where('subject', 'LIKE', "%$query%");
        }
        return $this->builder;
    }
}