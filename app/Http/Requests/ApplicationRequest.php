<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationRequest extends FormRequest
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
            'fname'=>'required|string',
            'lname'=>'required',
            'dob'=>'required|date',
            'ssn'=>'required|numeric|min:0000|max:9999',
            'add1'=>'required',
            'zip'=>'required|numeric',
            'state'=>'required',
            'city'=>'required',
            'species'=>'required',
            'cell_phone'=>'required',
            'personal_email'=>'required|email',
            'sex'=>'required',
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
