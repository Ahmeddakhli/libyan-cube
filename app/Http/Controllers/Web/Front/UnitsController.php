<?php

namespace App\Http\Controllers\Web\Front;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ServiceResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Compares\Compare;
use Modules\Compares\Http\Controllers\Actions\GetComparesAction;
use Modules\Inventory\Http\Controllers\Actions\Units\CreateIUnitAction;
use Modules\Inventory\Http\Controllers\Actions\Units\GetUnitTypeUnitsAction;
use Modules\Inventory\Http\Controllers\Actions\Units\GetIUnitByIdAction;
use Modules\Inventory\Http\Controllers\Actions\Units\GetMyUnitsAction;
use Modules\Inventory\Http\Requests\Units\CreateFrontIUnitRequest;
use Modules\Inventory\Http\Resources\IUnitResource;
use Modules\Inventory\IUnit;
use Modules\Messages\Http\Controllers\Actions\CreateMessageAction;
use Modules\Messages\Http\Requests\CreateMessageRequest;
use Lang;
use Modules\Inventory\Http\Controllers\Actions\Amenities\GetIAmenitiesAction;
use Modules\Inventory\Http\Controllers\Actions\Bathrooms\GetIBathroomsAction;
use Modules\Inventory\Http\Controllers\Actions\Bedrooms\GetIBedroomsAction;
use Modules\Inventory\Http\Controllers\Actions\Developers\GetIDevelopersAction;
use Modules\Inventory\Http\Controllers\Actions\Facilities\GetIFacilitiesAction;
use Modules\Inventory\Http\Controllers\Actions\FinishingTypes\GetIFinishingTypesAction;
use Modules\Inventory\Http\Controllers\Actions\FurnishingStatuses\GetIFurnishingStatusesAction;
use Modules\Inventory\Http\Controllers\Actions\OfferingTypes\GetIOfferingTypesAction;
use Modules\Inventory\Http\Controllers\Actions\PaymentMethods\GetIPaymentMethodsAction;
use Modules\Inventory\Http\Controllers\Actions\Purposes\GetIPurposesAction;
use Modules\Inventory\Http\Controllers\Actions\PurposeTypes\GetIPurposeTypesAction;
use Modules\Inventory\Http\Controllers\Actions\Units\GetUnitPricesListAction;
use Modules\Inventory\Http\Requests\DesignTypes\GetDesignTypeUnitsFrontRequest;
use Modules\Inventory\Http\Resources\IUnitTypeResource;
use Modules\Inventory\IProject;
use Modules\Inventory\UnitType;

class UnitsController extends Controller
{
    /**
     * Store I_unit
     *
     * @return [json] ServiceResponse object
     */
    public function store(CreateFrontIUnitRequest $request, CreateIUnitAction $action)
    {
        // Append seller_id to the request
        $request->merge(["seller_id" => auth()->user()->id]);

        // Create the I_unit
        $i_unit = $action->execute($request->except(['facilities', 'amenities']), $request->input('facilities'), $request->input('amenities'), $request->attachments, $request->floorplans, $request->masterplans, $request->images, $request->input('tags'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = Lang::get('main.your_unit_added_successfully_your_unit_is_waiting_for_admin_verification');
        $resp->status = true;
        $resp->data = $i_unit;
        return response()->json($resp, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id, GetIUnitByIdAction $action)
    {
        // Get unit
        $unit = json_decode(json_encode($action->execute($id)));

        // Check compares
        $compare_check = Compare::where('unit_id', $unit->id);
        if (Auth::check()) {
            $compare_check =  $compare_check->where('user_id', Auth::user()->id);
        } else {
            $session = $request->session()->get('_token');
            $compare_check =  $compare_check->where('session', $session);
        }
        $compare_check = $compare_check->first();

        // Get related units
        if ($unit->city) {
            $relates = json_decode(json_encode(IUnitResource::collection(IUnit::active()->where('id', '!=', $unit->id)->where('city_id', $unit->city->id)->where('i_offering_type_id', '=', $unit->offering_type_id)->orderBy('created_at', 'DESC')->take(4)->get())));
        } else {
            $relates = [];
        }

        $action = new GetComparesAction;
        $compares = json_decode(json_encode($action->execute()));

        $features = [
            'compares' => $compares
        ];

        // Set unit and relates to featured page data
        $features['single_unit'] = $unit;
        $features['relates'] = $relates;
        $features['compare_check'] = $compare_check;

        return view('front.pages.single-unit', $features);
    }

    /**
     * Show  resource.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function myunits()
    {
        // Get user units
        $action = new GetMyUnitsAction;
        $myunits = $action->execute();

        $features = [];
        $features['myunits'] = $myunits;

        return view('front.pages.myunits', $features);
    }

    function designType(Request $request)
    {
        // data, currency_code and area_unit
        $data = $request->all();

        // Append design type id && project_id and purpose_type_id
        $data['id'] = $request->id;

        $units =  new GetUnitTypeUnitsAction();
        $units = $units->execute($data);

        $unit_type = json_decode(json_encode(new IUnitTypeResource(UnitType::where('id', $request->id)->with('project', 'units')->first())));

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

        $features = [
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

        // Append units, title and data
        $features['units'] = $units;
        $features['unit_type'] = $unit_type;

        return view('front.pages.unit_type', $features);
    }

    public function messageUnitOwner(CreateMessageRequest $request, CreateMessageAction $action)
    {
        // Append receiver_id and sender_id to the request
        $request->merge(["receiver_id" => IProject::find($request->input('i_project_id'))->created_by]);
        $request->merge(["sender_id" => auth()->check() ? auth()->user()->id : null]);
        $request->merge(["developer_id" => IProject::find($request->input('i_project_id'))->developer ? IProject::find($request->input('i_project_id'))->developer->id : null]);


        $message = $action->execute($request->all());

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = Lang::get('main.message_sent_successfully');
        $resp->status = true;
        $resp->data = $message;

        return response()->json($resp, 200);
    }
}
