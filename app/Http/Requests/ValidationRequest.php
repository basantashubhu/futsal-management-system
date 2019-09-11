<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidationRequest extends FormRequest
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
        return validation_value('validation_form');
    }
    public function messages()
    {
        return [
            'code.required'=>'Code is required',
            'code.string'=>'Code is must be string',
            'value.required'=>'Value is required',
            'value.string'=>'Value must be string',
        ];
    }
}
