<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public function Client()
    {
        return $this->belongsTo(Client::class,'client_id');
    }

    public function getPersonalEmail()
    {
        if(strpos('Fake__',$this->personal_email))
            return '';
        else
            return $this->personal_email;
    }

    
}