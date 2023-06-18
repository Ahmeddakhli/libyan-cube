<?php

namespace Modules\Inventory\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Inventory\Http\Controllers\Actions\Units\SearchIUnitsQueryAction;
use Modules\Inventory\Http\Controllers\Actions\Units\CreateIUnitAction;
use Modules\Inventory\Http\Controllers\Actions\Units\DeleteIUnitAction;
use Modules\Inventory\Http\Controllers\Actions\Units\UpdateIUnitAction;
use Modules\Inventory\Http\Controllers\Actions\Units\GetIUnitByIdAction;
use Modules\Inventory\Http\Controllers\Actions\Units\DeleteIUnitAttachmentAction;
use Modules\Inventory\Http\Controllers\Actions\Units\IUnitsTagsInputAction;
use Modules\Inventory\Http\Requests\Units\CreateIUnitRequest;
use Modules\Inventory\Http\Requests\Units\DeleteIUnitRequest;
use Modules\Inventory\Http\Requests\Units\UpdateIUnitRequest;
use Modules\Inventory\Http\Requests\Units\DeleteIUnitAttachmentRequest;
use Modules\Inventory\Http\Requests\Units\IUnitsTagsInputRequest;
use Modules\Inventory\Http\Resources\IUnitResource;
use Modules\Inventory\IUnit;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth, Lang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Yajra\Datatables\Datatables;
use App\Language;
use Modules\Inventory\Http\Controllers\Actions\Positions\GetIPositionsAction;
use Modules\Inventory\Http\Controllers\Actions\Views\GetIViewsAction;
use Modules\Inventory\Http\Controllers\Actions\Bedrooms\GetIBedroomsAction;
use Modules\Inventory\Http\Controllers\Actions\Bathrooms\GetIBathroomsAction;
use Modules\Inventory\Http\Controllers\Actions\FloorNumbers\GetIFloorNumbersAction;
use Modules\Inventory\Http\Controllers\Actions\Purposes\GetIPurposesAction;
use Modules\Inventory\Http\Controllers\Actions\PurposeTypes\GetIPurposeTypesAction;
use Modules\Locations\Http\Controllers\Actions\GetCountriesAction;
use Modules\Inventory\Http\Controllers\Actions\OfferingTypes\GetIOfferingTypesAction;
use Modules\Inventory\Http\Controllers\Actions\PaymentMethods\GetIPaymentMethodsAction;
use Modules\Internationalizations\Http\Controllers\Actions\Currencies\AllCurrencyCodesAction;
use Modules\Inventory\Http\Controllers\Actions\AreaUnits\GetIAreaUnitsAction;
use Modules\Inventory\Http\Controllers\Actions\FurnishingStatuses\GetIFurnishingStatusesAction;
use Modules\Inventory\Http\Controllers\Actions\FinishingTypes\GetIFinishingTypesAction;
use Modules\Inventory\Http\Controllers\Actions\Facilities\GetIFacilitiesAction;
use Modules\Inventory\Http\Controllers\Actions\Amenities\GetIAmenitiesAction;
use App\Http\Helpers\Utilities;
use Modules\Inventory\Http\Controllers\Actions\DesignTypes\GetIDesignTypesAction;
use Modules\Inventory\Http\Controllers\Actions\Units\ImportIUnitAction;
use Modules\Inventory\Http\Requests\Units\ImportIUnitRequest;
use Modules\Locations\Http\Controllers\Actions\GetCityAreasAction;
use Modules\Locations\Http\Controllers\Actions\GetCountryRegionsAction;
use Modules\Locations\Http\Controllers\Actions\GetRegionCitiesAction;
use Modules\Tags\Http\Controllers\Actions\GetTagsAction;

use function GuzzleHttp\json_decode;

