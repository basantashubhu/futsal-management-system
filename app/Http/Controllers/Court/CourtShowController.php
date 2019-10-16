<?php

namespace App\Http\Controllers\Court;

use App\Http\Controllers\RootController;

class CourtShowController extends RootController
{
    public function index()
    {
        return $this->view('courts.index');
    }

    public function create()
    {
        return $this->view('courts.modals.create');
    }
}
