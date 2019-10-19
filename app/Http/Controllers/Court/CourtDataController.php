<?php

namespace App\Http\Controllers\Court;

use App\Http\Controllers\Controller;
use App\Repo\CourtRepo;

class CourtDataController extends Controller
{
    static $repo;

    public static function createInstance($model = null)
    {
        return static::$repo = new CourtRepo($model);
    }

    /**
     * Table Data
     *
     * @return mixed
     */
    public function getData()
    {
        return static::createInstance()->selectData();
    }
}
