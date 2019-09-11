<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    protected $table="invoice_line_item";

    public function invoice()
    {
        return $this->belongsTo(Invoice::class,'inv_id');
    }

    public function pet()
    {
        return $this->belongsTo(Pet::class,'animal_id');
    }

    public function provider()
    {
        return $this->belongsTo(Organization::class,'provider_id')->with('address');
    }

    public function application()
    {
        return $this->belongsTo(Application::class,'application_id');
    }

}