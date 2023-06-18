<?php

namespace App\Http\Controllers\Web\Front;

use App\Http\Controllers\Actions\Groups\GetGroupsAction;
use App\Http\Controllers\Controller;
use App\Http\Helpers\ServiceResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\About\About;
use Modules\About\Http\Controllers\Actions\GetAboutAction;
use Modules\Blog\Http\Controllers\Actions\Blog\GetBlogsAction;
use Modules\Blog\Http\Controllers\Actions\Blog\GetFeaturedBlogsAction;
use Modules\Compares\Http\Controllers\Actions\GetComparesAction;
use Modules\Inventory\Http\Controllers\Actions\Amenities\GetIAmenitiesAction;
use Modules\Inventory\Http\Controllers\Actions\Bathrooms\GetIBathroomsAction;
use Modules\Inventory\Http\Controllers\Actions\Bedrooms\GetIBedroomsAction;
use Modules\Inventory\Http\Controllers\Actions\Developers\GetIDevelopersAction;
use Modules\Inventory\Http\Controllers\Actions\Facilities\GetIFacilitiesAction;
use Modules\Inventory\Http\Controllers\Actions\FinishingTypes\GetIFinishingTypesAction;
use Modules\Inventory\Http\Controllers\Actions\OfferingTypes\GetIOfferingTypesAction;
use Modules\Inventory\Http\Controllers\Actions\PaymentMethods\GetIPaymentMethodsAction;
use Modules\Inventory\Http\Controllers\Actions\Projects\GetFeaturedProjectsAction;
use Modules\Inventory\Http\Controllers\Actions\Purposes\GetIPurposesAction;
use Modules\Inventory\Http\Controllers\Actions\PurposeTypes\GetIPurposeTypesAction;
use Modules\Inventory\Http\Controllers\Actions\SellRequests\CreateISellRequestAction;
use Modules\Inventory\Http\Controllers\Actions\Units\GetFeaturedUnitsAction;
use Modules\Inventory\Http\Requests\SellRequests\CreateISellRequestRequest;
use Modules\Inventory\Http\Controllers\Actions\Units\GetUnitPricesListAction;
use Modules\Locations\Http\Controllers\Actions\FindLocationAction;
use Modules\Settings\Http\Controllers\Actions\MainSliders\GetMainSlidersAction;
use Modules\Settings\Http\Controllers\Actions\TopAgents\GetTopAgentsAction;
use Modules\Testimonials\Http\Controllers\Actions\GetFeaturedTestimonialsAction;
use Modules\Testimonials\Http\Controllers\Actions\GetTestimonialsAction;
use Modules\Inventory\Http\Controllers\Actions\DesignTypes\GetIDesignTypesAction;
use Modules\Inventory\Http\Controllers\Actions\FurnishingStatuses\GetIFurnishingStatusesAction;
use Modules\Inventory\Http\Controllers\Actions\Projects\GetIProjectsGroupedByCityAction;
use Modules\Inventory\Http\Controllers\Actions\Units\GetIUnitsGroupedByCityAction;
use Modules\Inventory\Http\Resources\IProjectResource;
use Modules\Inventory\Http\Resources\IUnitResource;
use Modules\Inventory\IProject;
use Modules\Inventory\IUnit;

use function GuzzleHttp\json_decode;

class HomeController extends Controller
{
    public function features()
    {
        $action = new GetFeaturedProjectsAction;
        $projects = json_decode(json_encode($action->execute()));
        $action = new GetFeaturedUnitsAction;
        $units = json_decode(json_encode($action->execute()));
        $action = new GetMainSlidersAction;
        $sliders = json_decode(json_encode($action->execute()));
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
        $action = new GetFeaturedBlogsAction;
        $blogs = json_decode(json_encode($action->execute()));
        return [
            'projects' => $projects,
            'units' => $units,
            'sliders' => $sliders,
            'bedrooms' => $bedrooms,
            'facilities' => $facilities,
            'amenities' => $amenities,
            'purpose_types' => $purpose_types,
            'developers' => $developers,
            'finishing_types' => $finishing_types,
            'offering_types' => $offering_types,
            'payment_methods' => $payment_methods,
            'purposes' => $purposes,
            'unit_prices_list' => $unit_prices_list,
            'bathrooms' => $bathrooms,
            'furnishing_statuses' => $furnishing_statuses,
            'blogs' => $blogs
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get home page data
        $features = $this->features();

        return view('front.pages.home', $features);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        // Get Abouts
        $action = new GetAboutAction();
        $abouts = json_decode(json_encode($action->execute()));

        return view('front.pages.about', compact('abouts'));
    }

    public function locationSearch($search, FindLocationAction $action)
    {
        // Search Location 
        $location = $action->execute($search);

        return $location;
    }

    public function login()
    {
        // Get Groups
        $action =  new GetGroupsAction;
        $groups = json_decode(json_encode($action->execute()));

        return view('front.pages.login', compact('groups'));
    }

    public function sellProperty()
    {
        // Get home page data
        $features = $this->features();
        $action = new GetFeaturedProjectsAction;
        $projects = json_decode(json_encode($action->execute()));
        $features['projects'] = $projects;
        return view('front.pages.sell_property', $features);
    }

    public function sell(CreateISellRequestRequest $request, CreateISellRequestAction $action)
    {
        // Create sell request
        $i_sell_request = $action->execute($request->except('attachments'), $request->attachments);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Request sent successfully';
        $resp->status = true;
        $resp->data = $i_sell_request;
        return response()->json($resp, 200);
    }

    public function sellThankYou($name)
    {
        return view('front.pages.sell-thank-you', compact('name'));
    }
    public function storeFireMessages(Request $request)
    {
        DB::table('fired_messages')->insert([
            'welcome_message_id' => $request->welcome_message_id,
            'session' => request()->session()->get('_token')
        ]);
    }

    public function thankYou(Request $request)
    {
        $projects = null;
        $units = null;
        $city_id = $request->city_id;
        $position = $request->position;
        $name = $request->name;
        $model_name = '<a href="' . $request->link . '">' . $request->model_name . '</a>';
        /* if (isset($position) && isset($city_id)) {
            switch ($position) {
                case 'project':
                    if ($city_id) {
                        $projects = json_decode(json_encode(IProjectResource::collection(IProject::orderBy('created_at', 'DESC')->take(10)->get())));
                    }
                    break;
                case 'unit':
                    if ($city_id) {
                        $units = json_decode(json_encode(IUnitResource::collection(IUnit::where('city_id', $city_id)->take(10)->get())));
                    }
                    break;

                default:
                    break;
            }
        } */
        $projects = json_decode(json_encode(IProjectResource::collection(IProject::orderBy('created_at', 'DESC')->take(10)->get())));
        return view('front.pages.thank-you', compact('units', 'projects', 'name', 'model_name'));
    }
}
