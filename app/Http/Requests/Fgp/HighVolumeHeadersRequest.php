<?php

namespace App\Http\Requests\Fgp;

use Illuminate\Foundation\Http\FormRequest;

class HighVolumeHeadersRequest extends FormRequest
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
        return validation_value('high_volume_header_form');
    }

    public function message()
    {
        
    }
}
