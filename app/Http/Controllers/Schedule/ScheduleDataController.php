<?php

namespace App\Http\Controllers\Schedule;

use App\Http\Controllers\Controller;
use App\Repo\ScheduleRepo;

class ScheduleDataController extends Controller
{
    static $repo;
    public static function getInstance($model = null)
    {
        return static::$repo = new ScheduleRepo($model);
    }
    public function getData()
    {
        return static::getInstance()->selectData();
    }
}
