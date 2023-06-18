<?php

namespace Modules\Events\Http\Requests;

use App\Http\Requests\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Exception;
use Illuminate\Validation\Rule;

class CreateEventRequest extends FormRequest
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
        $array['translations.*.title'] = "required|string|max:191";
        $array['translations.*.description'] = "required|string|max:4294967295";
        $array['translations.*.meta_title'] = "nullable|string|max:65";
        $array['translations.*.meta_description'] = "nullable|string|max:4294967295";
        $array['start_date'] = 'required|date';
        $array['end_date'] = 'nullable|date';
        $array['is_featured'] = ['nullable', Rule::in(['on', 'off'])];
       
        // Attachments validation
        $array['attachments'] = "required|array";
        $array['attachments.*'] = "required|max:102400|mimes:tiff,jpeg,png,jpg";
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
