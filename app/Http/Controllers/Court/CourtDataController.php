<?php

namespace App\Http\Controllers\Court;

use App\Http\Controllers\Controller;
use App\Lib\Filter\OrganizationFilter\OrganizationFilter;
use App\Repo\OrganizationRepo;

class CourtDataController extends Controller
{
    /**
     * Table Data
     *
     * @return mixed
     */
    public function getData()
    {
        $organizations = new OrganizationRepo();
        return $organizations->execute(function ($query, $request) {
            $filter = new OrganizationFilter($request);
            $filter->getQuery($query);

            $query->where('organizations.is_deleted', 0);
        })->paginate();
    }
}
