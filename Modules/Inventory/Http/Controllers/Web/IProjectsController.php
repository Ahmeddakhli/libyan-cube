<?php

namespace Modules\Inventory\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Inventory\Http\Controllers\Actions\Projects\SearchIProjectsQueryAction;
use Modules\Inventory\Http\Controllers\Actions\Projects\CreateIProjectAction;
use Modules\Inventory\Http\Controllers\Actions\Projects\DeleteIProjectAction;
use Modules\Inventory\Http\Controllers\Actions\Projects\GetIProjectByIdAction;
use Modules\Inventory\Http\Controllers\Actions\Projects\UpdateIProjectAction;
use Modules\Inventory\Http\Controllers\Actions\Developers\GetIDevelopersAction;
use Modules\Inventory\Http\Controllers\Actions\Projects\IProjectsTagsInputAction;
use Modules\Inventory\Http\Requests\Projects\CreateIProjectRequest;
use Modules\Inventory\Http\Requests\Projects\DeleteIProjectRequest;
use Modules\Inventory\Http\Requests\Projects\GetIProjectRequest;
use Modules\Inventory\Http\Requests\Projects\UpdateIProjectRequest;
use Modules\Inventory\Http\Requests\Projects\IProjectsTagsInputRequest;
use Modules\Inventory\Http\Resources\IProjectResource;
use Modules\Inventory\IProject;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth, Lang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Yajra\Datatables\Datatables;
use App\Language;
use Modules\Locations\Http\Controllers\Actions\GetCountriesAction;
use Modules\Internationalizations\Http\Controllers\Actions\Currencies\AllCurrencyCodesAction;
use Modules\Inventory\Http\Controllers\Actions\AreaUnits\GetIAreaUnitsAction;
use Modules\Inventory\Http\Controllers\Actions\Facilities\GetIFacilitiesAction;
use Modules\Inventory\Http\Controllers\Actions\Amenities\GetIAmenitiesAction;
use App\Http\Helpers\Utilities;
use Modules\Inventory\Http\Controllers\Actions\Projects\PublishIProjectAction;
use Modules\Locations\Http\Controllers\Actions\GetCityAreasAction;
use Modules\Locations\Http\Controllers\Actions\GetCountryRegionsAction;
use Modules\Locations\Http\Controllers\Actions\GetRegionCitiesAction;
use Modules\Tags\Http\Controllers\Actions\GetTagsAction;

class IProjectsController extends Controller
{
    public function __construct()
    {
        //
    }

    /**
     * Store i_project
     *
     * @param  [integer] developer_id
     * @param  [timestamp] delivery_date
     * @param  [integer] finished_status
     * @param  [integer] country_id
     * @param  [integer] region_id
     * @param  [integer] city_id
     * @param  [integer] area_id
     * @param  [string] latitude
     * @param  [string] longitude
     * @param  [string] address
     * @param  [integer] area_from
     * @param  [integer] area_to
     * @param  [integer] price_from
     * @param  [integer] price_to
     * @param  [string] currency_code
     * @param  [integer] i_area_unit_id
     * @param  [integer] down_payment_from
     * @param  [integer] down_payment_to
     * @param  [integer] number_of_installments_from
     * @param  [integer] number_of_installments_to
     * @param  [integer] is_featured
     * @param  [array] facilities
     * @param  [array] amenities
     * @param  [array] tags
     * @param  [array] attachments
     * @param  [array] floorplans
     * @param  [array] masterplans
     * @param  [array] phases
     * @param  [array] translations
     * @return [json] ServiceResponse object
     */
    public function store(CreateIProjectRequest $request, CreateIProjectAction $action)
    {
        // Create the i_project
        $i_project = $action->execute($request->except(['facilities', 'amenities', 'phases']), $request->input('facilities'), $request->input('amenities'), $request->input('tags'), $request->attachments, $request->floorplans, $request->masterplans, $request->phases);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Project created successfully';
        $resp->status = true;
        switch ($request->creation_type) {
            case 'save_continue':
                $resp->data = ['redirect_to' => route('inventory.projects.modals.update',['id'=>$i_project->id]),'i_project' => $i_project];
                break;
            case 'save_only':
                $resp->data = ['redirect_to' => route('inventory.projects.index'), 'i_project' => $i_project];
                break;
            default:
                # code...
                break;
        }
        return response()->json($resp, 200);
    }

