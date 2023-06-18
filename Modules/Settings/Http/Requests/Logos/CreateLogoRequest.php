<?php

namespace Modules\Settings\Http\Requests\Logos;

use App\Http\Requests\FormRequest;

class CreateLogoRequest extends FormRequest
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
            'image' => 'required|mimes:jpg,jpeg,png,svg|max:102400',
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
