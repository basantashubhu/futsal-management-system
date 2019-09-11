<?php


namespace App\Lib\Filter\AuditFilter;


use App\Lib\Filter\AbstractFilter;
use Illuminate\Support\Facades\DB;

class AuditFilter extends AbstractFilter
{
    public function tablename($name = '')
    {
        if ($name != '') {
            return $this->builder->where('table_name', $name);
        }
        return $this->builder;
    }

    public function tableid($id = '')
    {
        if ($id != '') {
            return $this->builder->where('table_id', $id);
        }
        return $this->builder;
    }

    public function user($user = '')
    {
        if ($user != '') {
            return $this->builder->where('users.name', $user);
        }
        return $this->builder;
    }


    public function dateRange($dateRange='')
    {
        if ($dateRange) {
            $dateRange = explode(' - ', $dateRange);
            $start = date('Y-m-d 00:00:00', strtotime($dateRange[0]));
            $end = date('Y-m-d 23:59:59', strtotime($dateRange[1]));
            return $this->builder->whereBetween('audits.created_at', [$start, $end]);
        }
        return $this->builder;
    }

    public function filters($json) {
        $filters = json_decode($json, true);
        foreach ($filters as $key => $val) {
            $exp = "\"$key\":". (is_numeric($val) ? $val : "\"$val\"");

            $this->builder->where(function($query) use($exp) {
                $query->whereRaw("locate(?, old_record) > 0", [$exp])
                    ->orWhereRaw("locate(?, new_record) > 0", [$exp]);
            });
        }
    }
}