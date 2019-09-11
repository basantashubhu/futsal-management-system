<?php


namespace App\Lib\InvoiceFilter;


use App\Lib\Filter\AbstractFilter;

class InvoiceBatchFilter extends AbstractFilter
{
    public function advancedFilter($data = false)
    {
        $invoiceNumber = '';
        $invoiceDate = '';
        $appID = '';
        $ownerName = '';
        $serviceProvider = [];
        $status = '';
        foreach($data as $d):
            if($d['name'] == 'batch_no'):
                $invoiceNumber = $d['value'];
            elseif($d['name'] == 'invoiceDate'):
                $invoiceDate = $d['value'];
            elseif($d['name'] == 'appID'):
                $appID = $d['value'];
            elseif($d['name'] == 'ownerName'):
                $ownerName = $d['value'];
            elseif($d['name'] == 'provider_id'):
                // $serviceProvider = $d['value'];
                array_push($serviceProvider, $d['value']);
            elseif($d['name'] == 'status'):
                $status=$d['value'];
            endif;
        endforeach;


        if($serviceProvider)
            $this->provider_id($serviceProvider);

        if($invoiceDate)
            $this->invoiceDate($invoiceDate);

        if($status)
            $this->status($status);

        if($invoiceNumber && $invoiceNumber!='DE-')
            $this->batch_no($invoiceNumber);
    }

    public function status($status='')
    {
        if($status)
        {
            if(is_array($status)&& count($status)>0)
                return $this->builder->whereIn('invoice_batch.status',$status);
            else
                return $this->builder->where('invoice_batch.status',$status);
        }
        return $this->builder;
    }
    public function status1($status='')
    {
        if($status)
        {
            if(is_array($status)&& count($status)>0)
                return $this->builder->whereIn('invoice_batch.status',$status);
            else
                return $this->builder->where('invoice_batch.status',$status);
        }
        return $this->builder;
    }

    public function date_range($range = '')
    {
        // dd($range);
		if ($range) {
            if (strpos($range, '-') !== false) {
                $range = explode(' - ', $range);
                $start = date('Y-m-d', strtotime($range[0]));
                $end = date('Y-m-d', strtotime($range[1]));
                // dd($start);
                return $this->builder->whereBetween('invoice_batch.invoice_batch_date', [$start, $end]);
            }else{
                return $this->builder->where('invoice_batch_date', date('Y-m-d', strtotime($range)));
            }

        }
        return $this->builder;
    }

    public function statusDate($v = '')
    {
        if($v != ""){
            if(is_array($v)){
                if(!array_key_exists("value", $v[0]) && array_key_exists("value", $v[1])){
                    $range = explode(' - ', $v[1]['value']);
                    $start = date('Y-m-d', strtotime($range[0]));
                    $end = date('Y-m-d', strtotime($range[1]));
                    return $this->builder->whereBetween('invoice_batch.invoice_batch_date', [$start, $end]);
                }elseif(!array_key_exists("value", $v[1]) && array_key_exists("value", $v[0])){
                    return $this->builder->whereIn('invoice_batch.status', $v[1]["value"]);
                }elseif(array_key_exists("value", $v[1]) && array_key_exists("value", $v[0])){
                    $range = explode(' - ', $v[1]['value']);
                    $start = date('Y-m-d', strtotime($range[0]));
                    $end = date('Y-m-d', strtotime($range[1]));
                    return $this->builder->whereBetween('invoice_batch.invoice_batch_date', [$start, $end])->whereIn('invoice_batch.status', $v[0]["value"]);
                }
            }
            return $this->builder;
        }
        return $this->builder;
    }

    public function batch_no($batch_no=false)
    {
        if($batch_no)
        {
            return $this->builder->where('batch_no',$batch_no);
        }
        return $this->builder;
    }

    public function invoiceDate($date=false)
    {
        if($date)
        {
            return $this->builder->where('invoice_batch_date',date('Y-m-d',strtotime($date)));
        }
        return $this->builder;
    }

    public function provider_id($provider_id = false)
    {
        if($provider_id)
        {
            if(is_array($provider_id)&& count($provider_id)>0)
                return $this->builder->whereIn('provider_id',$provider_id);
            else
                return $this->builder->where('provider_id',$provider_id);
        }
        return $this->builder;
    }
    public function provider_id1($provider_id = false)
    {
        if($provider_id)
        {
            if(is_array($provider_id)&& count($provider_id)>0)
                return $this->builder->whereIn('provider_id',$provider_id);
            else
                return $this->builder->where('provider_id',$provider_id);
        }
        return $this->builder;
    }
    public function dateRange($range = '')
    {
        if($range)
        {
            $range = explode(' - ', $range);
            $start = date('Y-m-d', strtotime($range[0]));
            $end = date('Y-m-d', strtotime($range[1]));
            return $this->builder->whereBetween('invoice_batch_date', [$start, $end]);
        }
        return $this->builder;
    }
}