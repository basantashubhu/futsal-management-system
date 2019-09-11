<?php


namespace App\Lib\Filter\LedgerFilter;


use App\Lib\Filter\AbstractFilter;

class LedgerFilter extends  AbstractFilter
{

    public function invoiceid($id = false)
    {
        if ($id) {
            return $this->builder->where('invoice_ids',$id);
        }
        return $this->builder;
    }

    public function ledgerNumber($ledgerNumber = false)
    {
        if ($ledgerNumber) {
            return $this->builder->where('id',$ledgerNumber);
        }
        return $this->builder;
    }

    public function lid($id = false)
    {
        if ($id) {
            return $this->builder->where('id',$id);
        }
        return $this->builder;
    }

    public function tdate($date = false)
    {
        if ($date) {
            return $this->builder->whereDate('created_at',$date);
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

    public function pname($cname = false)
    {
        if ($cname) {
            return $this->builder->where('cname', 'LIKE', '%' . $cname . '%');
        }
        return $this->builder;
    }
    public function providerId($providerId=false)
    {
        // dd($providerId);
        if($providerId)
            return $this->builder->whereIn('provider_id',$providerId);
        return $this->builder;
    }

    public function dateRange($range=false)
    {
        if ($range)
        {
            $range = explode(' - ', $range);
            $start = date('Y-m-d 00:00:00', strtotime($range[0]));
            $end = date('Y-m-d 00:00:00', strtotime($range[1]));
            return $this->builder->whereBetween('ledgers.created_at', [$start, $end]);
        }
        else
        {
            $start = date('Y-01-01 00:00:00', strtotime($range[0]));
            $end = date('Y-12-31 23:29:29', strtotime($range[1]));
            return $this->builder->whereBetween('ledgers.created_at', [$start, $end]);
        }
    }

    public function dateRangeProvider($v=false)
    {
        if($v)
        {
            if(is_array($v)){
                // dd($v);
                if(!array_key_exists("value", $v[1]) && array_key_exists("value", $v[0])){
                    $range = explode(' - ', $v[0]['value']);
                    $start = date('Y-m-d', strtotime($range[0]));
                    $end = date('Y-m-d', strtotime($range[1]));
                    return $this->builder->whereBetween('ledgers.created_at', [$start, $end]);
                }elseif(!array_key_exists("value", $v[0]) && array_key_exists("value", $v[1])){
                    return $this->builder->whereIn('provider_id', $v[1]["value"]);
                }elseif(array_key_exists("value", $v[1]) && array_key_exists("value", $v[0])){
                    $range = explode(' - ', $v[0]['value']);
                    $start = date('Y-m-d', strtotime($range[0]));
                    $end = date('Y-m-d', strtotime($range[1]));
                    return $this->builder->whereBetween('ledgers.created_at', [$start, $end])->whereIn('provider_id', $v[1]["value"]);
                }
            }
            return $this->builder;
        }
        return $this->builder;
    }

}