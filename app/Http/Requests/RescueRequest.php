<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RescueRequest extends FormRequest
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
        return validation_value('rescue_form');
    }

    public function messages()
    {
        return [
            'lic_no.required'=>'License No is required',
            'cname.required'=>'Organization name is required',
            'cname.string'=>'Organization name must be String',
            'add1.required'=>'Primary address is required',
            'add1.string'=>'Primary address must be String',
            'city.required'=>'City name is required',
            'city.string'=>'City name must be String',
            'state.required'=>'State Name is required',
            'state.string'=>'State Name must be String',
            'zip.required'=>'Zip Code is required',
            'zip.numeric'=>'Zip Code must be Numbers',
            'phone.required'=>'Phone number is required',
            'phone.numeric'=>'Phone number must be Numbers',
            'company_email.required'=>'Email is required',
            'company_email.email'=>'Email must be valid'
        ];
    }


}
