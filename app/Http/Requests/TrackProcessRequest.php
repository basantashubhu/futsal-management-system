<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrackProcessRequest extends FormRequest
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
        return validation_value('tracking_process_form');
    }
    public function messages()
    {
        return [
            'sent_method.required' => 'Method is required',
            'sent_tracking_no.required' => 'Tracking Number is required',
            'sent_date.required' => 'Sent Date is required'
        ];
    }
}
