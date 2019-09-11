<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return validation_value('vet_form');
    }
    public function messages()
    {
        return [
            'fname.required' => 'Client first name is required',
            'lname.required' => 'Client last name is required',
            'add1.required' => 'Primary address is required',
            'city.required' => 'City name is required',
            'zip.required' => 'Zip Code is required',
            'org_id.required' => 'Organization is required',
            'vet_lic.required' => 'Vet License is required',
        ];
    }
}
