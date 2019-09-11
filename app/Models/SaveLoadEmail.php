<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\File;

class SaveLoadEmail extends Model
{
    public function files($id = null)
    {
        return File::select('file_name')->where('table', 'save_load_emails')->where('table_id', $this->id)->get();
    }
}
