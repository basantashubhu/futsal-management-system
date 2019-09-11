<?php


namespace App\Lib\Filter\ValidationFilter;


use App\Lib\Filter\AbstractFilter;

class ValidationFilter extends AbstractFilter
{
    public function section($query = false)
    {
        if ($query) {
            return $this->builder->where('section', 'LIKE', "%$query%");
        }
        return $this->builder;
    }
    public function sectionSelect($query = false)
    {
        if ($query) {
            return $this->builder->where('section', $query);
        }
        return $this->builder;
    }

    public function code($query = false)
    {
        if ($query) {
            return $this->builder->where('code', $query);
        }
        return $this->builder;
    }
}