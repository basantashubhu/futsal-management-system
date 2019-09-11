<?php

namespace App\Models;

class EmailSettingsModel extends BaseModel
{
    protected $table = 'email_settings';

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = trim($password);
    }
}
