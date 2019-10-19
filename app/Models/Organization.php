<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Organization extends Model
{

    public static function boot()
    {
        parent::boot();
        Relation::morphMap([
            'organizations' => static::class,
        ]);
    }

    public function details($key = null)
    {
        if ($key) {
            return $this->details->firstWhere('code', $key);
        }
        return $this->hasMany(OrganizationDetal::class, 'organization_id');
    }

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable', 'table_name', 'table_id');
    }

    public function contact()
    {
        return $this->morphOne(Contact::class, 'contactable', 'table_name', 'table_id');
    }
}
