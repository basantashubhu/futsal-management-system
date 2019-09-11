<?php

namespace App\Models\Fgp;

use Illuminate\Database\Eloquent\Model;
use App\Models\Fgp\TableMaintenance;

class TableField extends Model
{
    public function tableMain()
    {
        return $this->belongsTo(TableMaintenance::class, 'table_man_id');
    }
}
