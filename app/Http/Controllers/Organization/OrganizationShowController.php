<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\RootController;
use App\Models\Organization;

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

    public function edit(Organization $organization)
    {
        $title = 'Organization';
        return $this->view('organization.modals.edit', compact('organization', 'title'));
    }
}
