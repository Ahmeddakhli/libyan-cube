<?php

namespace Modules\Locations\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\FormRequest;
use Illuminate\Validation\Rule;

class CreateLocationRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $translations = $this->request->get('translations') ? $this->request->get('translations') : $this->input('translations');
        if (is_array($translations)) {
            $exists = false;
            for ($i = 0; $i < count($translations); $i++) {
                if ($translations[$i] && isset($translations[$i]['language_id']) && $translations[$i]['language_id'] == 1) {
                    $exists = true;
                    break;
                }
            }

            if (!$exists) {
                $errors = [];
                $errors[] = [
                    'field' => 'translations',
                    'message' => 'Must contains english translation '
                ];

                throw new HttpResponseException(response()->json([
                    'errors' => $errors
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
            }
        }

        $array = array();
        $array['translations'] = 'required|array';
        $array['translations.*.language_id'] = "required|exists:languages,id";
        $array['translations.*.name'] = "required|string|max:191";
        $array['translations.*.second_title'] = "required|string|max:191";
        $array['translations.*.description'] = "nullable|string|max:65756";
        $array['translations.*.meta_description'] = "nullable|string|max:65756";
        $array['translations.*.meta_title'] = "nullable|string|max:65";
        $array['parent_id'] = 'nullable|exists:locations,id,deleted_at,NULL';
        $array['code'] = 'nullable|string|max:191';
        $array['in_discover_by'] = ['nullable', Rule::in(['on', 'off'])];
        $array['order'] = 'nullable|numeric';
        return $array;
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
