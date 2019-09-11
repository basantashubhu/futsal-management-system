<?php


namespace App\Lib\Filter\ApplicationFilter;


use App\Lib\Filter\AbstractFilter;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ApplicationFilter extends AbstractFilter
{
    public function advancedFilter($data = false)
    {
        // dd($data);
        $status = [];
        $clientName = '';
        $ssn = '';
        $cellPhone = '';
        $email = '';
        $zipCode = '';
        $applicationID = '';
        $fixedandfabid = '';
        $dateRange = '';
        $source = [];
        $serviceProvider = [];
        $vetName = '';
        if ($data):
            foreach ($data as $d):
                if ($d['name'] == 'clientName'):
                    $clientName = $d['value'];
                elseif ($d['name'] == 'applicationSsnFilter'):
                    $ssn = $d['value'];
                elseif ($d['name'] == 'status[]'):
                    if(isset($d['value'])){
                        array_push($status, $d['value']);
                    }else{
                        $status =[];
                    }
                elseif ($d['name'] == 'cellPhone'):
                    $cellPhone = $d['value'];
                elseif ($d['name'] == 'email'):
                    $email = $d['value'];
                elseif ($d['name'] == 'zipCode'):
                    $zipCode = $d['value'];
                elseif ($d['name'] == 'appID'):
                    $applicationID = $d['value'];
                elseif ($d['name'] == 'fixedandfabid'):
                    $fixedandfabid = $d['value'];
                elseif ($d['name'] == 'dateRange'):
                    $dateRange = $d['value'];
                elseif ($d['name'] == 'source[]'):
                    // $source = $d['value'];
                    if(isset($d['value'])){
                        array_push($source, $d['value']);
                    }else{
                        $source = [];
                    }
                elseif ($d['name'] == 'serviceProvider'):
                    if(isset($d['value'])){
                        array_push($serviceProvider, $d['value']);
                    }
                    else{
                        $serviceProvider = [];
                    }
                elseif ($d['name'] == 'vetName'):
                    $vetName = $d['value'];
                elseif ($d['name'] == 'date_range'):
                    $date_range = $d['value'];
                endif;
            endforeach;
        endif;
        if ($source)
            $this->source($source);

        if ($status)
            $this->statusA($status);

        if ($clientName)
            $this->clientName($clientName);

        if ($dateRange)
            $this->date_range($dateRange);

        if ($applicationID)
            $this->applicationID($applicationID);

        if ($fixedandfabid)
            $this->fixedandfabid($fixedandfabid);

        if ($ssn)
            $this->ssn($ssn);

        if ($cellPhone)
            $this->cellPhone($cellPhone);

        if ($email)
            $this->email($email);

        if ($zipCode)
            $this->zipCode($zipCode);

        if ($serviceProvider)
            $this->providerId($serviceProvider);

        if ($vetName)
            $this->vetName($vetName);

        // $this->date_range($date_range);
    }

    public function applicationID($id = false)
    {
        $field = 'id';
        if ($id) {
            if (getSiteSettings('alt_id_true') == 'true') {
                $field = 'alt_id';
                preg_match_all('!\d+!', $id, $id);
            }
            return $this->builder->where('applications.' . $field, $id);
        }
        return $this->builder;
    }

    public function appID($id = false)
    {
        $field = 'id';
        if ($id) {
            if (getSiteSettings('alt_id_true') == 'true') {
                $field = 'alt_id';
                preg_match_all('!\d+!', $id, $id);
            }
            
            return $this->builder->where('applications.' . $field, $id);
        }
        return $this->builder;
    }

    public function fixedandfabid($id = false)
    {
        if ($id) {
            return $this->builder->where('applications.external_id', $id);
        }
        return $this->builder;
    }

    public function source($source = "")
    {
        if ($source != "") {
            if (in_array('Manual', $source)) {
                array_push($source, 'CSV');
            }
            return $this->builder->whereIn('applications.source', $source);
        }
        return $this->builder;
    }

    public function sourceDate($v = "")
    {
        if($v != ""){
            if(is_array($v)){
                if(!array_key_exists("value", $v[0]) && array_key_exists("value", $v[1])){
                    if(array_key_exists('name',$v[1])){
                        $type = $v[1]['name'];
                    }else{
                        $type = 'application_date';
                    }
                    if($type=="date_range"){
                        $type = 'application_date';
                    }
                    $range = explode(' - ', $v[1]['value']);
                    $start = date('Y-m-d', strtotime($range[0]));
                    $end = date('Y-m-d', strtotime($range[1]));
                    return $this->builder->whereBetween('applications.'.$type, [$start, $end]);
                }elseif(!array_key_exists("value", $v[1]) && array_key_exists("value", $v[0])){
                    return $this->builder->whereIn('applications.source', $v[1]["value"]);
                }elseif(array_key_exists("value", $v[1]) && array_key_exists("value", $v[0])){
                    if(array_key_exists('name',$v[1])){
                        $type = $v[1]['name'];
                    }else{
                        $type = 'application_date';
                    }
                    if($type=="date_range"){
                        $type = 'application_date';
                    }
                    $range = explode(' - ', $v[1]['value']);
                    $start = date('Y-m-d', strtotime($range[0]));
                    $end = date('Y-m-d', strtotime($range[1]));
                    return $this->builder->whereIn('applications.source', $v[0]["value"])->whereBetween('applications.'.$type, [$start, $end]);
                }
            }
            return $this->builder;
        }
        return $this->builder;
    }

    public function statusDate($v = "")
    {
        // dd($v);
        if($v != ""){
            if(is_array($v)){
                if(!array_key_exists("value", $v[0]) && array_key_exists("value", $v[1])){
                    if(array_key_exists('name',$v[1])){
                        $type = $v[1]['name'];
                    }else{
                        $type = 'application_date';
                    }
                    if($type=="date_range"){
                        $type = 'application_date';
                    }
                    $range = explode(' - ', $v[1]['value']);
                    $start = date('Y-m-d', strtotime($range[0]));
                    $end = date('Y-m-d', strtotime($range[1]));
                    return $this->builder->whereBetween('applications.'.$type, [$start, $end]);
                }elseif(!array_key_exists("value", $v[1]) && array_key_exists("value", $v[0])){
                    return $this->builder->whereIn('applications.status', $v[1]["value"]);
                }elseif(array_key_exists("value", $v[1]) && array_key_exists("value", $v[0])){
                    if(array_key_exists('name',$v[1])){
                        $type = $v[1]['name'];
                    }else{
                        $type = 'application_date';
                    }
                    if($type=="date_range"){
                        $type = 'application_date';
                    }
                    $range = explode(' - ', $v[1]['value']);
                    $start = date('Y-m-d', strtotime($range[0]));
                    $end = date('Y-m-d', strtotime($range[1]));
                    return $this->builder->whereBetween('applications.'.$type, [$start, $end])->whereIn('applications.status', $v[0]["value"]);
                }
            }
            return $this->builder;
        }
        return $this->builder;
    }
    

    public function sourceStatusDate($v = "")
    {
        if($v != ""){
            if(is_array($v)){
                if(array_key_exists('name',$v[2])){
                    $type = $v[2]['name'];
                }else{
                    $type = 'application_date';
                }
                if($type=="date_range"){
                    $type = 'application_date';
                }
                $range = explode(' - ', $v[2]['value']);
                $start = date('Y-m-d', strtotime($range[0]));
                $end = date('Y-m-d', strtotime($range[1]));
                if(!array_key_exists("value", $v[0]) && array_key_exists("value", $v[1])){
                    return $this->builder->whereIn('applications.status', $v[1]["value"])->whereBetween('applications.'.$type, [$start, $end]);
                }elseif(!array_key_exists("value", $v[1]) && array_key_exists("value", $v[0])){
                    if (array_key_exists('Manual', $v[0]["value"])) {
                        array_push($v[0]["value"], 'CSV');
                    }
                    return $this->builder->whereIn('applications.source', $v[0]["value"])->whereBetween('applications.'.$type, [$start, $end]);
                }elseif(array_key_exists("value", $v[1]) && array_key_exists("value", $v[0])){
                    if (in_array('Manual', $v[0]["value"])) {
                        array_push($v[0]["value"], 'CSV');
                    }

                    return $this->builder->whereIn('applications.source', $v[0]["value"])->whereIn('applications.status', $v[1]["value"])->whereBetween('applications.'.$type, [$start, $end]);
                }
            }
            return $this->builder;
        }
        return $this->builder;
    }
    /*filter by zip code*/
    public function zipCode($zipCode = "")
    {
        if ($zipCode != "") {
            return $this->builder->where(function ($query) use ($zipCode) {
                $query->where('address.zip_code', 'LIKE', '%' . $zipCode . '%')->orWhere('zip_codes.zip_code', 'LIKE', '%' . $zipCode . '%');
            });
        }
        return $this->builder;
    }

    public function ssn($ssn = "")
    {
        if ($ssn != "") {
            // $ssn1 = Crypt::encryptString(Crypt::encryptString($ssn));
            return $this->builder->where('clients.ref_id', $ssn);
        }
        return $this->builder;
    }
    public function appType($type =''){
        return $this->builder;
    }

    public function cellPhone($cellphone = "")
    {
        if ($cellphone != "") {
            return $this->builder->where('cell_phone', 'LIKE', '%' . $cellphone . '%');
        }
        return $this->builder;
    }

    public function providerId($providerId = '')
    {
        if ($providerId != '') {
            if (is_array($providerId) && count($providerId) > 0)
                return $this->builder->whereIn('apt.provider_id', $providerId);
            else
                return $this->builder->where('apt.provider_id', $providerId);
        }
        return $this->builder;
    }

    /*filter by zip code*/
    public function state($state = "")
    {
        if ($state != "") {
            return $this->builder->where(function ($query) use ($state) {
                $query->where('address.state', 'LIKE', '%' . $state . '%')->orWhere('zip_codes.state', 'LIKE', '%' . $state . '%');
            });
        }
        return $this->builder;
    }

    /*---------------------------------filter By status---------------------------------*/
    public function statusA($status = "")
    {
        $pos = null;
        if ($status != "") {
            if (is_array($status) && count($status) > 0)
            {
                // dd($status[0]);
                return $this->builder->whereIn('applications.status', $status[0]);
            }
            else{
                return $this->builder->where('applications.status', $status);
            }
        }
        else
        {
            return $this->builder->whereIn('applications.status', ['Pending','New','Review','Approved']);
        }
        return $this->builder;
    }
    public function status($status = "")
    {
        // dd($status);
        $pos = null;
        if ($status != "") {
            if (is_array($status) && count($status) > 0){
                
                if (in_array(null, $status)) {
                    return $this->builder;
                }
                if(count($status) === 1){
                    $status1 = explode(',', $status[0]);
                    return $this->builder->whereIn('applications.status', $status1);
                }else{
                    return $this->builder->whereIn('applications.status', $status);
                }
            }
            else{
                return $this->builder->where('applications.status', $status);
            }
//            $precond=$this->builder->wheres;
//            foreach ($precond as $key=>$cond)
//            {
//                if(array_key_exists('column',$cond) && $cond['column']=='status')
//                    $pos=$key;
//            }
//            if(is_null($pos))
//                $this->builder->whereIn('status', $status);
//            else
//            {
//                foreach ($status as $st)
//                {
//                    array_push($this->builder->wheres[$pos]['values'],$st);
//                    array_push($this->builder->bindings['where'],$st);
//                }
//            }
//            return $this->builder;
        }
        else
        {
            return $this->builder->whereIn('status', ['Pending','New','Review','Approved']);
        }
        return $this->builder;
    }
    public function statusOnly($status = "")
    {
        // dd($status);
        if ($status != "") {
            if (is_array($status) && count($status) > 0){
                
                if (in_array(null, $status)) {
                    return $this->builder;
                }
                // dd($status);
                if(count($status) === 1){
                    $status1 = explode(',', $status[0]);
                    return $this->builder->whereIn('applications.status', $status1);
                }
                return $this->builder->whereIn('applications.status', $status);
            }
            else{
                return $this->builder->where('applications.status', $status);
            }
        }
        else
        {
            return $this->builder->whereIn('status', ['Pending','New','Review','Approved']);
        }
        return $this->builder;
    }

    public function statusSingle($status = "")
    {
        if ($status != "") {
            return $this->builder->where('applications.status', $status);
        }
        return $this->builder;
    }


    /*---------------------------------filter By ClientType---------------------------------*/
    public function clientType($ctype = "")
    {
        if ($ctype == 1)
            return $this->builder->whereNull('clients.is_vet')->whereNull('clients.org_id');
        elseif ($ctype == 2)
            return $this->builder->whereNotNull('clients.org_id');
        elseif ($ctype == 3)
            return $this->builder->whereNotNull('clients.is_vet');
        else
            return $this->builder;
    }

    public function clientName($name = false)
    {
        if ($name) {
            $names = explode(' ', $name);
            if (count($names) == 3) {
                $fname = $names[0];
                $mname = $names[1];
                $lname = $names[2];
                return $this->builder->where('clients.fname', 'LIKE', '%' . $fname . '%')->where('clients.lname', 'LIKE', '%' . $lname . '%')->orWhere('clients.mname', 'LIKE', '%' . $mname . '%');
            } else if (count($names) == 2) {
                $fname = $names[0];
                $lname = $names[1];
                return $this->builder->where('clients.fname', 'LIKE', '%' . $fname . '%')->where('clients.lname', 'LIKE', '%' . $lname . '%');
            } else {
                $fname = $names[0];
                // dd($this->builder);
                return $this->builder->where('clients.fname', 'LIKE', '%' . $fname . '%')->orWhere('clients.lname', 'LIKE', '%' . $fname . '%');
            }
        }

        return $this->builder;
    }

    public function vetName($name = false)
    {
        if ($name) {
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
                return $this->builder->where('fname', 'LIKE', '%' . $fname . '%');
            }
        }
        return $this->builder;
    }

    public function serviceProvider($cname = false)
    {
        if ($cname) {
            return $this->builder->where('cname', 'LIKE', '%' . $cname . '%');
        }
        return $this->builder;
    }

    public function copay($copay = '')
    {
//        if ($copay != '') {
//            if ($copay == 'paid')
//                return $this->builder->whereNotNull('copay');
//            else
//                return $this->builder->whereNull('copay');
//        }
        return $this->builder;
    }

    public function email($email = false)
    {
        if ($email) {
            return $this->builder->where('personal_email', 'LIKE', '%' . $email . '%');
        }
        return $this->builder;
    }

    public function date($date = false)
    {
        if ($date) {
            // dd($date);
            return $this->builder->where('application_date', date('Y-m-d', strtotime($date)));
        }
        return $this->builder;
    }

    public function date_range($range = false)
    {
        // dd($range);
		if ($range) {
            if (strpos($range, '-') !== false) {
                $range = explode(' - ', $range);
                $start = date('Y-m-d', strtotime($range[0]));
                $end = date('Y-m-d', strtotime($range[1]));
                // dd($start);
                return $this->builder->whereBetween('applications.application_date', [$start, $end]);
            }else{
                return $this->builder->where('application_date', date('Y-m-d', strtotime($range)));
            }

        }
        return $this->builder;
    }

    public function application_date($range = false)
    {
        // dd($range);
		if ($range) {
            if (strpos($range, '-') !== false) {
                $range = explode(' - ', $range);
                $start = date('Y-m-d', strtotime($range[0]));
                $end = date('Y-m-d', strtotime($range[1]));
                // dd($start);
                return $this->builder->whereBetween('applications.application_date', [$start, $end]);
            }else{
                return $this->builder->where('application_date', date('Y-m-d', strtotime($range)));
            }

        }
        return $this->builder;
    }
    public function approved_date($range = false)
    {
        // dd($range);
		if ($range) {
            if (strpos($range, '-') !== false) {
                $range = explode(' - ', $range);
                $start = date('Y-m-d', strtotime($range[0]));
                $end = date('Y-m-d', strtotime($range[1]));
                // dd($start);
                return $this->builder->whereBetween('applications.approved_date', [$start, $end]);
            }else{
                return $this->builder->where('approved_date', date('Y-m-d', strtotime($range)));
            }

        }
        return $this->builder;
    }
    public function invoiced_date($range = false)
    {
        // dd($range);
		if ($range) {
            if (strpos($range, '-') !== false) {
                $range = explode(' - ', $range);
                $start = date('Y-m-d', strtotime($range[0]));
                $end = date('Y-m-d', strtotime($range[1]));
                // dd($start);
                return $this->builder->whereBetween('applications.invoiced_date', [$start, $end]);
            }else{
                return $this->builder->where('invoiced_date', date('Y-m-d', strtotime($range)));
            }

        }
        return $this->builder;
    }
    public function closed_date($range = false)
    {
        // dd($range);
		if ($range) {
            if (strpos($range, '-') !== false) {
                $range = explode(' - ', $range);
                $start = date('Y-m-d', strtotime($range[0]));
                $end = date('Y-m-d', strtotime($range[1]));
                // dd($start);
                return $this->builder->whereBetween('applications.closed_date', [$start, $end]);
            }else{
                return $this->builder->where('closed_date', date('Y-m-d', strtotime($range)));
            }

        }
        return $this->builder;
    }

    public function printed($p=false){
        if($p){
            return $this->builder->where('applications.is_printed', true);
        }
        return $this->builder;
    }

    public function printStatusDate($v=false){
       // dd($dateRange);
        if ($v) {
            if(is_array($v)){
                // dd($v);
                if(!array_key_exists("value", $v[1]) && array_key_exists("value", $v[0])){
                    $range = explode(' - ', $v[0]['value']);
                    $start = date('Y-m-d', strtotime($range[0]));
                    $end = date('Y-m-d', strtotime($range[1]));
                    return $this->builder->whereBetween('applications.application_date', [$start, $end]);
                }elseif(!array_key_exists("value", $v[0]) && array_key_exists("value", $v[1])){
                    return $this->builder->whereIn('applications.is_printed', $v[1]["value"]);
                }elseif(array_key_exists("value", $v[1]) && array_key_exists("value", $v[0])){
                    $range = explode(' - ', $v[0]['value']);
                    $start = date('Y-m-d', strtotime($range[0]));
                    $end = date('Y-m-d', strtotime($range[1]));
                    return $this->builder->whereBetween('applications.application_date', [$start, $end])->whereIn('applications.is_printed', $v[1]["value"]);
                }
            }
            return $this->builder;
        }
        return $this->builder;
    }

    public function dateRangeWithType($v = false)
    {
        // dd($dateRange);
        if ($v) {
            if(is_array($v)){
                // dd($v);
                if(!array_key_exists("value", $v[1]) && array_key_exists("value", $v[0])){
                    if(array_key_exists('name',$v[0])){
                        $type = $v[0]['name'];
                    }else{
                        $type = 'application_date';
                    }
                    if($type=="date_range"){
                        $type = 'application_date';
                    }
                    $range = explode(' - ', $v[0]['value']);
                    $start = date('Y-m-d', strtotime($range[0]));
                    $end = date('Y-m-d', strtotime($range[1]));
                    return $this->builder->whereBetween('applications.'.$type, [$start, $end]);
                }elseif(!array_key_exists("value", $v[0]) && array_key_exists("value", $v[1])){
                    return $this->builder->whereIn('applications.status', $v[1]["value"]);
                }elseif(array_key_exists("value", $v[1]) && array_key_exists("value", $v[0])){
                    if(array_key_exists('name',$v[0])){
                        $type = $v[0]['name'];
                    }else{
                        $type = 'application_date';
                    }
                    if($type=="date_range"){
                        $type = 'application_date';
                    }
                    $range = explode(' - ', $v[0]['value']);
                    $start = date('Y-m-d', strtotime($range[0]));
                    $end = date('Y-m-d', strtotime($range[1]));
                    return $this->builder->whereIn('applications.status', $v[1]["value"])->whereBetween('applications.'.$type, [$start, $end]);
                }
            }
            return $this->builder;
            // if(array_key_exists('name',$dateRange)){
            //     $type = $dateRange['name'];
            // }else{
            //     $type = 'application_date';
            // }
            // $range = $dateRange['value'];
            
            // $range = explode(' - ', $range);
            // $start = date('Y-m-d', strtotime($range[0]));
            // $end = date('Y-m-d', strtotime($range[1]));
            // if($type == '' || $type == null){
            //     $type = 'application_date';
            // }
            // return $this->builder->whereBetween('applications.' . $type, [$start, $end]);
        }
        return $this->builder;
    }
    public function dateWithType($v = false)
    {
        // dd($v);
        if ($v) {
            if(is_array($v)){
                // dd($v);
                    if(array_key_exists('name',$v)){
                        $type = $v['name'];
                    }else{
                        $type = 'application_date';
                    }
                    if($type=="date_range"){
                        $type = 'application_date';
                    }
                    // dd($type);
                    $range = explode(' - ', $v['value']);
                    $start = date('Y-m-d', strtotime($range[0]));
                    $end = date('Y-m-d', strtotime($range[1]));
                    return $this->builder->whereBetween('applications.'.$type, [$start, $end]);
            }
            return $this->builder;
        }
        return $this->builder;
    }

    public function city($city = false)
    {
        if ($city) {
            return $this->builder->where(function ($query) use ($city) {
                $query->where('address.city', 'LIKE', '%' . $city . '%')->orWhere('zip_codes.city', 'LIKE', '%' . $city . '%');
            });
        }
        return $this->builder;
    }

    /*---------------------------------filter By petType---------------------------------*/
    public function petType()
    {

    }


    /*-------------Filter By Files Title -------------*/
    public function documentTitle($name = false)
    {
        if ($name) {
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
                return $this->builder->where('fname', 'LIKE', '%' . $fname . '%');
            }
        }
        return $this->builder;
    }


    public function type($type = false)
    {
        // dd($type);
        if ($type) {
            if($type == "IE") {
                return $this->builder->whereNull('clients.org_id');
            }elseif($type == "NP") {
                // dd($type);
                return $this->builder->whereRaw('clients.org_id = organization.id')->whereNotNull('clients.org_id');
            }elseif($type == "Rescue") {
                // dd($type);
                return $this->builder->whereRaw('clients.org_id != organization.id')->whereNotNull('clients.org_id');
            }else{
                return $this->builder;
            }
        }
        return $this->builder;
    }

}