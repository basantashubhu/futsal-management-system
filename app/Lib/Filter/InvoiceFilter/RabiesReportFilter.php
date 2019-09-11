<?php
/**
 * Created by PhpStorm.
 * User: Shiva Thapa
 * Date: 8/1/2018
 * Time: 1:47 PM
 */

namespace App\Lib\Filter\InvoiceFilter;


use App\Lib\Filter\AbstractFilter;

class RabiesReportFilter extends AbstractFilter
{
    public function dateRange($range = false)
    {
        if ($range) {
            $range = explode(' - ', $range);
            $start = date('Y-m-d', strtotime($range[0]));
            $end = date('Y-m-d', strtotime($range[1]));
            return $this->builder->where(function ($query) use ($start, $end) {
                $query->whereBetween('trans_date', [$start, $end])->orWhereNull('trans_date');
            });
        }
        return $this->builder;
    }

    public function providerId($providerId = false)
    {
        if ($providerId)
            return $this->builder->whereIn('provider_id', $providerId);
        return $this->builder;
    }
}