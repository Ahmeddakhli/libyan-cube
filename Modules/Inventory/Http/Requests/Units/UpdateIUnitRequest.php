<?php

namespace Modules\Inventory\Http\Requests\Units;

use App\Http\Requests\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Exception;
use Modules\Internationalizations\Http\Controllers\Actions\Currencies\AllCurrencyCodesAction;

class UpdateIUnitRequest extends FormRequest
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


        // Get the id
        $id = $this->request->get('id') ? $this->request->get('id') : $this->input('id');
        // Get the currency codes
        $action = new AllCurrencyCodesAction;
        $currency_codes = $action->execute();

        $array = array();
        $array['id'] = "required|exists:i_units,id,deleted_at,NULL";
        $array['i_project_id'] = "nullable|exists:i_projects,id,deleted_at,NULL";
        // $array['unit_number'] = "required|string|max:191|unique:i_units,unit_number,{$id},id,deleted_at,NULL";
        $array['building_number'] = "nullable|string|max:191";
        $array['seller_id'] = "nullable|exists:users,id,deleted_at,NULL";
        $array['i_position_id'] = "nullable|exists:i_positions,id,deleted_at,NULL";
        $array['i_view_id'] = "nullable|exists:i_views,id,deleted_at,NULL";
        $array['area'] = "nullable|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|max:2147483647";
        $array['roof_area'] = "nullable|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|max:2147483647";
        $array['terrace_area'] = "nullable|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|max:2147483647";
        $array['garden_area'] = "nullable|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|max:2147483647";
        $array['plot_area'] = "nullable|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|max:2147483647";
        $array['build_up_area'] = "nullable|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|max:2147483647";
        $array['i_bedroom_id'] = "nullable|exists:i_bedrooms,id,deleted_at,NULL";
        $array['i_bathroom_id'] = "nullable|exists:i_bathrooms,id,deleted_at,NULL";
        $array['i_floor_number_id'] = "nullable|exists:i_floor_numbers,id,deleted_at,NULL";
        $array['i_purpose_id'] = "nullable|exists:i_purposes,id,deleted_at,NULL";
        $array['i_purpose_type_id'] = "nullable|exists:i_purpose_types,id,deleted_at,NULL";
        $array['country_id'] = "required|exists:locations,id,deleted_at,NULL";
        $array['region_id'] = "required|exists:locations,id,deleted_at,NULL";
        $array['city_id'] = "required|exists:locations,id,deleted_at,NULL";
        $array['area_id'] = "nullable|exists:locations,id,deleted_at,NULL";
        // $array['latitude'] = ['nullable', 'regex:/^-?([1-8]?[1-9]|[1-9]0)\.{1}\d{1,100}$/', 'max:191'];
        // $array['longitude'] = ['nullable', 'regex:/^-?([1]?[1-7][1-9]|[1]?[1-8][0]|[1-9]?[0-9])\.{1}\d{1,100}$/', 'max:191'];
        $array['address'] = "nullable|string|max:16777215";
        $array['title'] = "nullable|string|max:16777215";
        $array['i_offering_type_id'] = "required|exists:i_offering_types,id,deleted_at,NULL";
        $array['price'] = "nullable|integer|max:2147483647";
        $array['description'] = "nullable|string|max:4294967295";
        $array['i_payment_method_id'] = "nullable|exists:i_payment_methods,id,deleted_at,NULL";
        $array['buyer_id'] = "nullable|exists:users,id,deleted_at,NULL";
        $array['down_payment'] = "nullable|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|max:2147483647";
        $array['number_of_installments'] = "nullable|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|max:2147483647";
        $array['installments'] = "nullable|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|max:2147483647";
        $array['currency_code'] = ["nullable", "string", "max:191", Rule::in($currency_codes)];
        $array['i_area_unit_id'] = "nullable|exists:i_area_units,id,deleted_at,NULL";
        $array['i_garden_area_unit_id'] = "nullable|exists:i_area_units,id,deleted_at,NULL";
        $array['i_furnishing_status_id'] = "nullable|exists:i_furnishing_statuses,id,deleted_at,NULL";
        $array['i_finishing_type_id'] = "nullable|exists:i_finishing_types,id,deleted_at,NULL";
        $array['i_design_type_id'] = "nullable|exists:i_design_types,id,deleted_at,NULL";
        $array['is_featured'] = ['nullable', Rule::in(['on', 'off'])];
        $array['ready_to_move'] = ['nullable', Rule::in(['on', 'off'])];
        $array['rent_price'] = "nullable|integer|max:2147483647";
        $array['resale_price'] = "nullable|integer|max:2147483647";
        // translations
        $array['translations'] = 'nullable|array';
        $array['translations.*.language_id'] = "nullable|exists:languages,id";
        $array['translations.*.address'] = "nullable|string|max:16777215";
        $array['translations.*.description'] = "nullable|string|max:4294967295";
        $array['translations.*.meta_description'] = "nullable|string|max:4294967295";
        $array['translations.*.meta_title'] = "nullable|string|max:65";

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
        $array['floorplans'] = "nullable|array";
        $array['floorplans.*.file'] = "nullable|max:102400|mimes:tiff,jpeg,png,jpg";
        $array['floorplans.*.order'] = "nullable|numeric";

        // Master Plans
        $array['masterplans'] = "nullable|array";
        $array['masterplans.*.file'] = "nullable|max:102400|mimes:tiff,jpeg,png,jpg";
        $array['masterplans.*.order'] = "nullable|numeric";

        // Images 360
        $array['images'] = 'nullable|array';
        // Images 360
        $array['images'] = 'nullable|array';
        $images = $this->request->get('images') ? $this->request->get('images') : $this->input('images');
        if (is_array($images)) {
            for ($i = 0; $i < count($images); $i++) {
                if ($images[$i] && isset($images[$i]['link']) && $images[$i]['link']) {
                    $array['images.*.translations.*.language_id'] = "required|exists:languages,id";
                    $array['images.*.translations.*.title'] = "required|string|max:191";
                    $array['images.*.link'] = "required|url|max:4294967295";
                } else {
                    $array['images.*.translations.*.language_id'] = "nullable|exists:languages,id";
                    $array['images.*.translations.*.title'] = "nullable|string|max:191";
                    $array['images.*.link'] = "nullable|url|max:4294967295";
                }
            }
        }

        // Payment plans
        $array['payment_plans'] = 'nullable|array';
        $array['payment_plans.*.title'] = "required|string|max:191";
        $array['payment_plans.*.delivery_date'] = "required|date_format:Y-m";
        $array['payment_plans.*.down_payment'] = "required|integer|max:2147483647";
        $array['payment_plans.*.installment_amount'] = "nullable|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|max:2147483647";

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
