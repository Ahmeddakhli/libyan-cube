<?php

namespace App\Http\Requests\Groups;

use App\Http\Requests\FormRequest;
use Illuminate\Validation\Rule;

class CreateGroupRequest extends FormRequest
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
            'parent_id' => "required|exists:groups,id,deleted_at,NULL",
            'name' => "required|max:90|string|unique:groups,name,NULL,id,deleted_at,NULL",
            'description' => 'nullable|string|max:191',
            'permissions_group_id' => "nullable|exists:groups,id,deleted_at,NULL",
            'users' => 'nullable|array',
            'users.*' => "exists:users,id,deleted_at,NULL"
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
