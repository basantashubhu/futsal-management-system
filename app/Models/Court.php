<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Court extends Model
{

    public static function boot()
    {
        parent::boot();
        Relation::morphMap([
            'courts' => static::class,
        ]);
    }

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable', 'table_name', 'table_id');
    }

    public function contact()
    {
        return $this->morphOne(Contact::class, 'contactable', 'table_name', 'table_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'court_id');
    }
}
