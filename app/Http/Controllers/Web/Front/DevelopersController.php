<?php

namespace App\Http\Controllers\Web\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Inventory\Http\Controllers\Actions\Amenities\GetIAmenitiesAction;
use Modules\Inventory\Http\Controllers\Actions\Bathrooms\GetIBathroomsAction;
use Modules\Inventory\Http\Controllers\Actions\Bedrooms\GetIBedroomsAction;
use Modules\Inventory\Http\Controllers\Actions\Developers\GetIDeveloperByIdAction;
use Modules\Inventory\Http\Controllers\Actions\Developers\GetIDevelopersAction;
use Modules\Inventory\Http\Controllers\Actions\Developers\GetIDevelopersFrontAction;
use Modules\Inventory\Http\Controllers\Actions\Facilities\GetIFacilitiesAction;
use Modules\Inventory\Http\Controllers\Actions\FinishingTypes\GetIFinishingTypesAction;
use Modules\Inventory\Http\Controllers\Actions\FurnishingStatuses\GetIFurnishingStatusesAction;
use Modules\Inventory\Http\Controllers\Actions\OfferingTypes\GetIOfferingTypesAction;
use Modules\Inventory\Http\Controllers\Actions\PaymentMethods\GetIPaymentMethodsAction;
use Modules\Inventory\Http\Controllers\Actions\Purposes\GetIPurposesAction;
use Modules\Inventory\Http\Controllers\Actions\PurposeTypes\GetIPurposeTypesAction;
use Modules\Inventory\Http\Controllers\Actions\PurposeTypes\GetPurposeTypesUnitsAction;
use Modules\Inventory\Http\Controllers\Actions\Units\GetUnitPricesListAction;
use Modules\Inventory\IDeveloper;

class DevelopersController extends Controller
{
    public function features()
    {
        $action = new GetIBedroomsAction;
        $bedrooms = json_decode(json_encode($action->execute()));
        $action = new GetIBathroomsAction;
        $bathrooms = json_decode(json_encode($action->execute()));
        $action = new GetIFacilitiesAction;
        $facilities = json_decode(json_encode($action->execute()));
        $action = new GetIAmenitiesAction;
        $amenities = json_decode(json_encode($action->execute()));
        $action = new GetIPurposeTypesAction;
        $purpose_types = json_decode(json_encode($action->execute()));
        $action = new GetIPurposesAction;
        $purposes = json_decode(json_encode($action->execute()));
        $action = new GetIDevelopersAction;
        $developers = json_decode(json_encode($action->execute()));
        $action = new GetIFinishingTypesAction;
        $finishing_types = json_decode(json_encode($action->execute()));
        $action = new GetIFurnishingStatusesAction;
        $furnishing_statuses = json_decode(json_encode($action->execute()));
        $action = new GetIOfferingTypesAction;
        $offering_types = json_decode(json_encode($action->execute()));
        $action = new GetIPaymentMethodsAction;
        $payment_methods = json_decode(json_encode($action->execute()));
        $action = new GetUnitPricesListAction;
        $unit_prices_list = $action->execute();


        return [
            'bedrooms' => $bedrooms,
            'facilities' => $facilities,
            'amenities' => $amenities,
            'purpose_types' => $purpose_types,
            'developers' => $developers,
            'finishing_types' => $finishing_types,
            'offering_types' => $offering_types,
            'payment_methods' => $payment_methods,
            'purposes' => $purposes,
            'bathrooms' => $bathrooms,
            'unit_prices_list' => $unit_prices_list,
            'furnishing_statuses' => $furnishing_statuses
        ];
    }

    public function index(Request $request, GetIDevelopersFrontAction $action)
    {
        // Get developers
        $developers = $action->execute($request->all());

        $features = $this->features();
        $features['developers'] = $developers;

        return view('front.pages.developers.developers', $features);
    }

    public function show(Request $request, $id, GetIDeveloperByIdAction $action)
    {
        // Get developer
        $developer = $action->execute($request, $id);

        if (!$developer) {
            abort(404);
        } else {
            $developer['developer'] =  json_decode(json_encode($developer['developer']));
            $request->merge(['developer_id' => $id]);
            $purpose_types = (new GetPurposeTypesUnitsAction)->execute($request->all());


            $features = $this->features();
            $features['developer'] = $developer;
            $features['purpose_types_values'] = $purpose_types;

            // Return the response
            return view('front.pages.developers.developer', $features);
        }
    }

    public function showKeyword(Request $request)
    {
        $developer = IDeveloper::whereHas('translations', function ($translations) use ($request) {
            $translations->where('developer', $request->keyword);
        })->first();
        // Get developer
        if ($developer) {
            return redirect()->route('front.developers.show', ['id' => $developer->id, 'slug' => str_slug($developer->value ? $developer->value : $developer->default_value)]);
        } else {
            return abort(404);
        }
    }
}
