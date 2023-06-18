<?php

namespace Modules\Inventory\Http\Requests\Units;

use App\Http\Requests\FormRequest;
use Illuminate\Validation\Rule;

class IUnitsTagsInputRequest extends FormRequest
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
            'needle' => 'nullable|string'
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
