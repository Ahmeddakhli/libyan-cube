<?php

namespace Modules\Internationalizations\Http\Requests\Currencies;

use App\Http\Requests\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Internationalizations\Http\Controllers\Actions\Currencies\AllCurrencyCodesAction;

class GetCurrencyNameByCurrencyCodeRequest extends FormRequest
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
        $action = new AllCurrencyCodesAction;
        $currency_codes = $action->execute();

        return [
            'code' => ["required", "string", "max:191", Rule::in($currency_codes)]
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
