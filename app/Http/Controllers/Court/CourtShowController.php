<?php

namespace App\Http\Controllers\Court;

use App\Http\Controllers\RootController;
use App\Models\Court;

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

    public function edit(Court $court)
    {
        return $this->view('courts.modals.edit', compact('court'));
    }
}
