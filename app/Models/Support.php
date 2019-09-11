<?php

namespace App\Models;

use App\Models\SupportComment;
use Illuminate\Database\Eloquent\Model;
use App\File;

class Support extends Model
{
    public function creator()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function assigned()
    {
        return $this->belongsToMany(User::class, 'support_user', 'support_id','assigned_to');
    }

    public function comments()
    {
        return $this->hasMany(SupportComment::class, 'support_id')->whereNull('comment_id');
    }

    public function currentlyAssigned()
    {
        if (count($this->assigned) && $user = end($this->assigned)) {
            return $user[0];
        }
        return false;
    }
}
