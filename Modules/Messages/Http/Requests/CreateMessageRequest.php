<?php

namespace Modules\Messages\Http\Requests;

use App\Http\Requests\FormRequest;
use Illuminate\Validation\Rule;

class CreateMessageRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'receiver_id' => 'required|exists:users,id',
            // 'sender_id' => 'nullable|exists:users,id',
            'i_project_id' => 'required|exists:i_projects,id,deleted_at,NULL',
            'name' => 'required|string|max:191',
            'email' => 'nullable|email|max:191',
            'phone' => 'required|string|max:20',
            'message' => 'required|string|max:4294967295',
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
