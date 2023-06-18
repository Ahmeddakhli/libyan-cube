<?php

namespace Modules\Compares\Http\Requests;

use App\Http\Requests\FormRequest;

class UpdateCompareRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:compares,id,deleted_at,NULL',
            'unit_id' => 'required|exists:i_units,id,deleted_at,NULL'
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
