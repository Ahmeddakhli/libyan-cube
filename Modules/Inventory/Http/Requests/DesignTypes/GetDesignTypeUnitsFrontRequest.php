<?php

namespace Modules\Inventory\Http\Requests\DesignTypes;

use App\Http\Requests\FormRequest;

class GetDesignTypeUnitsFrontRequest extends FormRequest
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
            'id' => 'required|exists:i_design_types,id,deleted_at,NULL',
            'project_id' => 'required|exists:i_projects,id,deleted_at,NULL',
            'purpose_type_id' => 'required|exists:i_purpose_types,id,deleted_at,NULL',
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
