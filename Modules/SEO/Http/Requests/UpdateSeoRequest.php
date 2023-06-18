<?php

namespace Modules\SEO\Http\Requests;

use App\Http\Requests\FormRequest;use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Exception;
use Illuminate\Validation\Rule;

class UpdateSeoRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // Get the id
        $id = $this->request->get('id') ? $this->request->get('id') : $this->input('id');

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
        $array['id'] = "required|exists:seo,id,deleted_at,NULL";
        $array['translations'] = 'required|array';
        $array['translations.*.language_id'] = "required|exists:languages,id";
        $array['translations.*.title'] = "required|string|max:65";
        $array['translations.*.description'] = "required|string|max:4294967295";
        $array['translations.*.popup_contact_us_title'] = "nullable|string|max:191";
        $array['translations.*.key_words'] = "nullable|string|max:191";
        $array['translations.*.short_description'] = "nullable|string|max:4294967295";
        $array['show_short_description'] = ['nullable', Rule::in(['on', 'off'])];
        $array['page'] = ['required', Rule::in(['home','projects', 'properties','single_project','single_property','about','contact','careers','blogs','single_blog','unit_types','developers','single_developer','thank_you','terms','privacy','sell_unit'])];

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
