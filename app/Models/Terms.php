<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Terms extends Model
{
    public function org()
    {
    	return $this->belongsTo(Organization::class, 'table_id');
    }

    public function options()
    {
    	return $this->hasMany(Options::class, 'table_id');
    }
}
