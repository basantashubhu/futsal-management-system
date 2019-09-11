<?php


namespace App\Lib\Filter\PaymentFIlter;


use App\Lib\Filter\AbstractFilter;
use App\Models\Application;

class PaymentFilter extends AbstractFilter
{
    public function advancedFilter($data = false)
    {
        $payment_method = '';
        $trans_type = '';
        $appID = '';
        $trans_date = '';
        $voucher = '';
        $trans_status ='';
        foreach ($data as $d):
            if ($d['name'] == 'payment_method'):
                $payment_method = $d['value'];
            elseif ($d['name'] == 'trans_type'):
                $trans_type = $d['value'];
            elseif ($d['name'] == 'applicationID'):
                $appID = $d['value'];
            elseif ($d['name'] == 'trans_date'):
                $trans_date = $d['value'];
            elseif ($d['name'] == 'voucher_number'):
                $voucher = $d['value'];
            elseif ($d['name'] == 'trans_status'):
                $trans_status=$d['value'];
            endif;
        endforeach;

        if ($trans_date)
            $this->trans_date1($trans_date);

        if ($appID)
            $this->application_id($appID);

        if ($voucher)
            $this->voucher($voucher);

        if ($trans_type)
            $this->trans_type($trans_type);

        if ($trans_status)
            $this->trans_status($trans_status);

        if ($payment_method)
            $this->payment_method($payment_method);
    }
    public function trans_status1($trans_status = '')
    {
        // dd($trans_status);
       if ($trans_status != '') {
           return $this->builder->whereIn('trans_status', $trans_status);
       }
       return $this->builder;
    }

    public function trans_status($trans_status = '')
    {
        // dd($trans_status);
       if ($trans_status != '') {
           return $this->builder->whereIn('trans_status', $trans_status);
       }
        // $pos = null;
        // if ($trans_status != '') {
        //     $precond = $this->builder->wheres;
        //     foreach ($precond as $key => $cond) {
        //         if (array_key_exists('column', $cond) && $cond['column'] == 'trans_status')
        //             $pos = $key;
        //     }
        //     if (is_null($pos))
        //         $this->builder->where('trans_status', $trans_status);
        //     else {
        //         $prev = $this->builder->wheres[$pos]['value'][0];

        //         $this->builder->wheres[$pos]['value'][0]=$trans_status;
        //         foreach ($this->builder->bindings['where'] as $key=>$b)
        //         {
        //             if($b==$prev)
        //                 $this->builder->bindings['where'][$key]=$trans_status;
        //         }
        //     }

        //     return $this->builder;
        // }
        return $this->builder;
    }

    public function statusDate($v = '')
    {
        // dd($v);
        if($v != ""){
            if(is_array($v)){
                if(!array_key_exists("value", $v[1]) && array_key_exists("value", $v[0])){
                    $range = explode(' - ', $v[0]['value']);
                    $start = date('Y-m-d', strtotime($range[0]));
                    $end = date('Y-m-d', strtotime($range[1]));
                    return $this->builder->whereBetween('payment.trans_date', [$start, $end]);
                }elseif(!array_key_exists("value", $v[0]) && array_key_exists("value", $v[1])){
                    return $this->builder->whereIn('payment.trans_status', $v[1]["value"]);
                }elseif(array_key_exists("value", $v[1]) && array_key_exists("value", $v[0])){
                    $range = explode(' - ', $v[0]['value']);
                    $start = date('Y-m-d', strtotime($range[0]));
                    $end = date('Y-m-d', strtotime($range[1]));
                    // dd($range);
                    return $this->builder->whereBetween('payment.trans_date', [$start, $end])->whereIn('payment.trans_status', $v[1]["value"]);
                }
            }
            return $this->builder;
        }
        return $this->builder;
    }

    public function trans_type($trans_type = '')
    {
        if ($trans_type != '') {
            return $this->builder->where('trans_type', $trans_type);
        }
        return $this->builder;
    }

    public function application_id($application_id = '')
    {

        if ($application_id != '') {
            if (getSiteSettings('alt_id_true') == 'true') {
                preg_match_all('!\d+!', $application_id, $application_id);

                if ($app = Application::where('alt_id', $application_id)->first()) {
                    return $this->builder->where('table_id', $app->id)->where('table_name', 'applications');
                } else {
                    return $this->builder->where('table_name', 'not_found');
                }
            }
            return $this->builder->where('table_id', $application_id)->where('table_name', 'applications');
        }
        return $this->builder;
    }

    public function trans_date($trans_date = '')
    {
        if ($trans_date != '') {
            $range = explode('-', $trans_date);
            $start = date('Y-m-d', strtotime($range[0]));
            $end = date('Y-m-d', strtotime($range[1]));
            return $this->builder->whereBetween('trans_date', [$start, $end]);
        }
        return $this->builder;
    }

    public function trans_date1($trans_date = '')
    {
        if ($trans_date != '') {
            // dd($trans_date);
            return $this->builder->where('payment.trans_date', $trans_date);
        }
        return $this->builder;
    }

    public function payment_method($payment_method = '')
    {
        if ($payment_method != '') {
            return $this->builder->where('payment_method', 'LIKE', '%' . $payment_method . '%');
        }
        return $this->builder;
    }

    public function voucher($invoice = '')
    {
        if ($invoice != '') {
            return $this->builder->where('payment.invoice_id', $invoice);
        }
        return $this->builder;
    }

    public function provider($provider = '')
    {
        if ($provider != '') {
            return $this->builder->whereIn('organization.id', $provider);
        }
        return $this->builder;
    }
}