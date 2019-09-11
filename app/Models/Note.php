<?php

namespace App\Models;

use App\Models\Fgp\Site;
use App\Models\Fgp\Volunteer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Note extends Model
{
	protected  $fillable = [
        'period_id', 'vol_id', 'site_id', 'start', 'end', 'userc_date', 'userc_id', 'todo_timestamp', 'note_desc', 'note_type', 'note_code', 'status', 'priority', 'is_comlpeted', 'is_seen','seen_date', 'is_active', 'title', 'url', 'attachfile','reminder_timestamp','note_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'userc_id');
    }

    public function site()
    {
        return $this->belongsTo(Site::class, 'site_id');
    }

    public function volunteer()
    {
        return $this->belongsTo(Volunteer::class, 'vol_id');
    }

    public function files()
    {
        return $this->morphMany(File::class, 'table', 'table', 'table_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();
        Relation::morphMap([
            'notes' => static::class
        ]);
    }


}
