<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TreatmentRequest extends FormRequest
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
        return validation_value('treatment_form');
    }

    public function messages()
    {
        return [
            'treatment_name.required'=>'Treatment Name is required',
            'treatment_type.required'=>'Treatment Type is required'
        ];
    }
}
