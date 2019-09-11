<?php

namespace App\Http\Controllers\Fgp\Program;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\DB;

class ProgramAddUpdateController extends BaseController
{
    /**
     * save new property of current program to db
     * @param Request $request
     * @return ProgramAddUpdateController|\Illuminate\Http\JsonResponse|string
     */
    function save(Request $request) {
        $this->validateData($request);
        $statement = DB::table('program_default')->insert($request->only('property', 'value', 'value2'));
        return $statement ? $this->response('New property added successfully.', '', 200) : 'unsuccessful';
    }

    /**
     * updates property name and value of program
     * @param Request $request
     * @param         $property_id
     * @return ProgramAddUpdateController|\Illuminate\Http\JsonResponse|string
     */
    function update(Request $request, $property_id) {
        $this->validateData($request, true);
        $statement = DB::table('program_default')->where('id', $property_id)->update($request->only('property', 'value', 'value2'));
        return $statement ? $this->response('Property updated successfully.', '', 200) : 'unsuccessful';
    }

    /**
     * deletes property from db of current program
     * @param $property_id
     * @return ProgramAddUpdateController|\Illuminate\Http\JsonResponse|string
     */
    function delete($property_id) {
        $statement = DB::table('program_table')->delete($property_id);
        return $statement ? $this->response('Property deleted successfully.', '', 200) : 'unsuccessful';
    }

    /**
     * system default validator with custom db validation rules
     * @param Request $request
     * @param bool    $updateQuery
     */
    private function validateData(Request $request, $updateQuery = false)
    {
        $validations = array_merge(validation_value('addProgramPropertyForm'), [
            'value' => 'required_without:value2',
            'property' => 'required' . (!$updateQuery?'|unique:program_default':'')
        ]);
        $this->validate($request, $validations);
    }
}
