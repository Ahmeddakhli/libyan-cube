<?php

namespace Modules\Socials\Http\Requests;

use App\Http\Requests\FormRequest;
use App\Language;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;

class CreateSocialRequest extends FormRequest
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
            'translations' => 'required|array',
            'translations.*.title' => 'required|string|max:191',
            'link' => 'required|string|url|max:2000',
            'icon' => 'required|string|max:191',
            'is_featured' => ['nullable', Rule::in(['on', 'off'])]
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
