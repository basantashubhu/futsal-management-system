<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class ZipCode extends Model
{
    protected $guarded = [];

    public function setStateAttribute($state)
    {
        $this->attributes['state'] = strtolower($state);
    }

    public function getStateAttribute()
    {
       return strtoupper($this->attributes['state']);
    }
}
