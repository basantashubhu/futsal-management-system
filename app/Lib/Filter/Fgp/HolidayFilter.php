<?php

namespace App\Lib\Filter\Fgp;


use App\Lib\Filter\AbstractFilter;

class HolidayFilter extends AbstractFilter
{
    public function advancedFilter($data = false)
    {
        $name = '';
        $type = '';
        $eto_eli = "";
        $state = [];
        if ($data):
            foreach ($data as $d):
                if ($d['name'] == 'name'):
                    $name = $d['value'];
                elseif ($d['name'] == 'state'):
                    $state = $d['value'];
            
                elseif ($d['name'] == 'type[]'):
                    if(isset($d['value'])){
                        array_push($type, $d['value']);
                    }else{
                        $supervisor =[];
                    }
                endif;
            endforeach;
        endif;

        if ($name)
            $this->name($name);

        if ($state)
            $this->state($state);

        if ($type)
            $this->type($type);
    }

    public function name($n = false)
    {
        return $this->builder->where('holiday.name', 'LIKE', '%' . $n . '%');
    }


    public function state($state)
    {
        return $this->builder->where('holiday.state_r', 'LIKE', '%' . $state . '%');
    }

    public function type($query = false)
    {
        if ($query) {
            return $this->builder->whereIn('cal_type', $query);
        }
        return $this->builder;
    }
    public function eto_eli($eto = false){

        if(strtolower($eto)  == "yes") {
            $eto = 1;
        }else{
            $eto = 0;
        }

        dd($eto);
        return $this->builder->where('eto_eligibility', $eto);
    }

}