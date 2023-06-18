<?php

namespace Modules\Settings\Http\Requests\Settings;

use App\Http\Requests\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSettingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:settings,id,deleted_at,NULL',
            'tags_manager' => 'nullable|string|max:65457',
            'body_tag_manager'=> 'nullable|string|max:65457',
            'pixel_code' => 'nullable|string|max:65457',
            'enable_ar' => ['nullable', Rule::in(['on', 'off'])],
            'aside_title_en' => 'nullable|string|max:191',
            'aside_title_ar' => 'nullable|string|max:191',
            'auto_reply_message_en'=> 'nullable|string|max:65457',
            'auto_reply_message_ar'=>'nullable|string|max:65457',
            'thank_you_message_en' => 'nullable|string|max:65457',
            'thank_you_message_ar' => 'nullable|string|max:65457',
            'about_en' => 'nullable|string|max:65457',
            'about_ar' => 'nullable|string|max:65457',
            'slogan_en' => 'nullable|string|max:191',
            'slogan_ar' => 'nullable|string|max:191'
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
