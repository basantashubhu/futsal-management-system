<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TreatmentStatusRequest extends FormRequest
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
        return validation_value('treatment_status');
    }

    public function messages()
    {
        return [
            'treatment_period_state.required'=>'Treatment date is required',
            'comment.required'=>'Comment is required'
        ];
    }
}
