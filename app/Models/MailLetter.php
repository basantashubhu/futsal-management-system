<?php

namespace App\Models;

use App\File;
use Illuminate\Database\Eloquent\Model;

class MailLetter extends Model
{
    public function files()
    {
        $this->files = File::where('table', 'mail_letters')->where('table_id', $this->id)->first();
        return $this;
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'table_id');
    }

    public function application()
    {
        return $this->belongsTo(Application::class, 'table_id');
    }
}
