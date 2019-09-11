<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name' => 'required|alpha_dash|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
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
            'email.unique'=>'Email must be unique',
            'password.string'=>'Password must be string',
            'password.required'=>'Password is required',
            'password.min'=>'Password must have minimun 6 character',
            'password.Confirmed'=>'Password and Confirm password doesn\'t match',
            'role_id.required'=>'Role is required',
            'role_id.numeric'=>'Role must be selected',
        ];
    }
}
