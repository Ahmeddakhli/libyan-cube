<?php

namespace Modules\Testimonials\Http\Requests;

use App\Http\Requests\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class UpdateTestimonialRequest extends FormRequest
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
            'id' => 'required|exists:testimonials,id,deleted_at,NULL',
            'translations' => 'required|array',
            'translations.*.title' => 'required|string|max:191',
            'translations.*.description' => 'required|string|max:200',
            'attachments' => 'nullable|array',
            'attachments.*' => 'required|max:102400|mimes:png,jpg,jpeg',
            'name' => 'required|string|max:192',
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
