<?php

namespace App\Models\Fgp;

use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    protected $fillable = ['is_deleted','county_name','state_id','region_id'];

    public function region(){
    	return $this->belongsTo(Region::class,'region_id');
    }

    public function district() {
        return $this->hasMany(District::class, 'county_id', 'id')->groupBy('district_name');
    }

    public function city() {
        return $this->hasMany(City::class, 'county_id', 'id')->groupBy('city_name');
    }
}
