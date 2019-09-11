<?php


namespace App\Lib\InvoiceFilter;

use App\Lib\Filter\AbstractFilter;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceFilter extends AbstractFilter
{
    public function advancedFilter($data = false)
    {
        $invoiceNumber = '';
        $invoiceDate = '';
        $appID = '';
        $ownerName = '';
        $serviceProvider = [];
        $status = [];
        foreach($data as $d):
            if($d['name'] == 'invoiceNumber'):
                $invoiceNumber = $d['value'];
            elseif($d['name'] == 'invoiceDate'):
                $invoiceDate = $d['value'];
            elseif($d['name'] == 'appID'):
                $appID = $d['value'];
            elseif($d['name'] == 'ownerName'):
                $ownerName = $d['value'];
            elseif($d['name'] == 'provider'):
                // $serviceProvider = $d['value'];
                array_push($serviceProvider, $d['value']);
            elseif($d['name'] == 'status[]'):
                array_push($status, $d['value']);
            endif;
        endforeach;

        if($ownerName)
            $this->clientName($ownerName);

        if($appID)
            $this->applicationID($appID);

        if($serviceProvider)
            $this->providers($serviceProvider);

        if($invoiceDate)
            $this->invoiceDate($invoiceDate);

        if($status)
            $this->status($status);

        if($invoiceNumber)
            $this->invoiceNumber($invoiceNumber);
    }
    public function providers($id = false)
    {
        if ($id):
			return $this->builder->whereIn('organization.id',$id);
        endif;
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

    public function provider($name = false)
    {
        if ($name) {
            return $this->builder->where('organization.cname', 'LIKE', "%$name%");
        }
        return $this->builder;
    }

    public function status($status='')
    {
        $pos=null;
        if($status!='')
        {
            $precond=$this->builder->wheres;
            foreach ($precond as $key=>$cond)
            {
                if(array_key_exists('column',$cond) && $cond['column']=='invoice_status')
                    $pos=$key;
            }
            if(is_null($pos))
                $this->builder->whereIn('invoice_status', $status);
            else
            {
                foreach ($status as $st)
                {
                    array_push($this->builder->wheres[$pos]['values'],$st);
                    array_push($this->builder->bindings['where'],$st);
                }
            }

            return $this->builder;
        }
        else
        {
            return $this->builder->whereIn('invoice.invoice_status',["Approved","Pending","Review"]);
        }
    }

    public function invoiceNumber($invoiceNumber=false)
    {
        if($invoiceNumber)
        {
            return $this->builder->where('invoice_number','like',"%$invoiceNumber%");
        }
        return $this->builder;
    }

    public function invoiceDate($date=false)
    {
        if($date)
        {
            return $this->builder->where('invoice_date','like',"%$date%");
        }
        return $this->builder;
    }

    public function applicationID($id = false)
    {
        $field = 'id';
        if ($id) {
            if (getSiteSettings('alt_id_true') == 'true') {

                $field = 'alt_id';
                preg_match_all('!\d+!', $id, $id);
            }
            return $this->builder->where('app\.' . $field, $id);
        }
        return $this->builder;
    }

}