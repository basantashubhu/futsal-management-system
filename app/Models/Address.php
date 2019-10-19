<?php

namespace App\Models;

use App\Models\Settings\ZipCode;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';
    protected $guarded = [];

    public function zip()
    {
        return $this->belongsTo(ZipCode::class, 'zip_id');
    }

    public function format()
    {
        $addr = implode(', ', array_filter($this->only('add1', 'add2')));
        $city = "$this->city - $this->zip_code, $this->state";
        return implode(', ', [$addr, $city]);
    }
}
