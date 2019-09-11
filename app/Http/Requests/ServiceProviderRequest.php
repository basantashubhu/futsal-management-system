<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceProviderRequest extends FormRequest
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
        return validation_value('sp_application_form');
    }

    public function message()
    {
        return [
            'trans_amount.required'=>'Amount is required',
            'payment_method.required'=>'Payment Method is required',
            'invoice_id.required' => 'Invoice id is required'
        ];
    }
}
