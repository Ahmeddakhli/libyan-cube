<?php

namespace Modules\Settings\Http\Requests\MainSliders;

use App\Http\Requests\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class UpdateMainSliderRequest extends FormRequest
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
            'id' => 'required|exists:main_sliders,id,deleted_at,NULL',
            'translations' => 'required|array',
            'translations.*.title' => 'required|string|max:191',
            'translations.*.description' => 'nullable|string|max:65557',
            // 'link' => 'required|url|string|max:191',
            'image' => 'required|mimes:jpg,png,jpeg|max:102400'
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
