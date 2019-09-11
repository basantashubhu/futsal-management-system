<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CitizenApplicationRequest extends FormRequest
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
            'species'=>'required',
            'sex'=>'required',
            'age_type'=>'required',
            'age_of_pet'=>'required',
            'weight'=>'required',
            'color'=>'required',
            'breed'=>'required',
        ];
        if(getSiteSettings('application_upload_required')=='yes')
        {
            $data['photoIdProof']='required|file|max:8592';
            $data['anualProof']='required|file|max:8592';
        }
        elseif (getSiteSettings('application_upload_required')=='no')
        {
            $data['photoIdProof']='file|max:8592';
            $data['anualProof']='file|max:8592';
        }
        return $data;
    }
}
