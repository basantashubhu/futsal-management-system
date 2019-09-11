<?php


namespace App\Lib;


class Ledger
{
    protected $data = array();
    protected $type='cr';

    /**
     * Ledger constructor.
     * @param $table
     * @param $table_id
     * @param $provider
     * @param $amount
     * @param $invoice_ids
     * @param $type
     */
    public function __construct($table, $table_id, $provider, $amount, $invoice_ids, $ref,$type='cr',$batch=null)
    {
        $this->data['table_name'] = $table;
        $this->data['table_id'] = $table_id;
        $this->data['provider_id'] = $provider;
        $this->data['amount'] = $amount;
        $this->data['invoice_ids'] = $invoice_ids;
        $this->data['ref_type'] = $ref;
        $this->data['batch_id'] = $batch;
        $this->type = $type;
    }

    public function store()
    {
        $ledger = new \App\Models\Ledger;
        foreach ($this->data as $key => $val) {
            if ($key == 'amount') {
                $iskey = $this->type.'_amount';
                $ledger->$iskey =  $val;
            } else {
                $ledger->$key = $val;
            }
        }
        $ledger->userc_id = auth()->id();
        $ledger->save();
        return true;
    }

}