<?php

namespace Modules\Inventory\Http\Requests\SellRequests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateISellRequestRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required|exists:i_sell_requests,id,deleted_at,NULL',
            'compound' => 'required|string|max:191',
            'i_purpose_id' => 'required|exists:i_purposes,id,deleted_at,NULL',
            'i_purpose_type_id' => 'required|exists:i_purpose_types,id,deleted_at,NULL',
            'unit_name' => 'required|string|max:191',
            'comments' => 'nullable|string|max:4294967295',
            'name' => 'required|string|max:191',
            'email' => 'nullable|email|max:191',
            'phone' => 'required|string|max:191',
            'is_seen' => 'nullable|boolean',
            'attachments' => 'nullable|array',
            'attachments.*' => "required|max:102400|mimes:tiff,jpeg,png,jpg"
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
