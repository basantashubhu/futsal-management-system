<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrganizationRequest extends FormRequest
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
        $data=[
            'cname'=>'required|string',
            'lic_no'=>'required',
            'add1'=>'required',
            'city'=>'required',
            'state'=>'required',
            'zip'=>'required',
            'phone'=>'required',
            'company_email'=>'required|email',
        ];
        return $data;
    }

    public function messages()
    {
        return [
            'lic_no.required'=>'License No is required',
            'cname.required'=>'Organization name is required',
            'cname.string'=>'Organization name must be String',
            'add1.required'=>'Primary address is required',
            'city.required'=>'City name is required',
            'state.required'=>'State Name is required',
            'zip.required'=>'Zip Code is required',
            'phone.required'=>'Phone number is required',
            'phone.numeric'=>'Phone number must be Numbers',
            // 'phone.regex'=>'Phone number must be in (111)1231234 or 1231231234 format',
            'email.required'=>'Email is required',
            'email.email'=>'Email must be valid'
        ];
    }


}
