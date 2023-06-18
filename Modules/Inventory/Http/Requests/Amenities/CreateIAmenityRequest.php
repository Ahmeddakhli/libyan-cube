<?php

namespace Modules\Inventory\Http\Requests\Amenities;

use App\Http\Requests\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Exception;

class CreateIAmenityRequest extends FormRequest
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
        $array['order'] = 'nullable|integer|min:0';
        $array['svg'] = "nullable|string|max:4294967295";
        $array['translations'] = 'required|array';
        $array['translations.*.language_id'] = "required|exists:languages,id";
        // $array['translations.*.amenity'] = "required|string|max:191|unique:i_amenity_trans,amenity,NULL,id";
        $array['translations.*.amenity'] = "required|string|max:191";
        $array['translations.*.description'] = "nullable|string|max:4294967295";
        $array['color_class'] = "nullable|string|max:191";

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
