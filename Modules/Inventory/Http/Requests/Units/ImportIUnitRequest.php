<?php

namespace Modules\Inventory\Http\Requests\Units;

use App\Http\Requests\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Exception;
use Modules\Internationalizations\Http\Controllers\Actions\Currencies\AllCurrencyCodesAction;

class ImportIUnitRequest extends FormRequest
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
        $array['units_file'] = 'required|max:131072|mimes:xlsx,xls,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/excel,application/vnd.ms-excel, application/vnd.msexcel,';

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
