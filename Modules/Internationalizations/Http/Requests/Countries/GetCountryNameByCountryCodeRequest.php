<?php

namespace Modules\Internationalizations\Http\Requests\Countries;

use App\Http\Requests\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Internationalizations\Http\Controllers\Actions\Countries\AllCountryCodesAction;

class GetCountryNameByCountryCodeRequest extends FormRequest
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
        $action = new AllCountryCodesAction;
        $country_codes = $action->execute();

        return [
            'code' => ["required", "string", "max:191", Rule::in($country_codes)]
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
