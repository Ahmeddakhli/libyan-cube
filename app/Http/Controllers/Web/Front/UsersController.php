<?php

namespace App\Http\Controllers\Web\Front;

use App\Http\Controllers\Actions\Groups\GetGroupsAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Modules\Inventory\Http\Controllers\Actions\Amenities\GetIAmenitiesAction;
use Modules\Inventory\Http\Controllers\Actions\AreaUnits\GetIAreaUnitsAction;
use Modules\Inventory\Http\Controllers\Actions\Bathrooms\GetIBathroomsAction;
use Modules\Inventory\Http\Controllers\Actions\Bedrooms\GetIBedroomsAction;
use Modules\Inventory\Http\Controllers\Actions\DesignTypes\GetIDesignTypesAction;
use Modules\Inventory\Http\Controllers\Actions\Facilities\GetIFacilitiesAction;
use Modules\Inventory\Http\Controllers\Actions\Favorites\GetIFavoritesAction;
use Modules\Inventory\Http\Controllers\Actions\FinishingTypes\GetIFinishingTypesAction;
use Modules\Inventory\Http\Controllers\Actions\FloorNumbers\GetIFloorNumbersAction;
use Modules\Inventory\Http\Controllers\Actions\FurnishingStatuses\GetIFurnishingStatusesAction;
use Modules\Inventory\Http\Controllers\Actions\OfferingTypes\GetIOfferingTypesAction;
use Modules\Inventory\Http\Controllers\Actions\PaymentMethods\GetIPaymentMethodsAction;
use Modules\Inventory\Http\Controllers\Actions\Positions\GetIPositionsAction;
use Modules\Inventory\Http\Controllers\Actions\Purposes\GetIPurposesAction;
use Modules\Inventory\Http\Controllers\Actions\PurposeTypes\GetIPurposeTypesAction;
use Modules\Inventory\Http\Controllers\Actions\Views\GetIViewsAction;
use Modules\Locations\Http\Controllers\Actions\GetCountriesAction;
use Modules\Tags\Http\Controllers\Actions\GetTagsAction;
use App\Http\Controllers\Actions\Users\UpdateUserAction;
use App\Http\Requests\Users\UpdateFrontUserRequest;
use Lang;
use App\Http\Helpers\ServiceResponse;

class UsersController extends Controller
{
    public function features()
    {
        $action = new GetIBedroomsAction;
        $bedrooms = json_decode(json_encode($action->execute()));
        $action = new GetIFacilitiesAction;
        $facilities = json_decode(json_encode($action->execute()));
        $action = new GetIAmenitiesAction;
        $amenities = json_decode(json_encode($action->execute()));
        $action = new GetIPurposeTypesAction;
        $purpose_types = json_decode(json_encode($action->execute()));
        $action = new GetIFinishingTypesAction;
        $finishing_types = json_decode(json_encode($action->execute()));
        $action = new GetIOfferingTypesAction;
        $offering_types = json_decode(json_encode($action->execute()));
        $action = new GetIPaymentMethodsAction;
        $payment_methods = json_decode(json_encode($action->execute()));
        $action = new GetIPositionsAction;
        $positions = json_decode(json_encode($action->execute()));
        $action = new GetIViewsAction;
        $views = json_decode(json_encode($action->execute()));
        $action = new GetIBathroomsAction;
        $bathrooms = json_decode(json_encode($action->execute()));
        $action = new GetIFloorNumbersAction;
        $floor_numbers = json_decode(json_encode($action->execute()));
        $action = new GetIPurposesAction;
        $purposes = json_decode(json_encode($action->execute()));
        $action = new GetCountriesAction;
        $countries = json_decode(json_encode($action->execute()));
        $action = new GetIAreaUnitsAction;
        $area_units = json_decode(json_encode($action->execute()));
        $action = new GetIFurnishingStatusesAction;
        $furnishing_statuses = json_decode(json_encode($action->execute()));
        $action = new GetIDesignTypesAction;
        $design_types = json_decode(json_encode($action->execute()));
        $action =  new GetTagsAction;
        $tags = json_decode(json_encode($action->execute()));

        return [
            'positions' => $positions,
            'views' => $views,
            'bedrooms' => $bedrooms,
            'bathrooms' => $bathrooms,
            'floor_numbers' => $floor_numbers,
            'purposes' => $purposes,
            'purpose_types' => $purpose_types,
            'countries' => $countries,
            'offering_types' => $offering_types,
            'payment_methods' => $payment_methods,
            'area_units' => $area_units,
            'furnishing_statuses' => $furnishing_statuses,
            'finishing_types' => $finishing_types,
            'design_types' => $design_types,
            'facilities' => $facilities,
            'amenities' => $amenities,
            'tags' => $tags,
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = new UserResource(auth()->user());

        $action =  new GetGroupsAction;
        $groups = json_decode(json_encode($action->execute()));

        return view('front.pages.profile', compact('user'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function favorites()
    {
        $action =  new GetIFavoritesAction;
        $favorites = $action->execute();

        return view('front.pages.favorites',compact('favorites'));
    }

    public function addunit()
    {
        $features = $this->features();

        return view('front.pages.addunit', $features);
    }

    /**
     * Update user
     *
     * @param  [string] full_name
     * @param  [file] image
     * @param  [string] username
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @param  [string] mobile_number
     * @return [json] ServiceResponse object
     */
    public function update(UpdateFrontUserRequest $request, UpdateUserAction $action)
    {
    	// Check if auth user matches the request user
    	if (auth()->user()->id != $request->input('id')) {
	        // Return the response
	        $resp = new ServiceResponse;
	        $resp->message = Lang::get('main.hacking_incident_received_our_team_will_investigate_this_case');
	        $resp->status = false;
	        $resp->data = null;

	        return response()->json($resp, 401);
    	}

        // Append group_id and permissions_user_id to the request
        $request->merge(["group_id" => auth()->user()->group_id]);
        $request->merge(["permissions_user_id" => auth()->user()->group_id]);

        // Update the user
        $user = $action->execute($request->input('id'), $request->except(['id', 'permissions_user_id']), $request->input('permissions_user_id'));

        // Transform the user
        $user = json_decode(json_encode(new UserResource($user)));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = Lang::get('main.profile_updated_successfully');
        $resp->status = true;
        $resp->data = $user;

        return response()->json($resp, 200);
    }
}
