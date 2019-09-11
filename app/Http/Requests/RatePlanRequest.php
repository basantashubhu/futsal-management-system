<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RatePlanRequest extends FormRequest
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
        return validation_value('rate_plan_form');
    }

    public function messages()
    {
        return [
            'plan_name.required'=>'Plan Name is required',
            'start_date.required'=>'Start Date is required',
            'end_date.required'=>'End Date is required'
        ];
    }
}
