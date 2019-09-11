<?php


namespace App\Lib\Filter\LookUpFilter;


use App\Lib\Filter\AbstractFilter;

class LookUpFilter extends AbstractFilter
{
    public function section($query = false)
    {
        if ($query) {
            $query = is_array($query) ?  array_shift($query) : $query;
            return $this->builder->where('section', 'LIKE', "%$query%");
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

    public function value($query = false)
    {
        if ($query) {
            return $this->builder->where('value', 'LIKE', "%$query%");
        }
        return $this->builder;
    }
}