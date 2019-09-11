<?php

namespace App\Lib\Filter\Fgp;


use App\Lib\Filter\AbstractFilter;

class HighVolumeHeaderFilter extends AbstractFilter
{

    public function label($query = false)
    {
        if ($query) {
            return $this->builder->where('high_volume_headers.label', 'LIKE', "%$query%");
        }
        return $this->builder;
    }

    public function code($query = false)
    {
        if ($query) {
            return $this->builder->where('high_volume_headers.code', 'LIKE', "%$query%");
        }
        return $this->builder;
    }
    public function mapping_key($query = false)
    {
        if ($query) {
            return $this->builder->where('high_volume_headers.mapping_key', 'LIKE', "%$query%");
        }
        return $this->builder;
    }
}