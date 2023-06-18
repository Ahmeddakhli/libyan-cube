<?php

namespace Modules\CMS\Http\Requests;

use App\Http\Requests\FormRequest;
use App\Language;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class CreateCmsManagementRequest extends FormRequest
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

            foreach ($translations as $value) {

                if (isset($value['language_id']) && $value['language_id'] == 1) {
                    $exists = true;
                    break;
                }
            }

            if (!$exists) {
                $errors = [];
                $errors[] = [
                    'field' => 'translations',
                    'message' => 'Translations must contain English language'
                ];

                throw new HttpResponseException(response()->json([
                    'errors' => $errors
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
            }
        }

        return [
            'translations' => 'required|array',
            'translations.*.title' => 'nullable|string|max:191',
            'translations.*.description' => 'required|string|max:65535',
            'type' => ['required', Rule::in(['faqs', 'terms_conditions', 'rules_regulations', 'privacy_policy', 'return_policy', 'delivery_details', 'cookies', 'payment_security'])],
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
