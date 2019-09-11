<?php

namespace App\Http\Controllers\Fgp\Calendar;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class CalendarShowController extends BaseController
{

    private static $path;

    public function __construct()
    {
        parent::__construct();

        self::$path = $this->layout . '.fgp.calendar';
    }

    public function __invoke()
    {

        return view(self::$path . '.index');

    }

    public function getData(Request $request)
    {
        # code...
        return [];
    }
}
