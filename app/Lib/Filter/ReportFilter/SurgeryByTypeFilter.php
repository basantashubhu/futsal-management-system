<?php
/**
 * Created by PhpStorm.
 * User: Shiva Thapa
 * Date: 9/25/2018
 * Time: 11:45 AM
 */

namespace App\Lib\Filter\ReportFilter;


use App\Lib\Filter\AbstractFilter;

class SurgeryByTypeFilter extends AbstractFilter
{
    public function dateRange($range=null)
    {
        $range = explode(' - ', $range);
        $start = date('Y-m-d', strtotime($range[0]));
        $end = date('Y-m-d', strtotime($range[1]));
        return $this->builder->whereBetween('applications.invoiced_date' ,[$start, $end]);
    }

    public function status($status=null)
    {
        if($status)
            return $this->builder->where('applications.status',$status);
        return $this->builder;
    }

    public function rate_type($rate_type=null)
    {
        if($rate_type)
            return $this->builder->where('organization.plan_id',$rate_type);
        return $this->builder;
    }
}