<?php

namespace Modules\WelcomeMessages\Http\Requests;

use App\Http\Requests\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class UpdateWelcomeMessageRequest extends FormRequest
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
                    'message' => 'Must contains english translation '
                ];

                throw new HttpResponseException(response()->json([
                    'errors' => $errors
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
            }
        }
        return [
            'id' => 'required|exists:welcome_messages,id,deleted_at,NULL',
            'translations' => 'required|array',
            'translations.*.title' => 'nullable|string|max:191',
            'link' => 'nullable|string|url|max:2000',
            'time' => 'required|numeric',
            'is_featured' => ['nullable', Rule::in(['on', 'off'])],
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
