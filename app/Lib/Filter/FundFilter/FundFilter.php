<?php


namespace App\Lib\Filter\FundFilter;


use App\Lib\Filter\AbstractFilter;

class FundFilter extends AbstractFilter
{
    public function accountType($accountType='')
    {
        if($accountType!='')
        {
            return $this->builder->whereIn('a.table_name',$accountType);
        }
        return $this->builder;
    }

    public function applicationType($applicationType='')
    {
        if($applicationType!='')
        {
            return $this->builder->whereIn('a.type',$applicationType);
        }
        return $this->builder;
    }

    public function dateRange($range=false)
    {
        if ($range) {
            $range = explode(' - ', $range);
            $start = date('Y-m-d', strtotime($range[0]));
            $end = date('Y-m-d', strtotime($range[1]));
            return $this->builder->whereBetween('a.budget_date', [$start, $end]);
        }
        return $this->builder;
    }
}