    /**
     * Update i_project
     *
     * @param  [integer] id
     * @param  [integer] developer_id
     * @param  [timestamp] delivery_date
     * @param  [integer] finished_status
     * @param  [integer] country_id
     * @param  [integer] region_id
     * @param  [integer] city_id
     * @param  [integer] area_id
     * @param  [string] latitude
     * @param  [string] longitude
     * @param  [string] address
     * @param  [integer] area_from
     * @param  [integer] area_to
     * @param  [integer] price_from
     * @param  [integer] price_to
     * @param  [string] currency_code
     * @param  [integer] i_area_unit_id
     * @param  [integer] down_payment_from
     * @param  [integer] down_payment_to
     * @param  [integer] number_of_installments_from
     * @param  [integer] number_of_installments_to
     * @param  [integer] is_featured
     * @param  [array] facilities
     * @param  [array] amenities
     * @param  [array] tags
     * @param  [array] attachments
     * @param  [array] floorplans
     * @param  [array] masterplans
     * @param  [array] phases
     * @param  [array] translations
     * @return [json] ServiceResponse object
     */
    public function update(Request $request, UpdateIProjectAction $action)
    {
        // Update the i_project
        $i_project = $action->execute($request->input('id'), $request->except(['facilities', 'amenities', 'phases', 'id']), $request->input('facilities'), $request->input('amenities'), $request->input('tags'), $request->attachments, $request->floorplans, $request->masterplans, $request->phases);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Project updated successfully';
        $resp->status = true;
        switch ($request->creation_type) {
            case 'save_continue':
                $resp->data = ['redirect_to' => route('inventory.projects.modals.update',['id'=>$i_project->id]),'i_project' => $i_project];
                break;
            case 'save_only':
                $resp->data = ['redirect_to' => route('inventory.projects.index'), 'i_project' => $i_project];
                break;
            default:
                # code...
                break;
        }
        return response()->json($resp, 200);
    }

    /**
     * Delete i_project
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteIProjectRequest $request, DeleteIProjectAction $action)
    {
        // Delete the i_project
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Project deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }
    /**
     * Delete i_project
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function publish(DeleteIProjectRequest $request, PublishIProjectAction $action)
    {
        // publish the i_project
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Project publish successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }
    /**
     * Index i_projects
     * @return Response
     */
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the i_projects
            $action = new SearchIProjectsQueryAction;
            $i_projects = $action->execute($auth_user, $request);
            $i_projects =  $i_projects->with('country', 'region', 'city', 'area', 'areaUnit');

            return Datatables::of($i_projects)
                ->addColumn('value', function ($project) {
                    return $project->value;
                })
                ->filterColumn('value', function ($query, $keyword) {
                    $query->whereHas('translations', function ($translation) use ($keyword) {
                        $translation->where('project', 'like', '%' . $keyword . '%');
                    });
                })
                ->orderColumn('city', function ($query, $order) {
                    return  $query->orderBy('city_id', $order);
                })
                // ->addColumn('city', function ($project) {
                //     return $project->city ? $project->city : null;
                // })
                ->filterColumn('city', function ($query, $keyword) {
                    $query->whereHas('city', function ($query) use ($keyword) {
                        $query->whereHas('translations', function ($translation) use ($keyword) {
                            $translation->where('name', 'like', '%' . $keyword . '%');
                        });
                    });
                })
                ->addColumn('delivery_date', function ($i_project) {
                    return $i_project->delivery_date ? $i_project->delivery_date :'';
                })
                ->addColumn('finished_status', function ($i_project) {
                    return $i_project->finished_status ? Lang::get('inventory::inventory.finished') : Lang::get('inventory::inventory.not_finished');
                })
                ->addColumn('created_at', function ($i_project) {
                    return $i_project->created_at ? $i_project->created_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_at', function ($i_project) {
                    return $i_project->updated_at ? $i_project->updated_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_by', function ($i_project) {
                    return $i_project->updated_by ? $i_project->updator->full_name : null;
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

            $action = new GetCountriesAction;
            $countries = json_decode(json_encode($action->execute()));

            $action = new GetIAreaUnitsAction;
            $area_units = json_decode(json_encode($action->execute()));

            $action = new AllCurrencyCodesAction;
            $currency_codes = $action->execute();

            return view('inventory::projects.' . $blade_name, [
                'countries' => $countries,
                'area_units' => $area_units,
                'currency_codes' => $currency_codes,
            ]);
        }
    }

