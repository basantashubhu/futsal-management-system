<?php

namespace App\Lib\Filter\Fgp;

use App\Lib\Filter\AbstractFilter;

class TemplateManagerFilter extends AbstractFilter{

    public function supervisor($query = false){
        return $this->builder->whereIn('volunteers_supervisors.supervisor_id', $query);
    }

    public function categories($query){
        if(in_array("null", $query)){
            return $this->builder->whereNull('T.category_id')->orWhereIn('T.category_id', $query);
        }
        return $this->builder->whereIn('T.category_id', $query);

    }

    public function volunteers($query = false){
        return $this->builder->whereIn('volunteers.id', $query);
    }

}
