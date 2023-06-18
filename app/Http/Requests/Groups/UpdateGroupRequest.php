<?php

namespace App\Http\Requests\Groups;

use App\Http\Requests\FormRequest;

class UpdateGroupRequest extends FormRequest
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
            'id' => "required|exists:groups,id,deleted_at,NULL",
            'parent_id' => "required|exists:groups,id,deleted_at,NULL",
            'name' => "required|max:90|string|unique:groups,name,{$id},id,deleted_at,NULL",
            'description' => 'nullable|string|max:191'
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
