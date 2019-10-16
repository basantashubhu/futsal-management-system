<?php

namespace App\Models;

use App\Models\Address;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Member extends Model
{
    protected $table = 'members';

    protected $guarded = [];

    public static function boot()
    {
        parent::boot();
        Relation::morphMap([
            'members' => static::class,
        ]);
    }

    public function fullname($withMiddleName = false)
    {
        $name = [$this->first_name, $this->last_name];
        return $withMiddleName === false ? join(' ', $name) : join(" $this->middle_name ", $name);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function address()
    {
        return $this->morphOne(Address::class, 'addressable', 'table_name', 'table_id', 'user_id')
            ->where('is_deleted', 0)
            ->withDefault(['add1' => '']);
    }

    public function contact()
    {
        return $this->morphOne(Contact::class, 'contactable', 'table_name', 'table_id', 'user_id')
            ->where('is_deleted', 0)
            ->withDefault(['cell_phone' => '']);
    }
}
