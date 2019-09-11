<?php

namespace App\Models\Fgp;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected  $fillable  = ['is_deleted','state_id','region_name'];

    public function county(){
        return $this->hasMany(County::class, 'region_id', 'id');
    }

    public function state(){
        return $this->belongsTo(State::class,'state_id');
    }
}
