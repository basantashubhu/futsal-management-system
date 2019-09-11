<?php

namespace App\Lib\Filter\Fgp;


use App\Lib\Filter\AbstractFilter;

class HighVolumeReportsFilter extends AbstractFilter
{
    function is_download($query = false) {
        
        if ($query) {
            return $this->builder->whereIn('report_logs.is_download', $query);
        }
        return $this->builder;
    }

    public function date_range($range){
        if ($range) {
            if (strpos($range, '-') !== false) {
                $range = explode(' - ', $range);
                $start = date('Y-m-d', strtotime($range[0]));
                $end = date('Y-m-d', strtotime($range[1]));
                return $this->builder->whereBetween('report_logs.created_at', [$start, $end]);
            }
        }
        return $this->builder;
    }
}