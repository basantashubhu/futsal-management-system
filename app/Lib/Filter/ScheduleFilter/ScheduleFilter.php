<?php

namespace App\Lib\Filter\ScheduleFilter;

use App\Lib\Filter\AbstractFilter;

class ScheduleFilter extends AbstractFilter
{
    public function date($date = false)
    {
        if (!$date) {
            return;
        }

        $this->builder->where('schedules.date', date_create($date)->format('Y-m-d'));
    }
}
