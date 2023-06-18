<?php

namespace Modules\ContactUS\Http\Requests\Subscribes;

use App\Http\Requests\FormRequest;

class UpdateSubscribeRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:subscribes,id,deleted_at,NULL',
            'email' => 'nullable|string|max:191|email',
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
