<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $guarded = [];

    public function edit($params)
    {
        $old_record = $this->__toString();
        $old_id = $this->id;
        $this->fill($params)->save();
        $this->audit($old_id,$old_record, $this->__toString(), auth()->id());
        return $this;
    }

    public function del($userd_id){

        $old_record = $this->__toString();
        $old_id = $this->id;
        $this->is_deleted =  1;
        $this->userd_id  =  $userd_id;
        $this->deleted_at  =  date('Y-m-d H:i:s');
        $this->save();
        $this->audit($old_id,$old_record, $this->__toString(), $userd_id);

        return $this;
    }


    protected function audit($table_id,$old_record, $new_record, $user_id){

        return Audit::create([
            'table_name' => $this->getTable(),
            'table_id' => $table_id,
            'old_record' => $new_record,
            'new_record' => $old_record,
            'user_id'    => $user_id
        ]);
    }



}
