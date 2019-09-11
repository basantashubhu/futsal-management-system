<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetRequest extends FormRequest
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
        return validation_value('pet_form');
    }

    public function messages()
    {
        return [
            'client_id.required'=>'Client Information is required',
            'pet_name.required'=>'Pet Name is required',
            'pet_name.string'=>'Pet Name must be String',
            'breed.string'=>'Breed must be String',
            'breed.required'=>'Breed  is required',
            'color.required'=>'Color  is required',
            'color.string'=>'Color  must be String',
        ];
    }
}
