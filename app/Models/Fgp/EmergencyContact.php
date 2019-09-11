<?php

namespace App\Models\Fgp;

use App\Models\Contact;
use App\Models\Address;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;


class EmergencyContact extends Model
{
    protected $fillable = [
        'volunteer_id','salutation','first_name','last_name','relation'
    ];
    protected static function boot(){
    	parent::boot();

    	Relation::morphMap([
    	    'emergencyContacts' => self::class
    	]);
    }

    public function contact(){
    	return $this->morphOne(Contact::class, 'table', 'table_name', 'table_id');
    }

    public function address(){
    	return $this->morphOne(Address::class, 'table', 'table_name', 'table_id');
    }

}
