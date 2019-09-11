<?php
/**
 * Created by PhpStorm.
 * User: Shiva Thapa
 * Date: 9/16/2018
 * Time: 6:31 PM
 */

namespace App\Lib\Filter\ReportFilter;


use App\Lib\Filter\AbstractFilter;

class ReportFilter extends AbstractFilter
{
    public function dateRange($dateRange='')
    {
        $range = explode(' - ', $dateRange);
        $start = date('Y-m-d 00:00:00', strtotime($range[0]));
        $end = date('Y-m-d 23:59:59', strtotime($range[1]));
        return $this->builder->whereBetween('report_log.created_at' ,[$start, $end]);
    }

    public function userID($query = false)
    {
        if ($query) {
            return $this->builder->whereIn('report_log.userc_id', $query);
        }
        return $this->builder;
    }

    public function refId($id = false)
    {
        if ($id) {
            return $this->builder->where('file_merge.ref_id','LIKE', '%' . $id . '%');
        }
        return $this->builder;
    }
}