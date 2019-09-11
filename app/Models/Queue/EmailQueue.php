<?php

namespace App\Models\Queue;

use App\Models\Application;
use App\Models\Client;
use Illuminate\Database\Eloquent\Model;

class EmailQueue extends Model
{
    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
