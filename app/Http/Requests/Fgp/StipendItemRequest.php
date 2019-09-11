<?php

namespace App\Http\Requests\Fgp;

use Illuminate\Foundation\Http\FormRequest;

class StipendItemRequest extends FormRequest
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
        return validation_value('stipend_item_create');
    }
}
