<?php

namespace Modules\Ratings\Http\Requests;

use App\Http\Requests\FormRequest;

class UpdateRatingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:ratings,id,deleted_at,NULL',
            'rate' => 'required|numeric|min:1|max:5'
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
