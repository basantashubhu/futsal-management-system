<?php


namespace App\Lib\Filter\SupportFilter;


use App\Lib\Filter\AbstractFilter;

class SupportFilter extends AbstractFilter
{
    public function assign_to($assign_to=false)
    {
        if($assign_to)
        {
            return $this->builder->where('assigned_to',$assign_to);
        }
        return $this->builder;
    }

    public function assign_from($assign_from=false)
    {
        if($assign_from)
        {
            return $this->builder->where('assigned_from',$assign_from);
        }
        return $this->builder;
    }

    public function dateRange($range = false)
    {
        if ($range) {
            $range = explode(' - ', $range);
            $start = date('Y-m-d 00:00:00', strtotime($range[0]));
            $end = date('Y-m-d 23:59:59', strtotime($range[1]));
            return $this->builder->whereBetween('supports.created_at', [$start, $end]);
        }
        return $this->builder;
    }

    public function support_type($support_type=false)
    {
        if($support_type)
        {
            return $this->builder->where('support_type',$support_type);
        }
        return $this->builder;
    }

    public function support_category($support_category=false)
    {
        if($support_category)
        {
            return $this->builder->where('support_category',$support_category);
        }
        return $this->builder;
    }

    public function support_department($support_department=false)
    {
        if($support_department)
        {
            return $this->builder->where('support_department',$support_department);
        }
        return $this->builder;
    }

    public function status($status=false)
    {
        if($status)
        {
            return $this->builder->where('supports.status',$status);
        }
        return $this->builder;
    }

    public function title($title=false)
    {
        if($title)
        {
            return $this->builder->where('supports.title', 'LIKE', '%'.$title.'%');
        }
        return $this->builder;
    }
}