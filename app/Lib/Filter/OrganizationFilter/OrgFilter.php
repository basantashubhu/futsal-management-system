<?php


namespace App\Lib\Filter\OrganizationFilter;


use App\Lib\Filter\AbstractFilter;

class OrgFilter extends AbstractFilter
{
    public function advancedFilter($data = false)
    {
        $name = '';
        $org_type = '';
        $licNo = '';
        $city = '';
        $cellPhone = '';
        $status = [];
        foreach($data as $d):
            if($d['name'] == 'orgNameFilter'):
                $name = $d['value'];
            elseif($d['name'] == 'org_type'):
                $org_type = $d['value'];
            elseif($d['name'] == 'licNo'):
                $licNo = $d['value'];
            elseif($d['name'] == 'city'):
                $city = $d['value'];
            elseif($d['name'] == 'cellPhone'):
                $cellPhone = $d['value'];
            elseif($d['name'] == 'status[]'):
                array_push($status,$d['value']);
            endif;
        endforeach;
        if($city)
            $this->city($city);

        if($status)
            $this->status($status);

        if($name)
            $this->name($name);

        if($org_type)
            $this->type($org_type);

        if($cellPhone)
            $this->cellPhone($cellPhone);

        if($licNo)
            $this->licNo($licNo);
    }
    public function name($name = '')
    {
        if ($name != '') {
            return $this->builder->where('cname', 'LIKE', "%$name%");
        }
        return $this->builder;
    }

    public function licNo($lic = false)
    {
        if ($lic) {
            return $this->builder->where('lic_no', $lic);
        }
        return $this->builder;
    }

    public function city($city = false)
    {
        if ($city) {
            return $this->builder->where(function ($query) use($city) {
                $query->where('address.city', 'LIKE', '%' . $city . '%')->orWhere('zip_codes.city', 'LIKE', '%' . $city . '%');
            });
        }
        return $this->builder;
    }

    public function zipCode($zipCode = "")
    {
        if ($zipCode != "") {
            return $this->builder->where(function ($query) use($zipCode) {
                $query->where('address.zip_code', 'LIKE', '%' . $zipCode . '%')->orWhere('zip_codes.zip_code', 'LIKE', '%' . $zipCode . '%');
            });
        }
        return $this->builder;
    }

    public function cellPhone($cellphone = "")
    {
        if ($cellphone != "") {
            return $this->builder->where('phone', 'LIKE', '%' . $cellphone . '%');
        }
        return $this->builder;
    }

    public function type($type = "")
    {
        if ($type != "") {
            return $this->builder->where('type', $type);
        }
        return $this->builder;
    }

    public function status($status = '')
    {
        if ($status != '') {
            if(is_array($status)&& count($status)>0)
                return $this->builder->whereIn('organization.is_approved', $status);
            else
                return $this->builder->where('organization.is_approved', $status);
        }
        return $this->builder;
    }

    public function singleStatus($status = '')
    {
        if ($status == '') {
            $status = 0;
        }
        return $this->builder->where('is_approved', $status);
    }
    public function activation($active = '')
    {
        if ($active != '') {

            return $this->builder->whereIn('organization.is_active', $active);
        }
        return $this->builder;
    }

    public function dateRange($range = '')
    {
        if($range)
        {
            $range = explode(' - ', $range);
            $start = date('Y-m-d 00:00:00', strtotime($range[0]));
            $end = date('Y-m-d 23:29:29', strtotime($range[1]));
            return $this->builder->whereBetween('organization.created_at', [$start, $end]);
        }
        return $this->builder;
    }
}