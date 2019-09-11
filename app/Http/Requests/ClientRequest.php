<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
        return validation_value('client_form');
    }

    public function messages()
    {
        return [
            'fname.required' => 'Client first name is required',
            'lname.required' => 'Client last name is required',
            'lname.string' => 'Client last name must be String',
            'fname.string' => 'Client first name must be String',
            'add1.required' => 'Primary address is required',
            'add1.string' => 'Primary address must be String',
            'city.required' => 'City name is required',
            'city.string' => 'City name must be String',
            'state.required' => 'State Name is required',
            'state.string' => 'State Name must be String',
            'zip.required' => 'Zip Code is required',
            'zip.numeric' => 'Zip Code must be Numbers',
            'cell_phone.required' => 'Phone number is required',
            'personal_email.required' => 'Email is required',
            'personal_email.email' => 'Email must be valid',
        ];
    }
}
