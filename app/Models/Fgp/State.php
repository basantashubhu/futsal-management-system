<?php

namespace App\Models\Fgp;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = ['is_deleted','state_name','state_code'];

//    public function region(){
//        return $this->hasMany(Region::class);
//    }

    public function region(){
        return $this->belongsTo(Region::class,'region_id');
    }
}
