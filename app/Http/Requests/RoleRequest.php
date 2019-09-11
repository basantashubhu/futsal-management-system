<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        return validation_value('role_form');
    }

    public function messages()
    {
        return [
            'role.required'=>'Page Name is Required',
            'label.required'=>'Label is Required',
        ];
    }
}
