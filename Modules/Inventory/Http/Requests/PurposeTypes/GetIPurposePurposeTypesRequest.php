<?php

namespace Modules\Inventory\Http\Requests\PurposeTypes;

use App\Http\Requests\FormRequest;

class GetIPurposePurposeTypesRequest extends FormRequest
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
            'i_purpose_id' => "required|array",
            'i_purpose_id.*' => "nullable|exists:i_purposes,id,deleted_at,NULL"
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
