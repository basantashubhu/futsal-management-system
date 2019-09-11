<?php


namespace App\Lib\Filter\Fgp;

use App\Lib\Filter\AbstractFilter;
use Illuminate\Support\Facades\DB;

class TimesheetFilter extends AbstractFilter
{

    public function alt_id($q = false)
    {
        if ($q) {
            return $this->builder->where('alt_id', 'LIKE', '%' . $q . '%');
        }
    }
    public function vol_name($name = false)
    {
        if ($name) {
            $names = explode(' ', $name);
            if (count($names) == 3) {
                $fname = $names[0];
                $mname = $names[1];
                $lname = $names[2];
                return $this->builder->where('volunteers.first_name', 'LIKE', '%' . $fname . '%')->where('volunteers.last_name', 'LIKE', '%' . $lname . '%')->orWhere('volunteers.middle_name', 'LIKE', '%' . $mname . '%');
            } else if (count($names) == 2) {
                $fname = $names[0];
                $lname = $names[1];
                return $this->builder->where('volunteers.first_name', 'LIKE', '%' . $fname . '%')->where('volunteers.last_name', 'LIKE', '%' . $lname . '%');
            } else {
                $fname = $names[0];
                // dd($this->builder);
                return $this->builder->where('volunteers.first_name', 'LIKE', '%' . $fname . '%')->orWhere('volunteers.last_name', 'LIKE', '%' . $fname . '%');
            }
        }

        return $this->builder;
    }
    public function ts_supervisor($params = false)
    {
        if ($params) {
            $sup = is_string($params) ? explode(',', $params) : $params;
            $sup = array_map(function ($s) {
                return "'$s'";
            }, $sup);
            $sup = array_unique($sup);
            $sup = implode(',', $sup);
            $this->builder->havingRaw(DB::raw("vol_sup_name in ($sup)"));
            // dd($this->builder->toSql());
        }
        return $this->builder;
    }

    public function stipend_period_status($query = false)
    {
        if ($query) {
            $query = $query ? 'is not' : 'is';
            return $this->builder->where('sp.closed_date', $query, null);
        }
        return $this->builder;
    }

    public function period_no($query = false)
    {
        if ($query) {
            $p = is_string($query) ? explode(',', $query) : $query;
            return $this->builder->whereIn('sp.id', $p);
        }
        return $this->builder;
    }
    public function dateRange($range = false)
    {
        if ($range) {
            $range = explode(' - ', $range);
            $start = date('Y-m-d', strtotime($range[0]));
            $end = date('Y-m-d', strtotime($range[1]));
            // dd($start);
            return $this->builder->whereBetween('sp.start_date', [$start, $end]);
        }
        return $this->builder;
    }
    public function county($query = false)
    {
        $query = is_string($query) ? explode(',', $query) : $query;
        if ($query) {
            $query = array_filter($query);
            return $this->builder->whereIn('site.county', $query);
        }
        return $this->builder;
    }
    public function city($query = false)
    {
        $query = is_string($query) ? explode(',', $query) : $query;
        if ($query) {
            $query = array_filter($query);
            return $this->builder->where('site.city', $query);
        }
        return $this->builder;
    }
    public function state($query = false)
    {
        $query = is_string($query) ? explode(',', $query) : $query;
        if ($query) {
            $query = array_filter($query);
            return $this->builder->whereIn('site.region', $query);
        }
        return $this->builder;
    }
    public function district($query = false)
    {
        $query = is_string($query) ? explode(',', $query) : $query;
        if ($query) {
            $query = array_filter($query);
            return $this->builder->whereIn('site.district', $query);
        }
        return $this->builder;
    }

