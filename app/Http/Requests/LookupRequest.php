<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LookupRequest extends FormRequest
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
        return validation_value('lookup_form');
    }

    public function messages()
    {
        return [
            'code.required'=>'Lookup code is required',
            'value.required'=>'Lookup value is required',
            'value.string'=>'Lookup value must be string'
        ];
    }
}
