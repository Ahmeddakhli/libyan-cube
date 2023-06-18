<?php

namespace Modules\Inventory\Http\Requests\Projects;

use App\Http\Requests\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Exception;
use Modules\Internationalizations\Http\Controllers\Actions\Currencies\AllCurrencyCodesAction;

class UpdateIProjectRequest extends FormRequest
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

        // Check English language does exist for phases
        $phases = $this->request->get('phases') ? $this->request->get('phases') : $this->input('phases');
        if (is_array($phases) && count($phases)) {
            $exists = false;
            foreach ($phases as $phase) {
                if (isset($phase['translations'])) {
                    foreach ($phase['translations'] as $translation) {
                        if (isset($translation['language_id']) && $translation['language_id'] == 1) {
                            $exists = true;
                            break;
                        }
                    }
                }
            }

            if (!$exists) {
                $errors = [];
                $errors[] = [
                    'field' => 'phases',
                    'message' => 'Phases يجب أن تحتوي الترجمات على اللغة العربية'
                ];

                throw new HttpResponseException(response()->json([
                    'errors' => $errors
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
            }
        }

        // Get the id
        $id = $this->request->get('id') ? $this->request->get('id') : $this->input('id');

        // Get currency codes
        $action = new AllCurrencyCodesAction;
        $currency_codes = $action->execute();

        // Init validation array
        $array = array();

        $array['id'] = "required|exists:i_projects,id,deleted_at,NULL";

        $array['translations'] = 'required|array';
        $array['translations.*.language_id'] = "required|exists:languages,id";
        $array['translations.*.project'] = "required|string|max:191";
        $array['translations.*.second_title'] = "required|string|max:191";
        $array['translations.*.description'] = "nullable|string|max:4294967295";
        $array['translations.*.landing_description'] = "nullable|string|max:4294967295";
        $array['translations.*.meta_title'] = "nullable|string|max:65";
        $array['translations.*.meta_description'] = "nullable|string|max:4294967295";

        $array['developer_id'] = "nullable|exists:i_developers,id,deleted_at,NULL";
        $array['delivery_date'] = "nullable|date_format:Y-m-d H:i";
        $array['finished_status'] = ["nullable", Rule::in([0, 1])];
        $array['ready_to_move'] = ['nullable', Rule::in(['on', 'off'])];
        $array['i_area_unit_id'] = "nullable|exists:i_area_units,id,deleted_at,NULL";
        $array['area_from'] = "nullable|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|max:2147483647";
        $array['area_to'] = "nullable|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|max:2147483647";

        $array['country_id'] = "required|exists:locations,id,deleted_at,NULL";
        $array['region_id'] = "required|exists:locations,id,deleted_at,NULL";
        $array['city_id'] = "required|exists:locations,id,deleted_at,NULL";
        $array['area_id'] = "nullable|exists:locations,id,deleted_at,NULL";
        $array['address'] = "nullable|string|max:16777215";
        // $array['latitude'] = ['nullable', 'regex:/^-?([1-8]?[1-9]|[1-9]0)\.{1}\d{1,100}$/', 'max:191'];
        // $array['longitude'] = ['nullable', 'regex:/^-?([1]?[1-7][1-9]|[1]?[1-8][0]|[1-9]?[0-9])\.{1}\d{1,100}$/', 'max:191'];

        $array['down_payment_from'] = "nullable|integer|max:2147483647";
        $array['down_payment_to'] = "nullable|integer|max:2147483647";
        $array['price_from'] = "nullable|integer|max:2147483647";
        $array['price_to'] = "nullable|integer|max:2147483647";
        $array['number_of_installments_from'] = "nullable|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|max:2147483647";
        $array['number_of_installments_to'] = "nullable|integer|max:2147483647";
        $array['currency_code'] = ["nullable", "string", "max:191", Rule::in($currency_codes)];

        // Facilities validation
        $array['facilities'] = "nullable|array";
        $array['facilities.*'] = "exists:i_facilities,id,deleted_at,NULL";

        // Amenities validation
        $array['amenities'] = "nullable|array";
        $array['amenities.*'] = "exists:i_amenities,id,deleted_at,NULL";

        // Tags validation
        $array['tags'] = "nullable|array";
        $array['tags.*'] = "exists:tags,id,deleted_at,NULL";

        // Attachments validation
        $array['attachments'] = "nullable|array";
        $array['attachments.*.file'] = "nullable|max:102400|mimes:xlsx,xls,pdf,csv,tiff,jpeg,gif,png,ai,psd,mp4,m4v,f4v,3gp,3g2,oga,ogv,ogx,wmv,wma,asf,webm,flv,avi,wav,aif,flac,acc,wma,wmx,wvx,doc,docx,pptx,mkv,mpga,mpeg";
        $array['attachments.*.order'] = "nullable|numeric";

        //Floor Plans
        // $array['floorplans'] = "nullable|array";
        // $array['floorplans.*.file'] = "nullable|max:102400|mimes:tiff,jpeg,png,jpg";
        // $array['floorplans.*.order'] = "nullable|numeric";

        $array['unit_types'] = 'nullable|array';
        $array['unit_types.*.translations.*.language_id'] = "required|exists:languages,id";
        $array['unit_types.*.translations.*.unit_type'] = "required|string|max:191";
        $array['unit_types.*.translations.*.description'] = "nullable|string|max:4294967295";
        $array['unit_types.*.image'] = "nullable|mimes:png,jpeg,jpg";
        $array['unit_types.*.area_from'] = "nullable|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|max:2147483647";
        $array['unit_types.*.area_to'] = "nullable|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|max:2147483647";
        $array['unit_types.*.price_from'] = "nullable|integer|max:2147483647";
        $array['unit_types.*.price_to'] = "nullable|integer|max:2147483647";

        $array['landing_page_image'] = "nullable|mimes:png,jpeg,jpg";

        $array['payment_plans'] = 'nullable|array';
        $array['payment_plans.*.title'] = "required|string|max:191";
        $array['payment_plans.*.delivery_date'] = "required|date_format:Y-m";
        $array['payment_plans.*.down_payment'] = "required|integer|max:2147483647";
        $array['payment_plans.*.years_of_installments'] = "nullable|integer|max:2147483647";


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
