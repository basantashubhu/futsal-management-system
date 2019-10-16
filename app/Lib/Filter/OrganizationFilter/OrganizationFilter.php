<?php

namespace App\Lib\Filter\OrganizationFilter;

use App\Lib\Filter\AbstractFilter;

class OrganizationFilter extends AbstractFilter
{
    public function term($searchText)
    {
        if (!$searchText) {
            return;
        }

        $this->builder->where('organizations.name', 'like', "%$searchText%");
    }
}
