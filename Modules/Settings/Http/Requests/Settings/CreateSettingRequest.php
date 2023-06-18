<?php

namespace Modules\Settings\Http\Requests\Settings;

use App\Http\Requests\FormRequest;
use Illuminate\Validation\Rule;

class CreateSettingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tags_manager' => 'nullable|string|max:65457',
            'pixel_code' => 'nullable|string|max:65457',
            'enable_ar'=>['nullable',Rule::in(['on','off'])],
            'body_tag_manager'=> 'nullable|string|max:65457',
            'aside_title_en'=>'nullable|string|max:191',
            'aside_title_ar' => 'nullable|string|max:191',
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
