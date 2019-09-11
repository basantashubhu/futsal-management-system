<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailSettingsRequest extends FormRequest
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
        return validation_value('email_settings_form');
    }
    public function messages()
    {
        return [
            'email.required' => 'Email is required',
            'email.email' => 'Email should be valid',
            'email_from.required' => 'Email from is required',
            'server.required' => 'Server is required',
            'password.required' => 'Password is required',
            'mail_type.required' => 'Mail Type is required',
        ];
    }
}
