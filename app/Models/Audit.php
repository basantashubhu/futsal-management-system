<?php

namespace App\Models;


class Audit extends BaseModel
{
    protected $table = 'audits';

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class)->with('member');
    }
}
