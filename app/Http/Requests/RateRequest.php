<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RateRequest extends FormRequest
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
        return validation_value('rate_form');
    }

    public function messages()
    {
        return [
            'plan_id.required'=>'Plan Name is required',
            'rate_type_id.required'=>'Rate  Type is required',
            'treatment_id.required'=>'Treatment is required',
            'animal_type.required'=>'Animal Type is required',
            'sex.required'=>'Sex is required',
            'cost.required'=>'Cost is required'
        ];
    }
}
