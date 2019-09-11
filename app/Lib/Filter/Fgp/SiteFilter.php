<?php

namespace App\Lib\Filter\Fgp;

use App\Lib\Filter\AbstractFilter;

class SiteFilter extends AbstractFilter
{
    public function advancedFilter($data = false)
    {
        $status = [];
        $siteName = '';
//        $siteStatus='';
        $siteEmail = '';
        $phone = '';
        $supervisor = '';
        $siteExt = '';
        if ($data):
            foreach ($data as $d):
                if ($d['name'] == 'siteName'):
                    $siteName = $d['value'];
                elseif ($d['name'] == 'sitePhone'):
                    $phone = $d['value'];
                elseif ($d['name'] == 'supervisor'):
                    $supervisor = $d['value'];
                elseif ($d['name'] == 'siteEmail'):
                    $siteEmail = $d['value'];
                elseif ($d['name'] == 'siteExt'):
                    $siteExt = $d['value'];
//                elseif($d['name'] == "siteStatus"):
                    //                    $siteStatus = $d['value'];
                elseif ($d['name'] == 'status[]'):
                    if (isset($d['value'])) {
                        array_push($status, $d['value']);
                    } else {
                        $status = [];
                    }
                endif;
            endforeach;
        endif;

        if ($siteName) {
            $this->siteName($siteName);
        }

        if ($status) {
            $this->status($status);
        }

//        if ($siteStatus)
        //            $this->siteStatus($siteStatus);
        if ($phone) {
            $this->phone($phone);
        }

        if ($supervisor) {
            $this->supervisor($supervisor);
        }

        if ($siteEmail) {
            $this->siteEmail($siteEmail);
        }

        if ($siteExt) {
            $this->siteExt($siteExt);
        }

    }
//    public function siteStatus($query = false) {
    //        return $query ? $this->builder->where('is_active', $query) : $this->builder;
    //    }
    public function siteName($query = false)
    {
        if ($query) {
            return $this->builder->where('site_name', 'LIKE', "%$query%");
        }
        return $this->builder;
    }

    public function site_code($query = false)
    {

        return $query ? $this->builder->where('site_code', "$query") : $this->builder;

    }

    public function sitePhone($query = false)
    {
        if ($query) {
            return $this->builder->where('phone', $query);
        }
        return $this->builder;
    }

    public function supervisor($ids = false)
    {
        if ($ids) {
            return $this->builder->whereIn('users.id', $ids);
        }
        return $this->builder;
    }

    public function supervisors($ids = false)
    {
        if ($ids) {
            return $this->builder->whereHas('users', function ($query) use ($ids) {
                $query->whereIn('users.id', $ids);
            });
        }
        return $this->builder;
    }

    public function siteEmail($query = false)
    {
        if ($query) {
            return $this->builder->where('site_email', 'LIKE', "%$query%");
        }
        return $this->builder;
    }
    public function siteExt($query = false)
    {
        if ($query) {
            return $this->builder->where('site_ext', 'LIKE', "%$query%");
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
    public function siteCounty($query = false)
    {
        if ($query) {
            return $this->builder->where('address.county', 'LIKE', "%$query%");
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
    public function district($query = false)
    {
        if ($query) {
            return $this->builder->where('address.district', 'LIKE', "%$query%");
        }
        return $this->builder;
    }
    public function sitecity($query = false)
    {
        if ($query) {
            return $this->builder->where('address.city', 'LIKE', "%$query%");
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

    public function siteAddress($query = false)
    {
        if ($query) {
            return $this->builder->where('address.add1', 'LIKE', "%$query%");
        }
    }

    public function siteContactPerson($person = false)
    {
        if ($person) {
            $this->builder->where(function ($query) use ($person) {
                $query->where('sites.cont_per_fname', 'like', "$person%")
                    ->orWhere('sites.cont_per_mname', 'like', "$person%")
                    ->orWhere('sites.cont_per_lname', 'like', "$person%");
            });
        }
    }
}
