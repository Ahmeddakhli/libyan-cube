<?php

namespace Modules\Ratings\Http\Requests;

use App\Http\Requests\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class CreateRatingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // Get the rateable type from the request and check that the model does exist
        $rateable_type = $this->request->get('rateable_type');
        if (!class_exists($rateable_type)) {            
            $errors = [];
            $errors[] = [
                'field' => 'rateable_type',
                'message' => 'Class '.$rateable_type.' not found'
            ];
     
             throw new HttpResponseException(response()->json(['errors' => $errors
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
        }

        $array = array();

        // Get the table name of the rateable type
        $table = with(new $rateable_type)->getTable();

        // Check that the rateable id does exist in the rateable type
        $array['rateable_id'] = "required|exists:{$table},id,deleted_at,NULL";

        $array['rate'] = 'required|numeric|min:1|max:5';

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
