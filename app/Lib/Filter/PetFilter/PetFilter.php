<?php


namespace App\Lib\Filter\PetFilter;


use App\Lib\Filter\AbstractFilter;
use App\Models\Pet;
use App\Models\Application;

class PetFilter extends AbstractFilter
{
    public function advancedFilter($data = false)
    {
        // dd($data);
        $status = [];
        $petname = '';
        $petID = '';
        $certNumber = '';
        $species = '';
        $breed = '';
        $ownername = '';
        $cellPhone = '';
        $email = '';
        $applicationID = '';
        $vetName = '';
        $serviceProvider = [];
        $applicationID = '';
        foreach($data as $d):
            if($d['name'] == 'petname'):
                $petname = $d['value'];
            elseif($d['name'] == 'species'):
                $species = $d['value'];
            elseif($d['name'] == 'petID'):
                $petID = $d['value'];
            elseif($d['name'] == 'certNumber'):
                $certNumber = $d['value'];
            elseif($d['name'] == 'breed'):
                $breed = $d['value'];
            elseif($d['name'] == 'ownername'):
                $ownername = $d['value'];
            elseif($d['name'] == 'petOwnerName'):
                $petOwnerName = $d['value'];
            elseif($d['name'] == 'ownerphone'):
                $cellPhone = $d['value'];
            elseif($d['name'] == 'owneremail'):
                $email = $d['value'];
            elseif($d['name'] == 'applicationID'):
                $applicationID = $d['value'];
            elseif($d['name'] == 'status[]'):
                if(isset($d['value'])){
                    array_push($status, $d['value']);
                }else{
                    $status =[];
                }
            elseif($d['name'] == 'serviceProvider'):
                if(isset($d['value'])){
                    array_push($serviceProvider, $d['value']);
                }
                else{
                    $serviceProvider = [];
                }
            elseif($d['name'] == 'vetName'):
                $vetName = $d['value'];
            endif;
        endforeach;

        if($ownername)
            $this->ownername($ownername);
        if($petOwnerName)
            $this->petOwnerName($petOwnerName);

        if($vetName)
            $this->vetName($vetName);

        if($serviceProvider)
            $this->providerId($serviceProvider);

        if($applicationID)
            $this->applicationID($applicationID);

        if($petID)
            $this->petID($petID);

        if($certNumber)
           $this->certID($certNumber);
        // if($certNumber)
        //     $this->cert_number($certNumber);

        if($status)
            $this->status($status);

        if($petname)
            $this->petname($petname);

        if($species)
            $this->species($species);

        if($cellPhone)
            $this->ownerphone($cellPhone);

        if($email)
            $this->owneremail($email);

        if($breed)
            $this->breed($breed);
    }
    public function ownername($name = false)
    {
        // dd($name);
        if ($name) {
            $names = explode(' ', $name);
            if (count($names) == 3) {
                $fname = $names[0];
                $mname = $names[1];
                $lname = $names[2];
                return $this->builder->where('clients.fname', 'LIKE', '%' . $fname . '%')->where('clients.lname', 'LIKE', '%' . $lname . '%')->where('clients.mname', 'LIKE', '%' . $mname . '%');
            } else if (count($names) == 2) {
                $fname = $names[0];
                $lname = $names[1];
                return $this->builder->where('clients.fname', 'LIKE', '%' . $fname . '%')->where('clients.lname', 'LIKE', '%' . $lname . '%');
            } else {
                $fname = $names[0];
                return $this->builder->where('clients.fname', 'LIKE', '%' . $fname . '%')->orWhere('clients.mname', 'LIKE', '%' . $fname . '%')->orWhere('clients.lname', 'LIKE', '%' . $fname . '%');
            }
        }
        return $this->builder;
    }

