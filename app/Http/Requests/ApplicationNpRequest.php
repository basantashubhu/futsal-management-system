<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationNpRequest extends FormRequest
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
        return [
            'pet_name'=>'required',
            'sex'=>'required',
            'age_type'=>'required',
            'age_of_pet'=>'required',
            'weight'=>'required',
            'species'=>'required',
            'color'=>'required',
            'breed'=>'required',
            'photoIdProof'=>'required|file|max:8592',
            'anualProof'=>'required|file|max:8592',
        ];
    }
}
