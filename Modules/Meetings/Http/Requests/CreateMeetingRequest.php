<?php

namespace Modules\Meetings\Http\Requests;

use App\Http\Requests\FormRequest;
use Illuminate\Validation\Rule;

class CreateMeetingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required|exists:users,id',
            'meeting_type' => ['required', Rule::in(['zoom_meeting'])],
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
