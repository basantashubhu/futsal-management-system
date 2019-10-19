<?php

namespace App\Lib\Filter;

class CourtFilter extends AbstractFilter
{
    public function generalSearch($searchText = false)
    {
        if (!$searchText) {
            return;
        }

        $this->builder->where('courts.name', 'like', "%$searchText%");
    }
}
