<?php

namespace Modules\Careers\Http\Requests;

use App\Http\Requests\FormRequest;
class ApplyCareerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'career_id' => 'required|exists:careers,id,deleted_at,NULL',
            'full_name' => 'required|string||max:191',
            'email' => 'nullable|email|max:191',
            'phone' => 'required|numeric',
            'message' => 'nullable|string',
            // 'subject' =>'required|string|max:191',
            'attachment' => 'required|max:102400|mimetypes:pdf,application/pdf,doc,application/msword,docx'
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
