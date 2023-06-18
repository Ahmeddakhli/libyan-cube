<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\FormRequest;

class UpdateUserPermissionsRequest extends FormRequest
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
        $id = $this->request->get('id');

        return [
            'id' => "required|exists:users,id,deleted_at,NULL",
            'permissions' => 'nullable|array',
            'permissions.*' => "integer|exists:permissions,id,deleted_at,NULL"
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
