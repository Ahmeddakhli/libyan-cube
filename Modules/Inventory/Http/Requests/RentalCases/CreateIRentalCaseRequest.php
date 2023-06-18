<?php

namespace Modules\Inventory\Http\Requests\RentalCases;

use App\Http\Requests\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Exception;

class CreateIRentalCaseRequest extends FormRequest
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
        $array['i_unit_id'] = "required|exists:i_units,id,deleted_at,NULL";
        $array['renter_id'] = "required|exists:users,id,deleted_at,NULL";
        $array['from'] = "required|date_format:Y-m-d H:i";
        $array['to'] = "nullable|date_format:Y-m-d H:i";
        $array['price'] = "nullable|integer|max:2147483647";

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
