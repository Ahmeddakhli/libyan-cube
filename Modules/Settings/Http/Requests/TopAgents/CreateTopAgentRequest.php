<?php

namespace Modules\Settings\Http\Requests\TopAgents;

use App\Http\Requests\FormRequest;

class CreateTopAgentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => "required|exists:users,id,deleted_at,NULL",
            'socials' => 'required|array',
            'socials.*.link' => 'required|string|url|max:2000',
            'socials.*.icon' => 'required|string|max:191',
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
