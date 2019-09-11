<?php

namespace App\Models\Fgp;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['is_deleted','zip_code','city_name','state_id','region_id','county_id','district_id'];
    /*
     * eager loading sites from function not from relation
     * */
    public $eager_sites = [];


    public function district(){
    	return $this->belongsTo(District::class,'district_id');
    }
    public function county(){
    	return $this->belongsTo(County::class, 'county_id');
    }

    public function sites() {
        /*
         *  IF RELATIONSHIP DEFINED BELOW WORKS CORRECTLY everywhere
         *  CODE BELOW CAN BE REMOVED
         *
         * $this->eager_sites = Site::select('site_name', 'id')
            ->whereHas('address', function($query) {
                $query->where('city', $this->city_name);
            })->get();
        return count($this->eager_sites) > 0;
        */
        return $this->belongsToMany(Site::class, 'address', 'city', 'table_id', 'city_name', 'id')
            ->where('address.table_name', 'sites');
    }
}
