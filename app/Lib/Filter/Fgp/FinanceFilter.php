<?php

namespace App\Lib\Filter\Fgp;

use App\Lib\Filter\AbstractFilter;

class FinanceFilter extends AbstractFilter
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
                    if (isset($d['value'])) {
                        array_push($supervisor, $d['value']);
                    } else {
                        $supervisor = [];
                    }
                endif;
            endforeach;
        endif;

        if ($vol_name) {
            $this->vol_name($vol_name);
        }

        if ($cellPhone) {
            $this->cellPhone($cellPhone);
        }

        if ($email) {
            $this->email($email);
        }

        if ($supervisor) {
            $this->supervisor($supervisor);
        }

        if ($ssnFilter) {
            $this->ssnFilter($ssnFilter);
        }

        if ($add1) {
            $this->add1($add1);
        }

        if ($city) {
            $this->city($city);
        }

        if ($zipCode) {
            $this->zipCode($zipCode);
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

    public function cellPhone($query = false)
    {
        if ($query) {
            return $this->builder->where('contacts.cell_phone', $query);
        }
        return $this->builder;
    }

    public function supervisors($query = [])
    {
        if ($query) {
            $query = is_string($query) ? explode(',', $query) : $query;
            $sup = array_map(function ($v) {
                return "'$v'";
            }, $query);
            $sup = implode(',', $sup);
            return $this->builder->havingRaw("supervisor_name in ($sup)");
        }
        return $this->builder;
    }
    public function email($query = false)
    {
        if ($query) {
            return $this->builder->where('contacts.email', 'LIKE', "%$query%");
        }
        return $this->builder;
    }
    public function city($query = false)
    {
        if ($query) {
            return $this->builder->where('address.city', 'LIKE', "%$query%");
        }
        return $this->builder;
    }
    public function add1($query = false)
    {
        if ($query) {
            return $this->builder->where('address.add1', 'LIKE', "%$query%");
        }
        return $this->builder;
    }
    public function zipCode($query = false)
    {
        if ($query) {
            return $this->builder->where('address.zip_code', 'LIKE', "%$query%");
        }
        return $this->builder;
    }

    /*
     * stipend_calc_vols search from volunteer profile
     * */
    public function fiscal_year($year)
    {
        if (!$year) {
            return $this->builder;
        }

        return $this->builder->where('pay_periods.fiscal_year', $year);
    }
    public function period_no($n)
    {
        if (!$n) {
            return $this->builder;
        }

        $n = explode(',', $n);
        return $this->builder->whereIn('pay_periods.id', $n);
    }

    public function date_range($range)
    {
        if ($range) {
            if (strpos($range, '-') !== false) {
                $range = explode(' - ', $range);
                $start = date('Y-m-d', strtotime($range[0]));
                $end = date('Y-m-d', strtotime($range[1]));
                // dd($start);
                return $this->builder->whereBetween('stipend_calcs.start_date', [$start, $end]);
            } else {
                return $this->builder->where('stipend_calcs', date('Y-m-d', strtotime($range)));
            }

        }
        return $this->builder;
    }

    public function site_name($site)
    {
        if (!$site) {
            return $this->builder;
        }

        $sites = explode('|', $site);
        if (count($sites) > 1 || is_numeric($site)) {
            return $this->builder->whereIn('sites.id', $sites);
        }

        return $this->builder->where('sites.site_name', 'like', "%$site%");
    }
}
