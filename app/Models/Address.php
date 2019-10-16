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
}
