<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'members';

    protected $guarded = [];

    public function fullname($withMiddleName = false)
    {
        $name = [$this->first_name, $this->last_name];
        return $withMiddleName === false ? join(' ', $name) : join(" $this->middle_name ", $name);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
