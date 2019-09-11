<?php


namespace App\Lib\Filter\UserFilter;


use App\Lib\Filter\AbstractFilter;

class UserlogFilter extends AbstractFilter
{

    public function name($name = false)
    {
        if ($name) {
            return $this->builder->where('users.name', 'LIKE', '%'.$name.'%');
        }
        return $this->builder;
    }

    public function fingerprint($query = false)
    {
        if ($query) {
            return $this->builder->where('fingerprint', 'LIKE', "%$query%");
        }
        return $this->builder;
    }

    public function browser($query = false)
    {
        if ($query) {
            return $this->builder->where('browser', 'LIKE', "%$query%");
        }
        return $this->builder;
    }

    public function os($query = false)
    {
        if ($query) {
            return $this->builder->where('os', 'LIKE', "%$query%");
        }
        return $this->builder;
    }

}