    /**
     * Show I_project
     * @return Response
     */
    public function show(Request $request, $id, GetIProjectByIdAction $action)
    {
        // Get the I_project
        $i_project = json_decode(json_encode($action->execute($id)));

        if (!$i_project) {
            abort(404);
        }

        $blade_name = ($request->ajax() ? 'project-content-qv' : ''); // Handle Partial Return

        return view('inventory::projects.' . $blade_name)->with('i_project', $i_project)->render();
    }

    /**
     * Create i_project
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        $action = new GetIDevelopersAction;
        $developers = $action->execute();

        $action = new GetCountriesAction;
        $countries = json_decode(json_encode($action->execute()));

        $action = new AllCurrencyCodesAction;
        $currency_codes = $action->execute();

        $action = new GetIAreaUnitsAction;
        $area_units = json_decode(json_encode($action->execute()));

        $action = new GetIFacilitiesAction;
        $facilities = json_decode(json_encode($action->execute()));

        $action = new GetIAmenitiesAction;
        $amenities = json_decode(json_encode($action->execute()));

        $action = new GetTagsAction;
        $tags = json_decode(json_encode($action->execute()));

        $languages = Language::all();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('inventory::projects.' . $blade_name, [
            'developers' => $developers,
            'countries' => $countries,
            'currency_codes' => $currency_codes,
            'area_units' => $area_units,
            'facilities' => $facilities,
            'amenities' => $amenities,
            'languages' => $languages,
            'tags' => $tags
        ]);
    }

    public function createIProjectModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        $action = new GetIDevelopersAction;
        $developers = $action->execute();

        $action = new GetCountriesAction;
        $countries = json_decode(json_encode($action->execute()));

        $action = new AllCurrencyCodesAction;
        $currency_codes = $action->execute();

        $action = new GetIAreaUnitsAction;
        $area_units = json_decode(json_encode($action->execute()));

        $action = new GetIFacilitiesAction;
        $facilities = json_decode(json_encode($action->execute()));

        $action = new GetIAmenitiesAction;
        $amenities = json_decode(json_encode($action->execute()));

        $action = new GetTagsAction;
        $tags = json_decode(json_encode($action->execute()));

        $languages = Language::all();

        return view('inventory::projects.modals.create', [
            'developers' => $developers,
            'countries' => $countries,
            'currency_codes' => $currency_codes,
            'area_units' => $area_units,
            'facilities' => $facilities,
            'amenities' => $amenities,
            'languages' => $languages,
            'tags' => $tags
        ])->render();
    }

    public function UpdateIProjectModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        $i_project = IProject::where('id', $id)->with('phases', 'phases.translations', 'phases.attachments', 'attachmentables')->first();

        // Transform the date
        // if ($i_project->delivery_date) {
        //     $i_project->delivery_date = Carbon::createFromFormat('Y-m-d', $i_project->delivery_date)->timezone(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->format('Y-m-d H:i');
        // }

        // If i_project does not exist, return error div
        if (!$i_project) {
            $error = Lang::get('inventory::inventory.i_project_not_found_or_you_are_not_authorized_to_edit_the_i_project');
            return view('dashboard.components.error', compact('error'))->render();
        }

        $action = new GetIDevelopersAction;
        $developers = $action->execute();

        $action = new GetCountriesAction;
        $countries = json_decode(json_encode($action->execute()));

        $action = new AllCurrencyCodesAction;
        $currency_codes = $action->execute();

        $action = new GetIAreaUnitsAction;
        $area_units = json_decode(json_encode($action->execute()));

        $action = new GetIFacilitiesAction;
        $facilities = json_decode(json_encode($action->execute()));

        $action = new GetIAmenitiesAction;
        $amenities = json_decode(json_encode($action->execute()));

        $action = new GetTagsAction;
        $tags = json_decode(json_encode($action->execute()));

        $languages = Language::all();

        $phases = $i_project->phases;

        $regions = null;
        $cities = null;
        $area_places = null;
        if ($i_project->country_id) {
            $regions = json_decode(json_encode((new GetCountryRegionsAction)->execute(['country_id' => $i_project->country_id])));
            if ($i_project->region_id) {
                $cities = json_decode(json_encode((new GetRegionCitiesAction)->execute(['region_id' => $i_project->region_id])));
                if ($i_project->city_id) {
                    $area_places = json_decode(json_encode((new GetCityAreasAction)->execute(['city_id' => $i_project->city_id])));
                }
            }
        }
        return view('inventory::projects.update', compact('i_project', 'phases'), [
            'developers' => $developers,
            'countries' => $countries,
            'regions' => $regions,
            'cities' => $cities,
            'area_places' => $area_places,
            'currency_codes' => $currency_codes,
            'area_units' => $area_units,
            'facilities' => $facilities,
            'amenities' => $amenities,
            'languages' => $languages,
            'tags' => $tags
        ]);
    }

    public function export(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Search the projects
        $action = new SearchIProjectsQueryAction;
        $projects = $action->execute($auth_user, $request);

        $headers = [
            'ID',
            'PROJECT',
            'DELIVERY_DATE',
            'AREA_FROM',
            'COUNTRY',
            'REGION',
            'CITY',
            'AREA',
            'LATITUDE',
            'LONGITUDE',
            'ADDRESS',
            'PRICE_FROM',
            'DESCRIPTION',
            'NUMBER_OF_INSTALLMENTS_FROM',
            'CURRENCY_CODE',
            'AREA_UNIT',
            'FACILITIES',
            'AMENITIES',
            'creator',
            'created_at',
            'editor',
            'updated_at',
        ];

        $data = [];

        $projects = $projects->get();

        // Transform the projects
        $projects = json_decode(json_encode(IProjectResource::collection($projects)));

        foreach ($projects as $project) {
            $data[] = [
                $project->id,
                $project->project,
                $project->delivery_date,
                $project->area_from,
                $project->country ? $project->country->name : '',
                $project->region ? $project->region->name : '',
                $project->city ? $project->city->name : '',
                $project->area ? $project->area->name : '',
                $project->latitude,
                $project->longitude,
                $project->address,
                $project->price_from,
                strip_tags($project->description),
                $project->number_of_installments_from,
                $project->currency_code,
                $project->area_unit,
                $project->facilities ? implode(', ', collect($project->facilities)->pluck('facility')->toArray()) : '',
                $project->amenities ? implode(', ', collect($project->amenities)->pluck('amenity')->toArray()) : '',
                $project->creator ? $project->creator->full_name : null,
                $project->created_at,
                $project->editor ? $project->editor->full_name : null,
                $project->updated_at,
            ];
        }

        $file_name = 'PROJECTS (' . Carbon::now() . ')';
        $sheet_name = 'PROJECTS';

        return Utilities::export($file_name, $sheet_name, $data, $headers);
    }

    public function selectProject(Request $request)
    {
        $i_project = IProject::where('id', $request->id)->with('facilities', 'amenities', 'tags','unitTypes')->first();

        return $i_project;
    }

    public function getPhasesRepeaterPartial(Request $request)
    {
        $languages = Language::all();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Partial retrieved successfully';
        $resp->status = true;
        $resp->data = view('inventory::projects.phases-repeater-partial', compact(['languages']))->render();
        return response()->json($resp, 200);
    }

    public function tagsinput(IProjectsTagsInputRequest $request, IProjectsTagsInputAction $action)
    {
        // Get the projects
        $projects = $action->execute($request->all());

        return response()->json($projects, 200);
    }
}
