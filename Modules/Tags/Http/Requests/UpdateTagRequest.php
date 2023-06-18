<?php

namespace Modules\Tags\Http\Requests;

use App\Http\Requests\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTagRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
  public function rules()
    {        $id = $this->request->get('id');

        return [
            'id' => "required|exists:tags,id,deleted_at,NULL",
            'tag' => "required|string|max:191|unique:tags,tag,{$id},id,deleted_at,NULL",
            'color' => 'required|string|max:191'
        ];
    }

     /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
