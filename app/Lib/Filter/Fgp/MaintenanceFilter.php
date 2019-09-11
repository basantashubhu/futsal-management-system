<?php

namespace App\Lib\Filter\Fgp;


use App\Lib\Filter\AbstractFilter;

class MaintenanceFilter extends AbstractFilter
{
    public function label($query = false)
    {
        if ($query) {
            return $this->builder->where('label', 'LIKE', "%$query%");
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