<?php

namespace Modules\ContactUS\Http\Requests\Contactus;

use App\Http\Requests\FormRequest;

class UpdateContactUsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:contact_us,id,deleted_at,NULL',
            'full_name' => 'required|string|max:191',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|string|max:191|email',
            'message' => 'required|string|max:4294967295',
            'link' => 'required|url|max:4294967295',
            'best_time_to_call_from' => 'nullable|date',
            'best_time_to_call_to' => 'nullable|date',
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