    public function site($query = false)
    {
        $query = is_string($query) ? explode(',', $query) : $query;
        if ($query) {
            $query = array_filter($query);
            return $this->builder->whereIn('sites.site_name', $query);
        }
        return $this->builder;
    }
    public function sites($query = false)
    {
        $query = is_string($query) ? explode(',', $query) : $query;
        if ($query) {
            $query = array_filter($query);
            return $this->builder->whereIn('sites.id', $query);
        }
        return $this->builder;
    }
/*     public function tsStatus($query = false)
{
$query = is_string($query) ? explode(',', $query) : $query;
if ($query) {
$query = array_filter($query);
return $this->builder->whereIn('ts.status', $query);
}
return $this->builder;
} */
    /*
     * this function is deprecated
     * since there is only one state
     * we are treating regions as states
     * */
    public function region($query = false)
    {
        $query = is_string($query) ? explode(',', $query) : $query;
        if ($query) {
            $query = array_filter($query);
            return $this->builder->whereIn('site.region', $query);
        }
        return $this->builder;
    }

    /**
     * volunteer filter
     * @param bool $query
     * @return mixed
     */
    public function volunteer($query = false)
    {
        $query = is_string($query) ? explode(',', $query) : $query;
        if ($query) {
            $query = array_filter($query);
            return $this->builder->whereIn(DB::raw('CONCAT(volunteers.first_name, " ", volunteers.last_name)'), $query);
        }
        return $this->builder;
    }

    public function site_name($q)
    {
        if (!$q) {
            return $this->builder;
        }

        return $this->builder->where('s.id', $q);
        // return $this->builder->where('s.site_name', 'like', "%$q%");
    }

    public function volunteer_name($q)
    {
        if (!$q) {
            return $this->builder;
        }

        return $this->builder->where('v.id', $q);
        // return $this->builder->where(DB::raw('concat(v.first_name, " ", v.last_name)'), 'like', "%$q%");
    }

    public function time_type($q)
    {
        if (!$q) {
            return $this->builder;
        }

        return $this->builder->where('ts.type_label', 'like', "%$q%");
    }

    // v2
    public function v2dateRange($q)
    {
        if (!$q) {
            return $this->builder;
        }

        $range = explode(' - ', $q);
        $start = date('Y-m-d', strtotime($range[0]));
        $end = date('Y-m-d', strtotime($range[1]));
        return $this->builder->whereDate('pp.start_date', '>=', $start)
            ->whereDate('pp.end_date', '<=', $end);
    }

    public function v2_period_no($query = false)
    {
        if ($query) {
            // $p = PayPeriod::where('period_no', $query)->pluck('id');
            return $this->builder->whereIn('pp.id', $query);
        }
        return $this->builder;
    }

    public function v2_volunteer($query = false)
    {
        if ($query) {
            return $this->builder->whereIn('v.id', $query);
        }
        return $this->builder;
    }

    public function v2_site($query)
    {
        if ($query) {
            return $this->builder->whereIn('s.id', $query);
        }
        return $this->builder;
    }

    /*
     * advance search
     * */

    public function adv_search_region($params = false)
    {
        if ($params) {
            return $this->builder->where('site.region', 'like', "%$params%");
        }
        return $this->builder;
    }

    public function adv_search_county($params = false)
    {
        if ($params) {
            return $this->builder->where('site.county', 'like', "%$params%");
        }
        return $this->builder;
    }

    public function adv_search_site_name($params = false)
    {
        if ($params) {
            return $this->builder->where('sites.site_name', 'like', "%$params%");
        }
        return $this->builder;
    }

    public function adv_search_district($params = false)
    {
        if ($params) {
            return $this->builder->where('site.district', 'like', "%$params%");
        }
        return $this->builder;
    }

    public function adv_search_volunteer_alt_id($params = false)
    {
        if ($params) {
            return $this->builder->where('volunteers.alt_id', $params);
        }
        return $this->builder;
    }

    public function adv_search_volunteer_phrase($params = false)
    {
        if ($params) {
            return $this->builder->where(DB::raw('CONCAT(volunteers.first_name, " ", volunteers.last_name)'), 'like', "%$params%");
        }
        return $this->builder;
    }

    public function adv_search_supervisor($params = false)
    {
        return $this->supervisor($params);
    }

    public function adv_search_stipend_no($params = false)
    {
        if ($params) {
            return $this->builder->where('sp.period_no', $params);
        }
        return $this->builder;
    }

    public function adv_search_stipend_status($params = false)
    {
        return $this->stipend_period_status($params);
    }

    public function adv_search_stipend_id($params = false)
    {
        return $this->period_no($params);
    }
}
