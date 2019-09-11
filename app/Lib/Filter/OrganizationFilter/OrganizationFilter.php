<?php

namespace App\Lib\Filter\OrganizationFilter;

use App\Models\Organization;
use App\Models\Settings\ZipCode;

class OrganizationFilter
{
    protected $limit = 15;

    public function __construct($limit = 15)
    {
        $this->limit = $limit;
    }

    public function advancedFilter($data = false)
    {
        $name = '';
        $org_type = '';
        $breed = '';
        $ownername = '';
        $cellPhone = '';
        $email = '';
        $applicationID = '';
        $vetName = '';
        $serviceProvider = [];
        $status=[];
        foreach($data as $d):
            if($d['name'] == 'name'):
                $name = $d['value'];
            elseif($d['name'] == 'org_type'):
                $org_type = $d['value'];
            elseif($d['name'] == 'breed'):
                $breed = $d['value'];
            elseif($d['name'] == 'ownername'):
                $ownername = $d['value'];
            elseif($d['name'] == 'cellPhone'):
                $cellPhone = $d['value'];
            elseif($d['name'] == 'owneremail'):
                $email = $d['value'];
            elseif($d['name'] == 'applicationID'):
                $applicationID = $d['value'];
            elseif($d['name'] == 'serviceProvider'):
                array_push($serviceProvider, $d['value']);
            elseif($d['name'] == 'vetName'):
                $vetName = $d['value'];
            elseif($d['name'] == 'status[]'):
                array_push($status, $d['value']);
            endif;
        endforeach;

        if($ownername)
        $this->ownername($ownername);

        if($vetName)
            $this->vetName($vetName);

        if(count($serviceProvider)>0)
            $this->providerId($serviceProvider);


        if($applicationID)
            $this->applicationID($applicationID);

        if($name)
            $this->filterbyName($name);

        if($org_type)
            $this->type($org_type);

        if($cellPhone)
            $this->cellPhone($cellPhone);

        if($email)
            $this->email($email);

        if($breed)
            $this->breed($breed);
    }

    public function filterbyZip($zip)
    {
        $zips = $this->getZip(array($zip -1, $zip + 1));
        return $this->getOrganizationbyZip($zips);
    }

    protected function getZip($zips)
    {
        return ZipCode::whereBetween('zip_code', $zips)->limit($this->limit)->where('is_deleted', false)->pluck('id')->toArray();
    }

    protected function getOrganizationbyZip($zips)
    {
        $organizations = array();
        foreach (Organization::all() as $organization) {
            if (in_array($organization->address->zip_id, $zips) && $organization->type='Service Provider' && $organization->type='Non Profit') {
                $organization->contact;
                array_push($organizations, $organization);
            }
        }
        return $organizations;
    }

    public function filterbyName($name)
    {
        return Organization::where('cname', 'LIKE', '%' . $name . '%')
            ->with('address', 'contact')->limit($this->limit)
            ->where([['is_deleted', false]])
            ->where('type','!=','Rescue')
            ->get();
    }

    public function type($name)
    {
        return Organization::where('type', $name)
            ->with('address', 'contact')->limit($this->limit)
            ->where([['is_deleted', false],['type','Service Provider']])->get();
    }

    public function cellPhone($cellPhone = false)
    {
        if($cellPhone)
        {

        }
    }
}