<?php

namespace Modules\Inventory\Http\Requests\Favorites;

use App\Http\Requests\FormRequest;

class FavoriteIUnitRequest extends FormRequest
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
            'unit_id' => 'required|exists:i_units,id,deleted_at,NULL',
        ];
    }
}
