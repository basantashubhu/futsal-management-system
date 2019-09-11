<?php


namespace App\Lib\Filter\ClientApiFilter;


use App\Lib\Filter\AbstractFilter;

class ClientApiFilter extends AbstractFilter
{

    public function cname($name = false)
    {
        if ($name) {
            return $this->builder->where('users.name', 'LIKE', "%$name%");
        }
        return $this->builder;
    }

    public function kname($name = false)
    {
        if ($name) {
            return $this->builder->where('oauth_clients.name', 'LIKE', "%$name%");
        }
        return $this->builder;
    }

    public function rurl($url = false)
    {
        if ($url) {
            return $this->builder->where('oauth_clients.redirect', 'LIKE', "%$url%");
        }
        return $this->builder;
    }
    public function AID($id = false)
    {
        if ($id) {
            return $this->builder->where('oauth_clients.id', $id);
        }
        return $this->builder;
    }

}