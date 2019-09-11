<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ZipCodeRequest extends FormRequest
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
        return validation_value('zip_code_form');

    }
    public function messages()
    {
        return [
            'zip_code.required'=>'Zip code is required',
            'zip_code.number'=>'Zip code must be number',
            'city.required'=>'City is required',
            'city.string'=>'City must be string',
            'country.required'=>'Country is required',
            'country.string'=>'Country must be string',
            'state.required'=>'State is required'
        ];
    }
}
