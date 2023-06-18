<?php

namespace Modules\Inventory\Http\Requests\Developers;

use App\Http\Requests\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class UpdateIDeveloperRequest extends FormRequest
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
    {

        $id = $this->request->get('id');

        $array = array();
        // Check English language does exist
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
        $array['id'] = "required|exists:i_developers,id,deleted_at,NULL";
        $array['translations'] = 'required|array';
        $array['translations.*.language_id'] = "required|exists:languages,id";
        $array['translations.*.developer'] = "required|string|max:191";
        $array['translations.*.description'] = "required|string|max:4294967295";
        $array['translations.*.meta_title'] = "nullable|string|max:65";
        $array['translations.*.meta_description'] = "nullable|string|max:4294967295";
        $array['country_id'] = "nullable|exists:locations,id,deleted_at,NULL";
        $array['region_id'] = "nullable|exists:locations,id,deleted_at,NULL";
        $array['city_id'] = "nullable|exists:locations,id,deleted_at,NULL";
        $array['area_id'] = "nullable|exists:locations,id,deleted_at,NULL";

        // Attachments validation
        $array['attachments'] = "nullable";
        $array['attachments.*'] = "required|max:102400|mimes:tiff,jpeg,png,jpg";
        return $array;
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
