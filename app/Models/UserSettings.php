<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSettings extends Model
{
    protected $fillable = ['type', 'user_id', 'value'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
