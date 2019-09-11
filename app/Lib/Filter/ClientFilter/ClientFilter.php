<?php


namespace App\Lib\Filter\ClientFilter;


use App\Lib\Filter\AbstractFilter;

class ClientFilter extends AbstractFilter
{
    public function advancedFilter($data = false)
    {
        // dd($data);
        $clientName = '';
        $cellPhone = '';
        $email = '';
        $zipCode = '';
        $city = '';
        $dob = '';
        $serviceProvider = [];
        foreach($data as $d):
            if($d['name'] == 'clientName' || $d['name'] == 'clientName1'):
                $clientName = $d['value'];
            elseif($d['name'] == 'cellPhone1' || $d['name'] == 'cellPhone'):
                $cellPhone = $d['value'];
            elseif($d['name'] == 'email1' || $d['name'] == 'email'):
                $email = $d['value'];
            elseif($d['name'] == 'zipCode1' || $d['name'] == 'zipCode'):
                $zipCode = $d['value'];
            elseif($d['name'] == 'city1' || $d['name'] == 'city'):
                $city = $d['value'];
            elseif($d['name'] == 'providerId'):
            // $serviceProvider = $d['value'];
            array_push($serviceProvider, $d['value']);
            elseif($d['name'] == 'dob1' || $d['name'] == 'dob'):
                $dob = $d['value'];
            endif;
        endforeach;

        if($dob)
            $this->dob($dob);

        if($clientName)
            $this->clientName($clientName);

        if($city)
            $this->city($city);

        if($cellPhone)
            $this->cellPhone($cellPhone);

        if($email)
            $this->email($email);

        if($zipCode)
            $this->zipCode($zipCode);

        if($serviceProvider)
            $this->providerId($serviceProvider);
    }

    public function dob($dob = '')
    {
        if ($dob != '') {
            return $this->builder->where('dob', $dob);
        }
        return $this->builder;
    }

    public function providerId($providerId = '')
    {
        // dd($providerId);
        if ($providerId != '') {
            return $this->builder->whereIn('organization.id', $providerId);
        }
        return $this->builder;
    }
    public function providerId1($providerId = '')
    {
        // dd($providerId);
        if ($providerId != '') {
            if(is_array($providerId) && count($providerId) == 1){
                $providerId = explode(',', $providerId[0]);
            }
            return $this->builder->whereIn('organization.id', $providerId);
        }
        return $this->builder;
    }

    public function licNumber($licNumber = '')
    {
        if ($licNumber != '') {
            return $this->builder->where('vet_lic', $licNumber);
        }
        return $this->builder;
    }
    public function clientID($id = '')
    {
        $field = 'id';
        $d = $id;
        if ($id) {
            if (getSiteSettings('alt_id_true') == 'true') {
                $field = 'alt_id';
                preg_match_all('!\d+!', $id, $id);
            }
            return $this->builder->where('clients.' . $field, $d);
        }
        return $this->builder;
    }

    /*filter by zip code*/
    public function zipCode($zipCode = "")
    {
        if ($zipCode != "") {
            return $this->builder->where(function ($query) use($zipCode) {
                $query->where('address.zip_code', 'LIKE', '%' . $zipCode . '%')->orWhere('zip_codes.zip_code', 'LIKE', '%' . $zipCode . '%');
            });
        }
        return $this->builder;
    }
    /*filter by zip code*/
    public function zip($zipCode = "")
    {
        if ($zipCode != "") {
            return $this->builder->whereIn('address.zip_code', $zipCode);
        }
        return $this->builder;
    }
    /*filter by zip code*/
    public function city($city = "")
    {
        if ($city != "") {
            return $this->builder->where(function ($query) use($city) {
                $query->where('address.city', 'LIKE', '%' . $city . '%')->orWhere('zip_codes.city', 'LIKE', '%' . $city . '%');
            });
        }
        return $this->builder;
    }
    /*filter by zip code*/
    public function zipCode1($zipCode = "")
    {
        if ($zipCode != "") {
            if(is_array($zipCode) && count($zipCode) == 1){
                $zipCode = explode(',', $zipCode[0]);
            }
            return $this->builder->whereIn('address.zip_code', $zipCode);
        }
        return $this->builder;
    }
    public function city1($city = "")
    {
        if ($city != "") {
            if(is_array($city) && count($city) == 1){
                $city = explode(',', $city[0]);
            }
            return $this->builder->whereIn('address.city', $city);
        }
        return $this->builder;
    }

    public function ssn($ssn = "")
    {
        if ($ssn != "") {
            return $this->builder->where('ssn', 'LIKE', '%' . $ssn . '%');
        }
        return $this->builder;
    }

    public function cellPhone($cellphone = "")
    {
        if ($cellphone != "") {
            return $this->builder->where('contacts.cell_phone', 'LIKE', '%' . $cellphone . '%');
        }
        return $this->builder;
    }

    /*filter by zip code*/
    public function state($state = "")
    {
        if ($state != "") {
            return $this->builder->where(function ($query) use($state) {
                $query->where('address.state', 'LIKE', '%' . $state . '%')->orWhere('zip_codes.state', 'LIKE', '%' . $state . '%');
            });
        }
        return $this->builder;
    }

    public function clientName($name = false)
    {
        if ($name) {
            // dd($name);
            $names = explode(' ', $name);
            if (count($names) == 3) {
                $fname = $names[0];
                $mname = $names[1];
                $lname = $names[2];
                return $this->builder->where('fname', 'LIKE', '%' . $fname . '%')->where('lname', 'LIKE', '%' . $lname . '%')->where('mname', 'LIKE', '%' . $mname . '%');
            } else if (count($names) == 2) {
                $fname = $names[0];
                $lname = $names[1];
                return $this->builder->where('fname', 'LIKE', '%' . $fname . '%')->where('lname', 'LIKE', '%' . $lname . '%');
            } else {
                $fname = $names[0];
                return $this->builder->where('fname', 'LIKE', '%' . $fname . '%')->orWhere('lname', 'LIKE', '%' . $fname . '%');
            }
        }
        return $this->builder;
    }
    public function clientName1($name = false)
    {
        if ($name) {
            // dd($name);
            $names = explode(' ', $name);
            if (count($names) == 3) {
                $fname = $names[0];
                $mname = $names[1];
                $lname = $names[2];
                return $this->builder->where('fname', 'LIKE', '%' . $fname . '%')->where('lname', 'LIKE', '%' . $lname . '%')->where('mname', 'LIKE', '%' . $mname . '%');
            } else if (count($names) == 2) {
                $fname = $names[0];
                $lname = $names[1];
                return $this->builder->where('fname', 'LIKE', '%' . $fname . '%')->where('lname', 'LIKE', '%' . $lname . '%');
            } else {
                $fname = $names[0];
                return $this->builder->where('fname', 'LIKE', '%' . $fname . '%')->orWhere('lname', 'LIKE', '%' . $fname . '%');
            }
        }
        return $this->builder;
    }

    public function email($email = false)
    {
        if ($email) {
            return $this->builder->where('contacts.personal_email', $email);
        }
        return $this->builder;
    }

}