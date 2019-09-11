<?php

namespace App\Http\Controllers\Fgp\Program;

use App\Models\Fgp\Program;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\DB;

class ProgramShowController extends BaseController
{
    protected $layout;

    function __construct()
    {
        parent::__construct();
        $this->layout = 'default.fgp.program_setup';
    }

    /**
     * default program setup view page
     */
    function program() {
        $properties = Program::mergedOldProperties();
        return $this->view('program', compact('properties'));
    }

    /**
     * new properties for table
     */
    function newProperties() {
        return Program::newProperties();
    }

    function addForm() {
        $validations = validation_value('addProgramPropertyForm');
        return $this->view('modals.addForm', compact('validations'));
    }

    function editForm($property_id) {
        $validations = validation_value('addProgramPropertyForm');
        $property = DB::table('program_default')->find($property_id);
        return $this->view('modals.editForm', compact('validations', 'property'));
    }
}