    public function petOwnerName($name = false)
    {
        // dd($name);
        if ($name) {
            $names = explode(' ', $name);
            if (count($names) == 3) {
                $fname = $names[0];
                $mname = $names[1];
                $lname = $names[2];
                return $this->builder->where('clients.fname', 'LIKE', '%' . $fname . '%')->where('clients.lname', 'LIKE', '%' . $lname . '%')->where('clients.mname', 'LIKE', '%' . $mname . '%');
            } else if (count($names) == 2) {
                $fname = $names[0];
                $lname = $names[1];
                return $this->builder->where('clients.fname', 'LIKE', '%' . $fname . '%')->where('clients.lname', 'LIKE', '%' . $lname . '%');
            } else {
                $fname = $names[0];
                return $this->builder->where('clients.fname', 'LIKE', '%' . $fname . '%')->orWhere('clients.mname', 'LIKE', '%' . $fname . '%')->orWhere('clients.lname', 'LIKE', '%' . $fname . '%');
            }
        }
        return $this->builder;
    }

    public function vetName($name = false)
    {
        // dd($name);
        if ($name) {
            $names = explode(' ', $name);
            if (count($names) == 3) {
                $fname = $names[0];
                $mname = $names[1];
                $lname = $names[2];
                return $this->builder->where('vet.fname', 'LIKE', '%' . $fname . '%')->where('vet.lname', 'LIKE', '%' . $lname . '%')->where('vet.mname', 'LIKE', '%' . $mname . '%');
            } else if (count($names) == 2) {
                $fname = $names[0];
                $lname = $names[1];
                return $this->builder->where('vet.fname', 'LIKE', '%' . $fname . '%')->where('vet.lname', 'LIKE', '%' . $lname . '%');
            } else {
                $fname = $names[0];
                return $this->builder->where('vet.fname', 'LIKE', '%' . $fname . '%');
            }
        }
        return $this->builder;
    }

    public function status($status = "")
    {
        if ($status != "") {
            if (in_array('All Items Selected', $status)) {
                array_push($status, 'New');
                array_push($status, 'Approved');
                array_push($status, 'Pending');
                array_push($status, 'Review');
                array_push($status, 'Invoiced');
                array_push($status, 'Closed');
                array_push($status, 'Deleted');
                unset($status[0]);
            }
            return $this->builder->whereIn('applications.status', $status);
        }
        return $this->builder;
    }
    public function petstatus($status = "")
    {
        if ($status != "") {
            return $this->builder->whereIn('applications.status', $status);
        }
        return $this->builder;
    }

    public function statusDate($v = "")
    {
        if($v != ""){
            if(is_array($v)){
                if(!array_key_exists("value", $v[0]) && array_key_exists("value", $v[1])){
                    $range = explode(' - ', $v[1]['value']);
                    $start = date('Y-m-d', strtotime($range[0]));
                    $end = date('Y-m-d', strtotime($range[1]));
                    return $this->builder->whereBetween('applications.application_date', [$start, $end]);
                }elseif(!array_key_exists("value", $v[1]) && array_key_exists("value", $v[0])){
                    return $this->builder->whereIn('applications.status', $v[1]["value"]);
                }elseif(array_key_exists("value", $v[1]) && array_key_exists("value", $v[0])){
                    $range = explode(' - ', $v[1]['value']);
                    $start = date('Y-m-d', strtotime($range[0]));
                    $end = date('Y-m-d', strtotime($range[1]));
                    return $this->builder->whereIn('applications.status', $v[0]["value"])->whereBetween('applications.application_date', [$start, $end]);
                }
            }
            return $this->builder;
        }
        return $this->builder;
    }

    public function appStatus($status = "")
    {
        // dd($status);
        if ($status != "") {
            return $this->builder->whereIn('applications.status', $status);
        }
        return $this->builder;
    }
    public function expire($expire = "")
    {
        if($expire == 'Not Expire'){
            return $this->builder->where("files.expiry_date", ">=", date('Y-m-d'));
        }else{
            return $this->builder->where("files.expiry_date", "<=", date('Y-m-d'));
        }
        return $this->builder;
    }

