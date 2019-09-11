<?php

namespace App\Http\Requests\Fgp;

use Illuminate\Foundation\Http\FormRequest;

class PayperiodRequest extends FormRequest
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
        return array_merge( validation_value('pay_period_form'), array([
            'pay_code'=>'unique:pay_periods,pay_code',
        ]));
    }
}
