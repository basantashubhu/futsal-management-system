<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailSendRequest extends FormRequest
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
        return validation_value('email_send');
    }
    public function messages()
    {
        return [
            'to.required'=>'Email to is required',
            'to.email'=>'This should be valid email',
            'subject.required'=>'Subject is required',
            'message.required'=>'Message is required',
            'file.required'=>'File is required',
        ];
    }
}
