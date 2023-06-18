<?php

namespace Modules\Settings\Http\Requests\TopAgents;

use App\Http\Requests\FormRequest;

class UpdateTopAgentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:top_agents,id,deleted_at,NULL',
            'user_id' => 'required|exists:users,id',
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
