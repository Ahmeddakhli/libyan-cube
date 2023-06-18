<?php

namespace App\Http\Controllers\Web\Front;

use App\Http\Controllers\Actions\Groups\GetGroupsAction;
use App\Http\Controllers\Controller;
use App\Http\Helpers\ServiceResponse;
use Illuminate\Http\Request;
use Modules\About\About;
use Modules\About\Http\Controllers\Actions\GetAboutAction;
use Modules\Blog\Http\Controllers\Actions\Blog\GetBlogsAction;
use Modules\Compares\Http\Controllers\Actions\GetComparesAction;
use Modules\Inventory\Http\Controllers\Actions\Amenities\GetIAmenitiesAction;
use Modules\Inventory\Http\Controllers\Actions\Bathrooms\GetIBathroomsAction;
use Modules\Inventory\Http\Controllers\Actions\Bedrooms\GetIBedroomsAction;
use Modules\Inventory\Http\Controllers\Actions\Developers\GetIDevelopersAction;
use Modules\Inventory\Http\Controllers\Actions\Facilities\GetIFacilitiesAction;
use Modules\Inventory\Http\Controllers\Actions\FinishingTypes\GetIFinishingTypesAction;
use Modules\Inventory\Http\Controllers\Actions\OfferingTypes\GetIOfferingTypesAction;
use Modules\Inventory\Http\Controllers\Actions\PaymentMethods\GetIPaymentMethodsAction;
use Modules\Inventory\Http\Controllers\Actions\Purposes\GetIPurposesAction;
use Modules\Inventory\Http\Controllers\Actions\PurposeTypes\GetIPurposeTypesAction;
use Modules\Inventory\Http\Controllers\Actions\Search\SearchAction;
use Modules\Inventory\Http\Controllers\Actions\SellRequests\CreateISellRequestAction;
use Modules\Inventory\Http\Requests\SellRequests\CreateISellRequestRequest;
use Modules\Inventory\Http\Controllers\Actions\Units\GetUnitPricesListAction;
use Modules\Locations\Http\Controllers\Actions\FindLocationAction;
use Modules\Testimonials\Http\Controllers\Actions\GetTestimonialsAction;
use Modules\Inventory\Http\Controllers\Actions\DesignTypes\GetIDesignTypesAction;
use Modules\Inventory\Http\Controllers\Actions\FurnishingStatuses\GetIFurnishingStatusesAction;
use Modules\Inventory\Http\Controllers\Actions\Projects\GetFrontIProjectsAction;
use Modules\Inventory\Http\Controllers\Actions\PurposeTypes\GetPurposeTypesUnitsAction;
use Modules\Inventory\Http\Controllers\Actions\Search\LocationSearchAction;
use Modules\Inventory\Http\Controllers\Actions\Units\GetFrontIUnitsAction;

class SearchController extends Controller
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

    public function search(Request $request, SearchAction $action)
    {
        // Search
        $search = $action->execute($request->all());

        $purpose_types = (new GetPurposeTypesUnitsAction)->execute($request->all());

        // Get Search Featured data
        $features = $this->features();

        // Attach Search Results
        $features['results'] = $search;
        $features['purpose_types_values'] = $purpose_types;

        return view('front.pages.search-result', $features);
    }

    public function projects(Request $request, GetFrontIProjectsAction $action)
    {
        // Search
        $search = $action->execute($request->all());

        // Get Search Featured data
        $features = $this->features();
        $purpose_types = (new GetPurposeTypesUnitsAction)->execute($request->all());

        // Attach Search Results
        $features['projects'] = $search;
        $features['purpose_types_values'] = $purpose_types;

        return view('front.pages.projects', $features);
    }

    public function properties(Request $request, GetFrontIUnitsAction $action)
    {
        $data = $request->all();
        if ($request->project_id) {
            $data['project_id'] = $request->project_id;
        }

        $purpose_types = (new GetPurposeTypesUnitsAction)->execute($request->all());

        // properties
        $properties = $action->execute($data);

        // Get properties Featured data
        $features = $this->features();
        $action = new GetComparesAction;
        $compares_count = $action->execute();
        // Attach properties Results
        $features['properties'] = $properties;
        $features['compares_count'] = $compares_count;
        $features['purpose_types_values'] = $purpose_types;

        return view('front.pages.properties', $features);
    }

    public function resale(Request $request, SearchAction $action)
    {
        // Append type to request
        $request->merge(["type" => 'unit']);
        $request->merge(["search_type" => 'resale']);
        $purpose_types = (new GetPurposeTypesUnitsAction)->execute($request->all());

        // Search
        $search = $action->execute($request->all());

        // Get Search Featured data
        $features = $this->features();

        // Attach Search Results
        $features['results'] = $search;
        $features['purpose_types_values'] = $purpose_types;

        return view('front.pages.search-result', $features);
    }
    public function locations(Request $request, $type, $id, $slug = null, LocationSearchAction $action)
    {
        // Get location
        $location = $action->execute($request->all(), $id, $type);
        $purpose_types = (new GetPurposeTypesUnitsAction)->execute($request->all());

        if (!$location) {
            abort(404);
        } else {
            $location['location'] =  json_decode(json_encode($location['location']));

            $features = $this->features();
            $features['location'] = $location;
            $features['type'] = $type;
                    $features['purpose_types_values'] = $purpose_types;

            // Return the response
            return view('front.pages.location', $features);
        }
    }
    public function projectsLocations(Request $request, $id, $slug = null, LocationSearchAction $action)
    {
        $type = 'project';
        // Get location
        $location = $action->execute($request->all(), $id, $type);
        $purpose_types = (new GetPurposeTypesUnitsAction)->execute($request->all());

        if (!$location) {
            abort(404);
        } else {
            $location['location'] =  json_decode(json_encode($location['location']));

            $features = $this->features();
            $features['location'] = $location;
            $features['type'] = $type;
                    $features['purpose_types_values'] = $purpose_types;

            // Return the response
            return view('front.pages.location', $features);
        }
    }
}
