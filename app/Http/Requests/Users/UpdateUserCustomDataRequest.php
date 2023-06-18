<?php

namespace App\Http\Requests\Users;

use App\Http\Requests\FormRequest;
use Illuminate\Validation\Rule;
use App\User;

class UpdateUserCustomDataRequest extends FormRequest
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

        // Get the id
        $array['id'] = "required|exists:users,id,deleted_at,NULL";
        $id = $this->request->get('id') ? $this->request->get('id') : $this->input('id');

        // Get the update field
        $update_type = $this->request->get('update_type') ? $this->request->get('update_type') : $this->input('update_type');

        // Get the group_id of the permissions user if any
        if ($update_type == 'permissions_user_id') {
            $update_value = $this->request->get('update_value') ? $this->request->get('update_value') : $this->input('update_value');
            $permissions_user = User::find($update_value);
            $group_id = $permissions_user ? $permissions_user->group_id : null;
        }

        $array['update_type'] = ['required', Rule::in([
            'group_id',
            'full_name',
            'image',
            'username',
            'email',
            'mobile_number',
            'permissions_user_id'
        ])];

        switch ($update_type) {
            case 'group_id':
                $array['update_value'] = "required|exists:groups,id,deleted_at,NULL";
                break;
            case 'full_name':
                $array['update_value'] = "nullable|max:255|string";
                break;
            case 'image':
                $array['update_value'] = "nullable|image|max:2048|mimes:jpeg,png,jpg";
                break;
            case 'username':
                $array['update_value'] = "required|string|max:191|unique:users,username,{$id},id,deleted_at,NULL";
                break;
            case 'email':
                $array['update_value'] = "required|email|string|max:191|unique:users,email,{$id},id,deleted_at,NULL";
                break;
            case 'mobile_number':
                $array['update_value'] = array('required', 'regex:/((?:\+|00)[17](?: |\-)?|(?:\+|00)[1-9]\d{0,2}(?: |\-)?|(?:\+|00)1\-\d{3}(?: |\-)?)?(0\d|\([0-9]{3}\)|[1-9]{0,3})(?:((?: |\-)[0-9]{2}){4}|((?:[0-9]{2}){4})|((?: |\-)[0-9]{3}(?: |\-)[0-9]{4})|([0-9]{7}))/');
                break;
            case 'permissions_user_id':
                $array['update_value'] = "nullable|exists:users,id,group_id,{$group_id},deleted_at,NULL";
                break;
        }

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
