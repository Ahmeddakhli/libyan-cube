<?php

namespace Modules\Locations\Http\Requests;

use App\Http\Requests\FormRequest;
use Illuminate\Validation\Rule;

class GetCountryRegionsRequest extends FormRequest
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
            'country_id' => "required|exists:locations,id,deleted_at,NULL"
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
