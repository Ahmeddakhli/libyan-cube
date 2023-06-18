<?php

namespace Modules\Blog\Http\Requests\Blog;

use App\Http\Requests\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Exception;
use Illuminate\Validation\Rule;

class UpdateBlogRequest extends FormRequest
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
        // $translations = $this->request->get('translations') ? $this->request->get('translations') : $this->input('translations');
        // if (is_array($translations)) {
        //     $exists = false;
        //     for ($i = 0; $i < count($translations); $i++) {
        //         if ($translations[$i] && isset($translations[$i]['language_id']) && $translations[$i]['language_id'] == 1) {
        //             $exists = true;
        //             break;
        //         }
        //     }

        //     if (!$exists) {
        //         $errors = [];
        //         $errors[] = [
        //             'field' => 'translations',
        //             'message' => 'Must contains english translation '
        //         ];

        //         throw new HttpResponseException(response()->json([
        //             'errors' => $errors
        //         ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
        //     }
        // }

        $array = array();
        $array['id'] = "required|exists:blogs,id,deleted_at,NULL";
        $array['translations'] = 'required|array';
        $array['translations.*.language_id'] = "required|exists:languages,id";
        $array['translations.*.title'] = "required|string|max:191";
        $array['translations.*.description'] = "required|string|max:4294967295";
        $array['translations.*.meta_title'] = "nullable|string|max:65";
        $array['translations.*.meta_description'] = "nullable|string|max:4294967295";
        $array['translations.*.excerpt'] = "nullable|string|max:4294967295";
        $array['video'] = "nullable|string|max:4294967295";

        $array['is_featured'] = ['nullable', Rule::in(['on', 'off'])];
        $array['is_published'] = ['nullable', Rule::in(['on', 'off'])];
        $array['category_ids'] = 'required|array';
        $array['category_ids.*'] = 'required|exists:blog_categories,id,deleted_at,NULL';
        
        // Attachments validation
        $array['attachments'] = "nullable";
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
