<?php

namespace Modules\Settings\Http\Requests\Branches;

use App\Http\Requests\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class CreateBranchRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $array = array();

        $array['branch'] = 'nullable|string|max:191';
        $array['latitude'] = ['required', 'regex:/^-?([1-8]?[1-9]|[1-9]0)\.{1}\d{1,100}$/', 'max:191'];
        $array['longitude'] = ['required', 'regex:/^-?([1]?[1-7][1-9]|[1]?[1-8][0]|[1-9]?[0-9])\.{1}\d{1,100}$/', 'max:191'];

        return $array;
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
