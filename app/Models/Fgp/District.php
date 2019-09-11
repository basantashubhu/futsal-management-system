<?php

namespace App\Models\Fgp;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class District extends Model
{
    protected  $fillable = ['is_deleted','state_id','region_id','county_id'];
    /*
     * eager loading sites from function not from relation
     * */
    public $eager_sites = [];

    public function city(){
        return $this->hasMany(City::class, 'district_id', 'id');
    }

    public function county(){
        return $this->belongsTo(County::class,'county_id', 'id');
    }

    public function sites() {
        /*
         * IF RELATIONSHIP DEFINED BELOW WORKS CORRECTLY everywhere
         * CODE BELOW CAN BE REMOVED
         *
         * $this->eager_sites= Site::select('site_name', 'id')
            ->whereHas('address', function($query) {
                $query->where('district', $this->district_name);
            })->get();
        return count($this->eager_sites) > 0;*/
        return $this->belongsToMany(Site::class, 'address', 'district', 'table_id', 'district_name', 'id')
            ->where('address.table_name', 'sites');
    }
}
