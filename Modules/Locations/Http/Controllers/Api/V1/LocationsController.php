<?php

namespace Modules\Locations\Http\Controllers\Api\V1;

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
use Carbon\Carbon;
use Auth;
use Modules\Locations\Http\Controllers\Actions\CreateLocationAction;
use Modules\Locations\Http\Controllers\Actions\DeleteLocationAction;
use Modules\Locations\Http\Controllers\Actions\GetCityAreasAction;
use Modules\Locations\Http\Controllers\Actions\UpdateLocationAction;
use Modules\Locations\Http\Requests\CreateLocationRequest;
use Modules\Locations\Http\Requests\DeleteLocationRequest;
use Modules\Locations\Http\Requests\GetCityAreasRequest;
use Modules\Locations\Http\Requests\UpdateLocationRequest;

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
        $resp->message = 'Cities retrieved successfully';
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
        $resp->data = $location;
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
        $resp->data = $location;
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