class IUnitsController extends Controller
{
    /**
     * Store i_unit
     *
     * @param  [integer] i_project_id
     * @param  [string] unit_number
     * @param  [string] building_number
     * @param  [integer] seller_id
     * @param  [integer] i_position_id
     * @param  [integer] i_view_id
     * @param  [integer] area
     * @param  [integer] garden_area
     * @param  [integer] plot_area
     * @param  [integer] build_up_area
     * @param  [integer] i_bedroom_area
     * @param  [integer] i_bathroom_area
     * @param  [integer] i_floor_number_id
     * @param  [integer] i_purpose_id
     * @param  [integer] i_purpose_type_id
     * @param  [integer] country_id
     * @param  [integer] region_id
     * @param  [integer] city_id
     * @param  [integer] area_id
     * @param  [string] latitude
     * @param  [string] longitude
     * @param  [integer] i_offering_type_id
     * @param  [integer] price
     * @param  [integer] i_payment_method_id
     * @param  [integer] buyer_id
     * @param  [integer] down_payment
     * @param  [integer] number_of_installments
     * @param  [string] currency_code
     * @param  [integer] i_area_unit_id
     * @param  [integer] i_garden_area_unit_id
     * @param  [integer] i_furnishing_status_id
     * @param  [integer] i_design_type_id
     * @param  [integer] i_finishing_type_id
     * @param  [integer] is_featured
     * @param  [integer] is_active
     * @param  [array] translations
     * @return [json] ServiceResponse object
     */
    public function store(CreateIUnitRequest $request, CreateIUnitAction $action)
    {
        // Create the i_unit
        $i_unit = $action->execute($request->except(['facilities', 'amenities']), $request->input('facilities'), $request->input('amenities'), $request->attachments, $request->floorplans, $request->masterplans, $request->images, $request->input('tags'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Unit created successfully';
        $resp->status = true;
        switch ($request->creation_type) {
            case 'save_continue':
                $resp->data = ['redirect_to' => route('inventory.units.modals.update', ['id' => $i_unit->id]), 'i_unit' => $i_unit];
                break;
            case 'save_only':
                $resp->data = ['redirect_to' => route('inventory.units.index'), 'i_unit' => $i_unit];
                break;
            default:
                # code...
                break;
        }
        return response()->json($resp, 200);
    }

    /**
     * Update i_unit
     *
     * @param  [integer] id
     * @param  [integer] i_project_id
     * @param  [string] unit_number
     * @param  [string] building_number
     * @param  [integer] seller_id
     * @param  [integer] i_position_id
     * @param  [integer] i_view_id
     * @param  [integer] area
     * @param  [integer] garden_area
     * @param  [integer] plot_area
     * @param  [integer] build_up_area
     * @param  [integer] i_bedroom_area
     * @param  [integer] i_bathroom_area
     * @param  [integer] i_floor_number_id
     * @param  [integer] i_purpose_id
     * @param  [integer] i_purpose_type_id
     * @param  [integer] country_id
     * @param  [integer] region_id
     * @param  [integer] city_id
     * @param  [integer] area_id
     * @param  [string] latitude
     * @param  [string] longitude
     * @param  [integer] i_offering_type_id
     * @param  [integer] price
     * @param  [integer] i_payment_method_id
     * @param  [integer] buyer_id
     * @param  [integer] down_payment
     * @param  [integer] number_of_installments
     * @param  [string] currency_code
     * @param  [integer] i_area_unit_id
     * @param  [integer] i_garden_area_unit_id
     * @param  [integer] i_furnishing_status_id
     * @param  [integer] i_design_type_id
     * @param  [integer] i_finishing_type_id
     * @param  [integer] is_featured
     * @param  [integer] is_active
     * @param  [array] translations
     * @return [json] ServiceResponse object
     */
    public function update(UpdateIUnitRequest $request, UpdateIUnitAction $action)
    {
        // Update the i_unit
        $i_unit = $action->execute($request->input('id'), $request->except(['id', 'facilities', 'amenities']), $request->input('facilities'), $request->input('amenities'), $request->attachments, $request->floorplans, $request->masterplans, $request->images, $request->input('tags'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Unit updated successfully';
        $resp->status = true;
        switch ($request->creation_type) {
            case 'save_continue':
                $resp->data = ['i_unit' => $i_unit];
                break;
            case 'save_only':
                $resp->data = ['redirect_to' => route('inventory.units.index'), 'i_unit' => $i_unit];
                break;
            default:
                # code...
                break;
        }
        return response()->json($resp, 200);
    }

    /**
     * Delete i_unit
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIUnitRequest $request, DeleteIUnitAction $action)
    {
        // Delete the i_unit
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Unit deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Delete i_unit attachment
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function deleteAttachment(DeleteIUnitAttachmentRequest $request, DeleteIUnitAttachmentAction $action)
    {
        // Delete the i_unit attachment
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Unit attachment deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index i_units
     * @return Response
     */
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the i_units
            $action = new SearchIUnitsQueryAction;
            $i_units = $action->execute($auth_user, $request);
            $i_units = $i_units->with(['seller', 'purposeType', 'offeringType', 'country', 'region', 'city', 'areaPlace', 'paymentMethod', 'areaUnit', 'seller', 'buyer', 'project', 'bedroom', 'purpose', 'bathroom']);

            return Datatables::of($i_units)
                ->addColumn('project', function ($i_unit) {
                    return $i_unit->project ? $i_unit->project->value : null;
                })

                ->addColumn('seller_url', function ($i_unit) {
                    return $i_unit->seller ? $i_unit->seller->getUrl() : '#';
                })
                ->addColumn('buyer', function ($i_unit) {
                    return $i_unit->buyer ? $i_unit->buyer->full_name : null;
                })
                ->addColumn('buyer_url', function ($i_unit) {
                    return $i_unit->buyer ? $i_unit->buyer->getUrl() : '#';
                })
                ->addColumn('country', function ($i_unit) {
                    return $i_unit->country ? $i_unit->country->value : null;
                })
                ->addColumn('region', function ($i_unit) {
                    return $i_unit->region ? $i_unit->region->value : null;
                })
                ->addColumn('city', function ($i_unit) {
                    return $i_unit->city ? $i_unit->city->value : null;
                })
                ->addColumn('area_place', function ($i_unit) {
                    return $i_unit->areaPlace ? $i_unit->areaPlace->value : null;
                })
                ->addColumn('purpose_type', function ($i_unit) {
                    return $i_unit->purposeType ? $i_unit->purposeType->value : null;
                })
                ->addColumn('offering_type', function ($i_unit) {
                    return $i_unit->offeringType ? $i_unit->offeringType->value : null;
                })
                ->addColumn('payment_method', function ($i_unit) {
                    return $i_unit->paymentMethod ? $i_unit->paymentMethod->value : null;
                })
                ->addColumn('area_unit', function ($i_unit) {
                    return $i_unit->areaUnit ? $i_unit->areaUnit->value : null;
                })
                ->addColumn('bedroom', function ($i_unit) {
                    return $i_unit->bedroom ? $i_unit->bedroom->value : null;
                })
                ->addColumn('bathroom', function ($i_unit) {
                    return $i_unit->bathroom ? $i_unit->bathroom->value : null;
                })
                ->addColumn('purpose', function ($i_unit) {
                    return $i_unit->purpose ? $i_unit->purpose->value : null;
                })
                ->addColumn('purpose_type', function ($i_unit) {
                    return $i_unit->purposeType ? $i_unit->purposeType->value : null;
                })
                ->addColumn('last_updated_at', function ($i_unit) {
                    return $i_unit->updated_at ? $i_unit->updated_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_by', function ($i_unit) {
                    return $i_unit->updated_by ? $i_unit->updator->full_name : null;
                })
                ->addColumn('title', function ($i_unit) {
                    return $i_unit->title ? $i_unit->title : $i_unit->default_title;
                })
                ->filterColumn('title', function ($query, $keyword) {
                    return $query->whereHas('translations', function ($translation) use ($keyword) {
                        $translation->where('title', 'like', '%' . $keyword . '%');
                    });
                })
                ->filterColumn('city', function ($query, $keyword) {
                    return $query->where(function ($q) use ($keyword) {
                        $q->whereHas('city', function ($project) use ($keyword) {
                            $project->whereHas('translations', function ($translation) use ($keyword) {
                                $translation->where('name', 'like', '%' . $keyword . '%');
                            });
                        })->orwhereHas('region', function ($project) use ($keyword) {
                            $project->whereHas('translations', function ($translation) use ($keyword) {
                                $translation->where('name', 'like', '%' . $keyword . '%');
                            });
                        })->orwhereHas('country', function ($project) use ($keyword) {
                            $project->whereHas('translations', function ($translation) use ($keyword) {
                                $translation->where('name', 'like', '%' . $keyword . '%');
                            });
                        })->orwhereHas('areaPlace', function ($project) use ($keyword) {
                            $project->whereHas('translations', function ($translation) use ($keyword) {
                                $translation->where('name', 'like', '%' . $keyword . '%');
                            });
                        });
                    });
                })

                ->rawColumns(['description', 'description'])
                ->make(true);
        } else {
            $blade_name = ($request->ajax() ? 'index-partial' : 'index'); // Handle Partial Return

            $action = new GetIPositionsAction;
            $positions = json_decode(json_encode($action->execute()));
            $action = new GetIViewsAction;
            $views = json_decode(json_encode($action->execute()));
            $action = new GetIBedroomsAction;
            $bedrooms = json_decode(json_encode($action->execute()));
            $action = new GetIBathroomsAction;
            $bathrooms = json_decode(json_encode($action->execute()));
            $action = new GetIFloorNumbersAction;
            $floor_numbers = json_decode(json_encode($action->execute()));
            $action = new GetIPurposesAction;
            $purposes = json_decode(json_encode($action->execute()));
            $action = new GetIPurposeTypesAction;
            $purpose_types = json_decode(json_encode($action->execute()));
            $action = new GetCountriesAction;
            $countries = json_decode(json_encode($action->execute()));
            $action = new GetIOfferingTypesAction;
            $offering_types = json_decode(json_encode($action->execute()));
            $action = new GetIPaymentMethodsAction;
            $payment_methods = json_decode(json_encode($action->execute()));
            $action = new AllCurrencyCodesAction;
            $currency_codes = $action->execute();
            $action = new GetIAreaUnitsAction;
            $area_units = json_decode(json_encode($action->execute()));
            $action = new GetIFurnishingStatusesAction;
            $furnishing_statuses = json_decode(json_encode($action->execute()));
            $action = new GetIFinishingTypesAction;
            $finishing_types = json_decode(json_encode($action->execute()));
            $action = new GetIDesignTypesAction;
            $design_types = json_decode(json_encode($action->execute()));

            return view('inventory::units.' . $blade_name, [
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
                'currency_codes' => $currency_codes,
                'area_units' => $area_units,
                'furnishing_statuses' => $furnishing_statuses,
                'finishing_types' => $finishing_types,
                'design_types' => $design_types,
            ]);
        }
    }

    public function export(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Search the units
        $action = new SearchIUnitsQueryAction;
        $units = $action->execute($auth_user, $request);

        $headers = [
            'ID',
            'TITLE',
            'PROJECT',
            'UNIT_NUMBER',
            'SELLER',
            'AREA',
            'BEDROOM',
            'BATHROOM',
            'PURPOSE',
            'PURPOSE_TYPE',
            'COUNTRY',
            'REGION',
            'CITY',
            'LATITUDE',
            'LONGITUDE',
            'ADDRESS',
            'OFFERING_TYPE',
            'PRICE',
            'DESCRIPTION',
            'DOWN_PAYMENT',
            'INSTALLMENTS',
            'CURRENCY_CODE',
            'FURNISHING_STATUS',
            'FINISHING_TYPE',
            'FACILITIES',
            'AMENITIES',
            'CREATED_BY',
            'CREATED_AT',
            'LAST_UPDATED_BY',
            'LAST_UPDATED_AT',
            'URL'
        ];

        $data = [];

        $units = $units->get();

        // Transform the units
        $units = json_decode(json_encode(IUnitResource::collection($units)));

        foreach ($units as $unit) {
            $data[] = [
                $unit->id,
                $unit->title,
                $unit->project,
                $unit->unit_number,
                $unit->seller->full_name,
                $unit->area,
                $unit->bedroom,
                $unit->bathroom,
                $unit->purpose,
                $unit->purpose_type,
                $unit->country ? $unit->country->name : '',
                $unit->region ? $unit->region->name : '',
                $unit->city ? $unit->city->name : '',
                $unit->latitude,
                $unit->longitude,
                $unit->address,
                $unit->offering_type,
                $unit->price,
                strip_tags($unit->description),
                $unit->down_payment,
                $unit->installments,
                $unit->currency_code,
                $unit->furnishing_status,
                $unit->finishing_type,
                implode(', ', collect($unit->facilities)->pluck('facility')->toArray()),
                implode(', ', collect($unit->amenities)->pluck('amenity')->toArray()),
                $unit->creator ? $unit->creator->full_name : null,
                $unit->created_at,
                $unit->editor ? $unit->editor->full_name : null,
                $unit->updated_at,
                route('inventory.units.unit', ['id' => $unit->id])
            ];
        }

        $file_name = 'UNITS (' . Carbon::now() . ')';
        $sheet_name = 'UNITS';
        return Utilities::export($file_name, $sheet_name, $data, $headers);
    }

    /**
     * Show i_unit
     * @return Response
     */
    public function show(Request $request, $id, GetIUnitByIdAction $action)
    {
        // Get the i_unit
        $i_unit = json_decode(json_encode($action->execute($id)));

        if (!$i_unit) {
            abort(404);
        }

        $blade_name = ($request->ajax() ? 'unit-partial' : 'unit'); // Handle Partial Return

        return view('inventory::units.' . $blade_name)->with('i_unit', $i_unit)->render();
    }

    /**
     * Create i_unit
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();
        $languages = Language::all();

        $action = new GetIPositionsAction;
        $positions = json_decode(json_encode($action->execute()));

        $action = new GetIViewsAction;
        $views = json_decode(json_encode($action->execute()));

        $action = new GetIBedroomsAction;
        $bedrooms = json_decode(json_encode($action->execute()));

        $action = new GetIBathroomsAction;
        $bathrooms = json_decode(json_encode($action->execute()));

        $action = new GetIFloorNumbersAction;
        $floor_numbers = json_decode(json_encode($action->execute()));

        $action = new GetIPurposesAction;
        $purposes = json_decode(json_encode($action->execute()));

        $action = new GetIPurposeTypesAction;
        $purpose_types = json_decode(json_encode($action->execute()));

        $action = new GetCountriesAction;
        $countries = json_decode(json_encode($action->execute()));

        $action = new GetIOfferingTypesAction;
        $offering_types = json_decode(json_encode($action->execute()));

        $action = new GetIPaymentMethodsAction;
        $payment_methods = json_decode(json_encode($action->execute()));

        $action = new AllCurrencyCodesAction;
        $currency_codes = $action->execute();

        $action = new GetIAreaUnitsAction;
        $area_units = json_decode(json_encode($action->execute()));

        $action = new GetIFurnishingStatusesAction;
        $furnishing_statuses = json_decode(json_encode($action->execute()));

        $action = new GetIFinishingTypesAction;
        $finishing_types = json_decode(json_encode($action->execute()));

        $action = new GetIDesignTypesAction;
        $design_types = json_decode(json_encode($action->execute()));

        $action = new GetIFacilitiesAction;
        $facilities = json_decode(json_encode($action->execute()));

        $action = new GetIAmenitiesAction;
        $amenities = json_decode(json_encode($action->execute()));

        $action = new GetTagsAction;
        $tags = json_decode(json_encode($action->execute()));

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return
        return view('inventory::units.' . $blade_name, [
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
            'currency_codes' => $currency_codes,
            'area_units' => $area_units,
            'furnishing_statuses' => $furnishing_statuses,
            'finishing_types' => $finishing_types,
            'design_types' => $design_types,
            'facilities' => $facilities,
            'amenities' => $amenities,
            'languages' => $languages,
            'tags' => $tags
        ]);
    }

    public function createIUnitModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        $action = new GetIPositionsAction;
        $positions = json_decode(json_encode($action->execute()));

        $action = new GetIViewsAction;
        $views = json_decode(json_encode($action->execute()));

        $action = new GetIBedroomsAction;
        $bedrooms = json_decode(json_encode($action->execute()));

        $action = new GetIBathroomsAction;
        $bathrooms = json_decode(json_encode($action->execute()));

        $action = new GetIFloorNumbersAction;
        $floor_numbers = json_decode(json_encode($action->execute()));

        $action = new GetIPurposesAction;
        $purposes = json_decode(json_encode($action->execute()));

        $action = new GetIPurposeTypesAction;
        $purpose_types = json_decode(json_encode($action->execute()));

        $action = new GetCountriesAction;
        $countries = json_decode(json_encode($action->execute()));

        $action = new GetIOfferingTypesAction;
        $offering_types = json_decode(json_encode($action->execute()));

        $action = new GetIPaymentMethodsAction;
        $payment_methods = json_decode(json_encode($action->execute()));

        $action = new AllCurrencyCodesAction;
        $currency_codes = $action->execute();

        $action = new GetIAreaUnitsAction;
        $area_units = json_decode(json_encode($action->execute()));

        $action = new GetIFurnishingStatusesAction;
        $furnishing_statuses = json_decode(json_encode($action->execute()));

        $action = new GetIFinishingTypesAction;
        $finishing_types = json_decode(json_encode($action->execute()));

        $action = new GetIDesignTypesAction;
        $design_types = json_decode(json_encode($action->execute()));

        $action = new GetIFacilitiesAction;
        $facilities = json_decode(json_encode($action->execute()));

        $action = new GetIAmenitiesAction;
        $amenities = json_decode(json_encode($action->execute()));

        $action = new GetTagsAction;
        $tags = json_decode(json_encode($action->execute()));

        return view('inventory::units.modals.create', [
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
            'currency_codes' => $currency_codes,
            'area_units' => $area_units,
            'furnishing_statuses' => $furnishing_statuses,
            'finishing_types' => $finishing_types,
            'facilities' => $facilities,
            'amenities' => $amenities
        ])->render();
    }

    public function UpdateIUnitModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        $i_unit = IUnit::find($id);
        $i_unit->load('seller');
        $i_unit->load('buyer');

        $languages = Language::all();

        // If i_unit does not exist, return error div
        if (!$i_unit) {
            $error = Lang::get('inventory::inventory.i_unit_not_found_or_you_are_not_authorized_to_edit_the_i_unit');
            return view('dashboard.components.error', compact('error'))->render();
        }

        $action = new GetIPositionsAction;
        $positions = json_decode(json_encode($action->execute()));

        $action = new GetIViewsAction;
        $views = json_decode(json_encode($action->execute()));

        $action = new GetIBedroomsAction;
        $bedrooms = json_decode(json_encode($action->execute()));

        $action = new GetIBathroomsAction;
        $bathrooms = json_decode(json_encode($action->execute()));

        $action = new GetIFloorNumbersAction;
        $floor_numbers = json_decode(json_encode($action->execute()));

        $action = new GetIPurposesAction;
        $purposes = json_decode(json_encode($action->execute()));

        $action = new GetIPurposeTypesAction;
        $purpose_types = json_decode(json_encode($action->execute()));

        $action = new GetCountriesAction;
        $countries = json_decode(json_encode($action->execute()));

        $action = new GetIOfferingTypesAction;
        $offering_types = json_decode(json_encode($action->execute()));

        $action = new GetIPaymentMethodsAction;
        $payment_methods = json_decode(json_encode($action->execute()));

        $action = new AllCurrencyCodesAction;
        $currency_codes = $action->execute();

        $action = new GetIAreaUnitsAction;
        $area_units = json_decode(json_encode($action->execute()));

        $action = new GetIFurnishingStatusesAction;
        $furnishing_statuses = json_decode(json_encode($action->execute()));

        $action = new GetIFinishingTypesAction;
        $finishing_types = json_decode(json_encode($action->execute()));

        $action = new GetIDesignTypesAction;
        $design_types = json_decode(json_encode($action->execute()));

        $action = new GetIFacilitiesAction;
        $facilities = json_decode(json_encode($action->execute()));

        $action = new GetIAmenitiesAction;
        $amenities = json_decode(json_encode($action->execute()));

        $action = new GetTagsAction;
        $tags = json_decode(json_encode($action->execute()));

        $regions = null;
        $cities = null;
        $area_places = null;
        if ($i_unit->country_id) {
            $regions = json_decode(json_encode((new GetCountryRegionsAction)->execute(['country_id' => $i_unit->country_id])));
            if ($i_unit->region_id) {
                $cities = json_decode(json_encode((new GetRegionCitiesAction)->execute(['region_id' => $i_unit->region_id])));
                if ($i_unit->city_id) {
                    $area_places = json_decode(json_encode((new GetCityAreasAction)->execute(['city_id' => $i_unit->city_id])));
                }
            }
        }

        return view('inventory::units.update', compact('i_unit'), [
            'positions' => $positions,
            'views' => $views,
            'bedrooms' => $bedrooms,
            'bathrooms' => $bathrooms,
            'floor_numbers' => $floor_numbers,
            'purposes' => $purposes,
            'purpose_types' => $purpose_types,
            'countries' => $countries,
            'regions' => $regions,
            'cities' => $cities,
            'area_places' => $area_places,
            'offering_types' => $offering_types,
            'payment_methods' => $payment_methods,
            'currency_codes' => $currency_codes,
            'area_units' => $area_units,
            'furnishing_statuses' => $furnishing_statuses,
            'finishing_types' => $finishing_types,
            'design_types' => $design_types,
            'facilities' => $facilities,
            'amenities' => $amenities,
            'languages' => $languages,
            'tags' => $tags
        ])->render();
    }

    public function import(ImportIUnitRequest $request, ImportIUnitAction $action)
    {
        $i_units = $action->execute($request->units_file);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'File Imported successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    public function importModal()
    {
        return view('inventory::units.modals.import')->render();
    }

    public function tagsinput(IUnitsTagsInputRequest $request, IUnitsTagsInputAction $action)
    {
        // Get the units
        $units = $action->execute($request->all());

        return response()->json($units, 200);
    }
}
