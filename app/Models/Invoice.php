<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table="invoice_header";

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class,'inv_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class,'client_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class,'inv_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class,'inv_id');
    }

    public function getAllPet()
    {
        $pet=InvoiceItem::where('inv_id',$this->id)->pluck('animal_id');
        return $pet;
    }

    public function PaymentStatus()
    {
        $payment=is_null($this->payment)?0:$this->payment->trans_amount;
        return $payment==$this->invoice_total;
    }

}