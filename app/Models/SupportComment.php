<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportComment extends Model
{
    public function support()
    {
        return $this->belongsTo(Support::class, 'support_id');
    }

    public function replies()
    {
        return $this->hasMany(SupportComment::class, 'comment_id');
    }

    public function comment()
    {
        return $this->belongsTo(SupportComment::class, 'comment_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userc_id');
    }

}
