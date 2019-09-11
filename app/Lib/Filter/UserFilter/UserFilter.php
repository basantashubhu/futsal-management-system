<?php


namespace App\Lib\Filter\UserFilter;


use App\Lib\Filter\AbstractFilter;

class UserFilter extends AbstractFilter
{
    public function name($name = false)
    {
        if ($name) {
            return $this->builder->where('users.name', 'LIKE', "%$name%");
        }
        return $this->builder;
    }
    public function email($name = false)
    {
        if ($name) {
            return $this->builder->where('users.email', 'LIKE', "%$name%");
        }
        return $this->builder;
    }
    public function role($name = false)
    {
        if ($name) {
            return $this->builder->where('roles.label', 'LIKE', "%$name%");
        }
        return $this->builder;
    }

}