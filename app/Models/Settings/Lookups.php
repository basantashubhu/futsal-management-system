<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class Lookups extends Model
{
    protected  $fillable = [
        'code','value','type','section','userc_id', "description", 'is_deleted'
    ];
}
