<?php

namespace App\Models\Fgp;

use Illuminate\Database\Eloquent\Model;
use App\Models\Fgp\TableField;

class TableMaintenance extends Model
{
    public function tableFields()
    {
        return $this->hasMany(TableField::class, 'table_man_id');
    }
}
