<?php

namespace App\Http\Requests\Socket;

use App\Http\Requests\FormRequest;
use Illuminate\Validation\Rule;

class SetConnectionIdRequest extends FormRequest
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
            'connection_id' => "required|string|max:255|unique:users,connection_id,{$id}"
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
