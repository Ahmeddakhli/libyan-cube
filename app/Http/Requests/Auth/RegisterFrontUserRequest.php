<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\FormRequest;
use Illuminate\Validation\Rule;

class RegisterFrontUserRequest extends FormRequest
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
            // Check if front user
            'group_id' => array("required", "exists:groups,id,deleted_at,NULL", Rule::in([3, 4, 5, 6])),
            'full_name' => 'nullable|max:255|string',
            'image' => 'nullable|image|max:2048|mimes:jpeg,png,jpg',
            'username' => "required|string|max:191|unique:users,username,NULL,id,deleted_at,NULL",
            'email' => "required|email|string|max:191|unique:users,email,NULL,id,deleted_at,NULL",
            'password' => 'required|string|min:6|confirmed',
            'mobile_number' => array('required', 'regex:/((?:\+|00)[17](?: |\-)?|(?:\+|00)[1-9]\d{0,2}(?: |\-)?|(?:\+|00)1\-\d{3}(?: |\-)?)?(0\d|\([0-9]{3}\)|[1-9]{0,3})(?:((?: |\-)[0-9]{2}){4}|((?:[0-9]{2}){4})|((?: |\-)[0-9]{3}(?: |\-)[0-9]{4})|([0-9]{7}))/'),
            'remember_me' => 'nullable|boolean'
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
