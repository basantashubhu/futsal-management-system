<?php

namespace App\Lib\Filter\Fgp;

use App\Lib\Filter\AbstractFilter;

class VolunteerFilter extends AbstractFilter
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

//        if ($ssnFilter)
        //            $this->ssnFilter($ssnFilter);

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
        $this->builder->where(function ($query) use ($name) {
            $nameArr = explode(' ', $name);
            $search = 'where';
            foreach ($nameArr as $needle) {
                foreach (['first_name', 'middle_name', 'last_name'] as $haystack) {
                    $query->$search("volunteers.$haystack", 'like', "%$needle%");
                    $search = 'orWhere';
                }
            }
        });
    }

    public function vol_id($query = false)
    {

        if ($query) {
            $vol_id = str_pad($query, 6, 0, STR_PAD_LEFT);

            return $this->builder->where('volunteers.alt_id', $vol_id);
        }

        return $this->builder;

    }

    public function eStipend_id($eStipendID = false)
    {

        if ($eStipendID) {

            return $this->builder->where('volunteers.id', $eStipendID);
        }

        return $this->builder;
    }

    public function supplier_id($supplierID = false)
    {

        if ($supplierID) {

            $supplier_id = str_pad($supplierID, 10, 0, STR_PAD_LEFT);

            return $this->builder->where('volunteers.id', $supplier_id); //because supplier id/ vendor id is generated from vol.id

        }

        return $this->builder;

    }

    public function is_active($query)
    {

        // if(is_null($query)){
        //     return $this->builder->where("volunteers.is_active", 1);

        // }

        return $this->builder->where("volunteers.is_active", $query);

    }

    public function cellPhone($query = false)
    {
        if ($query) {
            return $this->builder->where('contacts.cell_phone', $query);
        }
        return $this->builder;
    }

    public function supervisor($query = false)
    {
        if ($query) {
            return $this->builder->whereIn('users.id', $query);
        }
        return $this->builder;
    }

    public function supervisors($ids = false)
    {
        if (!is_array($ids)) {
            return;
        }

        $this->builder->whereHas('supervisors', function ($query) use ($ids) {
            $query->whereIn('users.id', $ids);
        });
    }

    public function sites($ids = false)
    {
        if (!is_array($ids)) {
            return;
        }

        $this->builder->whereHas('sites', function ($query) use ($ids) {
            $query->whereIn('sites.id', $ids);
        });
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
            if (is_array($query)) {
                $query = array_map(function ($val) {
                    return preg_replace('/[^a-z]/', '', strtolower($val));
                }, (array) $query);
                return $this->builder->whereIn('address.city', $query);
            }
            return $this->builder->where('address.city', 'LIKE', "%$query%");
        }
        return $this->builder;
    }
    public function county($query = false)
    {
        if ($query) {
            if (is_array($query)) {
                return $this->builder->whereIn('address.county', $query);
            }
            return $this->builder->where('address.county', 'LIKE', "%$query%");
        }
        return $this->builder;
    }
    public function region($query = false)
    {
        if ($query) {
            if (is_array($query)) {
                return $this->builder->whereIn('address.region', $query);
            }
            return $this->builder->where('address.region', 'LIKE', "%$query%");
        }
        return $this->builder;
    }
    public function add1($query = false)
    {
        if ($query) {
            if (is_array($query)) {
                return $this->builder->whereIn('address.add1', $query);
            }
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

    public function SearchVolunteer($name = false)
    {
        if (!$name) {
            return;
        }

        $this->builder->whereRaw('CONCAT(volunteers.first_name," ",COALESCE(volunteers.middle_name,"")," ",volunteers.last_name) like ?', ["%$name%"]);
    }

}
