<?php

namespace Modules\ContactUS\Http\Requests\Contactus;

use App\Http\Requests\FormRequest;
use Illuminate\Validation\Rule;

class CreateContactUsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'full_name' => 'required|string|max:191',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|string|max:191|email',
            'message' => 'nullable|string|max:4294967295',
            'link' => 'required|url|max:4294967295',
            'best_time_to_call_from' => 'nullable|date_format:Y-m-d',
            'best_time_to_call_to' => 'nullable|date',
            'type' => ['required', Rule::in(['contact', 'request_info','request_a_call','set_a_visit'])]
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
