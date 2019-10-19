<?php

namespace App\Lib\Filter\OrganizationFilter;

use App\Lib\Filter\AbstractFilter;

class OrganizationFilter extends AbstractFilter
{
    public function term($searchText = false)
    {
        if (!$searchText) {
            return;
        }

        $this->builder->where('organizations.name', 'like', "%$searchText%");
    }

    public function generalSearch($searchText = false)
    {
        $this->term($searchText);
    }
}
