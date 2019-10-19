<?php

namespace App\Http\Controllers\Schedule;

use App\Http\Controllers\RootController;
use App\Models\Court;
use Illuminate\Http\Request;

class ScheduleShowController extends RootController
{
    public function index()
    {
        return $this->view('schedules.index');
    }

    public function add()
    {
        return $this->view('schedules.includes.add');
    }

    public function create(Request $request)
    {
        $court = Court::query()->findOrFail($request->court_id);
        return $this->view('schedules.includes.rightSection', compact('court'));
    }
}
