<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
        return validation_value('payment_form');
    }

    public function messages()
    {
        return [
            'trans_amount.required'=>'Amount is required',
            'invoice_id.required' => 'Invoice id is required'
        ];
    }
}
