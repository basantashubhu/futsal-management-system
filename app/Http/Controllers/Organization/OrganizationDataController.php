<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Repo\OrganizationRepo;

class OrganizationDataController extends Controller
{
    static $repo;

    public static function createInstance($model = null)
    {
        return static::$repo = new OrganizationRepo($model);
    }

    public function select2()
    {
        return static::createInstance()->select2();
    }

    public function getData()
    {
        return static::createInstance()->selectData();
    }

    public function getRelation(Organization $organization, $relation)
    {
        return $organization->$relation;
    }
}