    public function applicationID($id = false)
    {
        // dd($id);
        if ($id) {
        $field = 'id';
        if (getSiteSettings('alt_id_true') == 'true'){
            preg_match_all('!\d+!', $id, $id);
            $field = 'alt_id';
            $pet = Application::where('alt_id', $id)->first();
            if(is_null($pet)){
                $field = 'id';
                return $this->builder->where('applications.' . $field, $id);
            }
        }
            return $this->builder->where('applications.' . $field, $id);
        }
        return $this->builder;
    }
    public function petID($id = false)
    {
        // dd($id);
        if ($id) {
            $field = 'id';
            if (getSiteSettings('alt_id_true') == 'true'){
                preg_match_all('!\d+!', $id, $id);
                $field = 'alt_id';
                $pet = Pet::where('alt_id', $id)->first();
                if(is_null($pet)){
                    $field = 'id';
                    return $this->builder->where('pets.' . $field, $id);
                }
            }
            return $this->builder->where('pets.' . $field, $id);
        }
        return $this->builder;
    }

    public function petname($name = '')
    {
        // dd($name);
        if ($name != '') {
            return $this->builder->where('pet_name', 'LIKE', "%$name%");
        }
        return $this->builder;
    }

    public function serviceProvider($name = '')
    {
        if ($name != '') {
            return $this->builder->whereIn('organization.cname', $name);
        }
        return $this->builder;
    }


    public function sex($param = '')
    {
        if ($param != '') {
            return $this->builder->whereIn('sex', "$param");
        }
        return $this->builder;
    }

    public function species($param = '')
    {
        // dd($param);
        if ($param != '') {
            return $this->builder->where('species', 'LIKE', "%$param%");
        }
        return $this->builder;
    }

    public function color($param = '')
    {
        if ($param != '') {
            return $this->builder->where('color', 'LIKE', "%$param%");
        }
        return $this->builder;
    }

    public function breed($param = '')
    {
        // dd($param);
        if ($param != '') {
            return $this->builder->where('breed', 'LIKE', "%$param%");
        }
        return $this->builder;
    }

    public function owneremail($email = false)
    {
        // dd($email);
        if ($email) {
            return $this->builder->where('contacts.personal_email', 'LIKE', '%' . $email . '%');
        }
        return $this->builder;
    }

    public function ownerphone($cellphone = "")
    {
        // dd($cellphone);
        if ($cellphone != "") {
            return $this->builder->where('contacts.cell_phone', 'LIKE', '%' . $cellphone . '%');
        }
        return $this->builder;
    }

    public function date_range($date=false)
    {
        if ($date) {
            // dd($date);
            $date = explode(' - ', $date);
            $start = date('Y-m-d', strtotime($date[0]));
            $end = date('Y-m-d', strtotime($date[1]));
            return $this->builder->whereBetween('applications.application_date', [$start, $end]);
        }
        return $this->builder;
    }

    public function expireDate($expireDate=false)
    {
        // dd($expireDate);
        if ($expireDate) {
            $expireDate = explode(' - ', $expireDate);
            $start = date('Y-m-d', strtotime($expireDate[0]));
            $end = date('Y-m-d', strtotime($expireDate[1]));
            return $this->builder->whereBetween('applications.application_date', [$start, $end]);
        }
        return $this->builder;
        //return $this->builder->where('files.expiry_date', '>', date('Y-m-d'));
    }

    public function providerId($providerId = '')
    {
        if ($providerId != '') {
            return $this->builder->whereIn('organization.id', $providerId);
        }
        return $this->builder;
    }

    public function certID($id='')
    {
        // dd($id);
        if ($id) {
            $field = 'id';
            if (getSiteSettings('alt_id_true') == 'true'){
                preg_match_all('!\d+!', $id, $id);
                $field = 'alt_id';
                $pet = Pet::where('alt_id', $id)->first();
                if(is_null($pet)){
                    $field = 'id';
                    return $this->builder->where('pets.' . $field, $id);
                }
            }
            return $this->builder->where('pets.' . $field, $id);
        }
        return $this->builder;
    }

    public function cert_number($cert ='')
    {
        if($cert != ''){
            return $this->builder->where('appPet.cert_number', $cert);
        }
        return $this->builder;
    }

}