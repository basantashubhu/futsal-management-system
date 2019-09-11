<?php

namespace App\Lib\Filter\Fgp;


use App\Lib\Filter\AbstractFilter;

class LocationFilter extends AbstractFilter
{
    public function advancedFilter($data = false)
    {
        $vol_name = '';
        $cellPhone = '';
        $email = '';
        $ssnFilter = '';
        $add1 = '';
        $city = '';
        $zipCode = '';
        $supervisor = [];
        if ($data):
            foreach ($data as $d):
                if ($d['name'] == 'vol_name'):
                    $vol_name = $d['value'];
                elseif ($d['name'] == 'cellPhone'):
                    $cellPhone = $d['value'];
                elseif ($d['name'] == 'email'):
                    $email = $d['value'];
                elseif ($d['name'] == 'ssnFilter'):
                    $ssnFilter = $d['value'];
                elseif ($d['name'] == 'add1'):
                    $add1 = $d['value'];
                elseif ($d['name'] == 'city'):
                    $city = $d['value'];
                elseif ($d['name'] == 'zipCode'):
                    $zipCode = $d['value'];
                elseif ($d['name'] == 'supervisor[]'):
                    if(isset($d['value'])){
                        array_push($supervisor, $d['value']);
                    }else{
                        $supervisor =[];
                    }
                endif;
            endforeach;
        endif;

        if ($vol_name)
            $this->vol_name($vol_name);

        if ($cellPhone)
            $this->cellPhone($cellPhone);

        if ($email)
            $this->email($email);

        if ($supervisor)
            $this->supervisor($supervisor);

        if ($ssnFilter)
            $this->ssnFilter($ssnFilter);

        if ($add1)
            $this->add1($add1);
        if ($city)
            $this->city($city);
        if ($zipCode)
            $this->zipCode($zipCode);
    }

    public function city($query = false)
    {
        if ($query) {
            return $this->builder->where('city', 'LIKE', "%$query%");
        }
        return $this->builder;
    }
    public function zip($query = false)
    {
        if ($query) {
            return $this->builder->where('zip_code', 'LIKE', "%$query%");
        }
        return $this->builder;
    }
    public function county($query = false)
    {
        if ($query) {
            return $this->builder->where('county', 'LIKE', "%$query%");
        }
        return $this->builder;
    }
    public function district($query = false)
    {
        if ($query) {
            return $this->builder->where('district', 'LIKE', "%$query%");
        }
        return $this->builder;
    }
}