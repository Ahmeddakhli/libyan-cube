<?php

namespace Modules\Inventory\Http\Requests\Developers;

use App\Http\Requests\FormRequest;
use Illuminate\Validation\Rule;

class DeleteIDeveloperRequest extends FormRequest
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
        $array = array();
        $array['id'] = "required|exists:i_developers,id,deleted_at,NULL";

        return $array;
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
