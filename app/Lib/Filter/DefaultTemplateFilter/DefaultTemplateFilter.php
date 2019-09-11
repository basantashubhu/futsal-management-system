<?php


namespace App\Lib\Filter\DefaultTemplateFilter;


use App\Lib\Filter\AbstractFilter;

class DefaultTemplateFilter extends AbstractFilter
{
//    public function temp_name($query = false)
//    {
//        if ($query) {
//            return $this->builder->where('temp_name', "LIKE", "%$query%");
//        }
//        return $this->builder;
//    }
//
//    public function section($query = false)
//    {
//        if ($query) {
//            return $this->builder->where('section', 'LIKE', "%$query%");
//        }
//        return $this->builder;
//    }

    public function template_name($query = false) {
        if ($query) {
            return $this->builder->where('template_name',"LIKE","%$query%");
        }
        return $this->builder;
    }


}