<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RateTypeRequest extends FormRequest
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
        return validation_value('rate_type_form');
    }

    public function messages()
    {
        return [
            'name.required'=>'Name is required',
            'rate_metrics_type.required'=>'Rate Metrics Type is required',
            'rate_metrics.required'=>'Rate Metrics is required',
            'rate_unit.required'=>'Rate Unit is required'
        ];
    }
}
