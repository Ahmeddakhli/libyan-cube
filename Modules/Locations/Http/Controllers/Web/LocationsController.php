<?php

namespace Modules\Locations\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Locations\Http\Controllers\Actions\GetCountriesAction;
use Modules\Locations\Http\Controllers\Actions\GetCountryRegionsAction;
use Modules\Locations\Http\Controllers\Actions\GetRegionCitiesAction;
use Modules\Locations\Http\Controllers\Actions\GetCountryByIdAction;
use Modules\Locations\Http\Controllers\Actions\GetRegionByIdAction;
use Modules\Locations\Http\Controllers\Actions\GetCityByIdAction;
use Modules\Locations\Http\Requests\GetCountriesRequest;
use Modules\Locations\Http\Requests\GetCountryRegionsRequest;
use Modules\Locations\Http\Requests\GetRegionCitiesRequest;
use Modules\Locations\Http\Requests\GetCountryByIdRequest;
use Modules\Locations\Http\Requests\GetRegionByIdRequest;
use Modules\Locations\Http\Requests\GetCityByIdRequest;
use App\Http\Helpers\ServiceResponse;
use App\Language;
use Carbon\Carbon;
use Auth;
use Modules\Locations\Http\Controllers\Actions\SearchLocationsQueryAction;
use Modules\Locations\Http\Controllers\Actions\CreateLocationAction;
use Modules\Locations\Http\Controllers\Actions\DeleteLocationAction;
use Modules\Locations\Http\Controllers\Actions\GetCityAreasAction;
use Modules\Locations\Http\Controllers\Actions\UpdateLocationAction;
use Modules\Locations\Http\Requests\CreateLocationRequest;
use Modules\Locations\Http\Requests\DeleteLocationRequest;
use Modules\Locations\Http\Requests\GetCityAreasRequest;
use Modules\Locations\Http\Requests\UpdateLocationRequest;
use Modules\Locations\Location;
use Yajra\Datatables\Datatables;

class LocationsController extends Controller
{
    /**
     * Get countries
     *
     * @return [json] ServiceResponse object
     */
    public function getCountries(GetCountriesRequest $request, GetCountriesAction $action)
    {
        // Get the countries
        $countries = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Countries retrieved successfully';
        $resp->status = true;
        $resp->data = $countries;
        return response()->json($resp, 200);
    }

    /**
     * Get country regions
     *
     * @return [json] ServiceResponse object
     */
    public function getCountryRegions(GetCountryRegionsRequest $request, GetCountryRegionsAction $action)
    {
        // Get country regions
        $regions = $action->execute($request->except([]));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Regions retrieved successfully';
        $resp->status = true;
        $resp->data = $regions;
        return response()->json($resp, 200);
    }

    /**
     * Get region cities
     *
     * @return [json] ServiceResponse object
     */
    public function getRegionCities(GetRegionCitiesRequest $request, GetRegionCitiesAction $action)
    {
        // Get region cities
        $cities = $action->execute($request->except([]));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Cities retrieved successfully';
        $resp->status = true;
        $resp->data = $cities;
        return response()->json($resp, 200);
    }
    /**
     * Get city areas
     *
     * @return [json] ServiceResponse object
     */
    public function getCityAreas(GetCityAreasRequest $request, GetCityAreasAction $action)
    {
        // Get city areas
        $areas = $action->execute($request->except([]));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Areas retrieved successfully';
        $resp->status = true;
        $resp->data = $areas;
        return response()->json($resp, 200);
    }
    /**
     * Get country by id
     *
     * @return [json] ServiceResponse object
     */
    public function getCountryById(GetCountryByIdRequest $request, GetCountryByIdAction $action)
    {
        // Get country
        $country = $action->execute($request->except([]));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Country retrieved successfully';
        $resp->status = true;
        $resp->data = $country;
        return response()->json($resp, 200);
    }

    /**
     * Get region by id
     *
     * @return [json] ServiceResponse object
     */
    public function getRegionById(GetRegionByIdRequest $request, GetRegionByIdAction $action)
    {
        // Get region
        $region = $action->execute($request->except([]));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Region retrieved successfully';
        $resp->status = true;
        $resp->data = $region;
        return response()->json($resp, 200);
    }

    /**
     * Get city by id
     *
     * @return [json] ServiceResponse object
     */
    public function getCityById(GetCityByIdRequest $request, GetCityByIdAction $action)
    {
        // Get city
        $city = $action->execute($request->except([]));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'City retrieved successfully';
        $resp->status = true;
        $resp->data = $city;
        return response()->json($resp, 200);
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {

            // Search the locationss
            $action = new SearchLocationsQueryAction;
            $locationss = $action->execute($auth_user, $request);

            return DataTables::of($locationss)
                ->addColumn('value', function ($locations) {
                    return $locations->value;
                })
                ->filterColumn('value', function ($query, $keyword) {
                    $query->whereHas('translations', function ($translation) use ($keyword) {
                        $translation->where('name', 'like', '%' . $keyword . '%');
                    });
                })
                ->addColumn('created_at', function ($locations) {
                    return $locations->created_at ? $locations->created_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_at', function ($locations) {
                    return $locations->updated_at ? $locations->updated_at->toDateTimeString() : null;
                })
                ->orderColumn('created_at', function ($query, $order) {
                    return  $query->orderBy('created_at', $order);
                })
                ->orderColumn('last_updated_at', function ($query, $order) {
                    return  $query->orderBy('updated_at', $order);
                })
                ->make(true);
        } else {
            $blade_name = ($request->ajax() ? 'index-partial' : 'index'); // Handle Partial Return

            return view('locations::locations.' . $blade_name);
        }
    }

    /**
     * Create locations
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        $locations = Location::where('parent_id', null)->get();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('locations::locations.' . $blade_name, compact('languages', 'locations'), []);
    }

    public function createLocationModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();
        $parent_id = $request->id ? $request->id : Location::where('parent_id', null)->first()->id;

        return view('locations::locations.modals.create', compact('languages', 'parent_id'), [])->render();
    }

    public function UpdateLocationModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        $location = Location::find($id);

        // If locations does not exist, return error div
        if (!$location) {
            $error = Lang::get('locations::locations.locations_not_found_or_you_are_not_authorized_to_edit_the_locations');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the languages
        $languages = Language::all();

        return view('locations::locations.modals.update', compact('location', 'languages'), [])->render();
    }
    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(CreateLocationRequest $request, CreateLocationAction $action)
    {
        // Create location
        $location = $action->execute($request->except('translations'), $request->translations);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Location Created successfully';
        $resp->status = true;
        if ($request->parent_id) {
            $resp->data = ['redirect_to' => route('locations.index', ['id' => $request->parent_id]), 'location' => $location];
        } else {
            $resp->data = ['redirect_to' => route('locations.index'), 'location' => $location];
        }

        return response()->json($resp, 200);
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(UpdateLocationRequest $request, UpdateLocationAction $action)
    {
        // Update location
        $location = $action->execute($request->id, $request->except('translations'), $request->translations);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Location Updated successfully';
        $resp->status = true;
        if ($request->parent_id) {
            $resp->data = ['redirect_to' => route('locations.index', ['id' => $request->parent_id]), 'location' => $location];
        } else {
            $resp->data = ['redirect_to' => route('locations.index'), 'location' => $location];
        }
        return response()->json($resp, 200);
    }


    /**
     * Delete location
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteLocationRequest $request, DeleteLocationAction $action)
    {
        // Delete the location
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Location deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }
}
