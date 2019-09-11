<?php

namespace App\Http\Requests\Fgp;

use Illuminate\Foundation\Http\FormRequest;

class SiteRequest extends FormRequest
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
        return validation_value('site_create');
        // return array_merge( validation_value('site_create'), array(
        //     'site_email' => 'required|unique:sites,site_email')
        // );
    }
}
