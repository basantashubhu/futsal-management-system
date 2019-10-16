<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\RootController;

class OrganizationShowController extends RootController
{
    public function index()
    {
        $type = '';
        return $this->view('organization.index', compact('type'));
    }

    public function create()
    {
        $title = 'Organization';
        return $this->view('organization.modals.add', compact('title'));
    }
}
