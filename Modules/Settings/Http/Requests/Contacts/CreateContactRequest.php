<?php

namespace Modules\Settings\Http\Requests\Contacts;

use App\Http\Requests\FormRequest;

class CreateContactRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required|string|max:191',
            'value' => 'required|string|max:191',
            'value_ar' => 'nullable|string|max:191',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
