<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class InvoiceBatch extends Model
{
    protected $table='invoice_batch';

    public function provider()
    {
        return $this->belongsTo(Organization::class,'provider_id');
    }
}