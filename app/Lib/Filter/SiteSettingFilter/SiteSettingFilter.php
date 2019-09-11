<?php


namespace App\Lib\Filter\SiteSettingFilter;


use App\Lib\Filter\AbstractFilter;

class SiteSettingFilter extends AbstractFilter
{
    public function code($query = false)
    {
        if ($query) {
            return $this->builder->where('code', 'LIKE', "%$query%");
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