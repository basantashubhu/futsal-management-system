<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
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
            'name' => ['required','string','alpha_dash'],
            'email' => 'required|string|email|max:255',
            'role_id' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'Username is required',
            'name.alpha_dash'=>'Username must contain alpha numeric character dash and underscore only',
            'name.max'=>'Name can have maximum 255 character',
            'email.required'=>'Email is required',
            'email.string'=>'Email must be String',
            'email.email'=>'Email must be valid',
            'email.max'=>'Email can have maximum 255 character',
            'role_id.required'=>'Role is required',
            'role_id.numeric'=>'Role must be selected',
        ];
    }
}
