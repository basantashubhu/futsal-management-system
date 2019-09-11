<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSettings extends Model
{
    protected $fillable = ['code', 'value', 'description', 'section', 'userc_id', 'is_deleted'];
}
