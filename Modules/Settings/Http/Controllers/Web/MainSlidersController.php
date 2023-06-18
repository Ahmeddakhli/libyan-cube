<?php

namespace Modules\Settings\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Settings\Http\Controllers\Actions\MainSliders\SearchMainSlidersQueryAction;
use Modules\Settings\Http\Controllers\Actions\MainSliders\CreateMainSliderAction;
use Modules\Settings\Http\Controllers\Actions\MainSliders\DeleteMainSliderAction;
use Modules\Settings\Http\Controllers\Actions\MainSliders\UpdateMainSliderAction;
use Modules\Settings\Http\Requests\MainSliders\CreateMainSliderRequest;
use Modules\Settings\Http\Requests\MainSliders\DeleteMainSliderRequest;
use Modules\Settings\Http\Requests\MainSliders\UpdateMainSliderRequest;
use Modules\Settings\Http\Resources\MainSliderResource;
use Modules\Settings\MainSlider;
use App\Http\Helpers\ServiceResponse;
use App\Http\Resources\MediaResource;
use Carbon\Carbon;
use Auth, Lang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Yajra\Datatables\Datatables;
use App\Language;

class MainSlidersController extends Controller
{
    /**
     * Store main slider
     * 
     * @param  [file] image
     * @param  [string] link
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateMainSliderRequest $request, CreateMainSliderAction $action)
    {
        // Create the main slider
        $data = [
            'link' => $request->link,
        ];
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('/mainsliders', 'public');
        }
        $main_slider = $action->execute($data, $request->translations);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Main slider created successfully';
        $resp->status = true;
        $resp->data = $main_slider;
        return response()->json($resp, 200);
    }

    /**
     * Update main slider
     *
     * @param  [integer] id
     * @param  [file] image
     * @param  [string] link
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateMainSliderRequest $request, UpdateMainSliderAction $action)
    {
        // Update the main slider
        $data = [
            'link' => $request->link,
        ];
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('/mainsliders', 'public');
        }
        $main_slider = $action->execute($request->input('id'), $data, $request->translations);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Main slider updated successfully';
        $resp->status = true;
        $resp->data = $main_slider;
        return response()->json($resp, 200);
    }

    /**
     * Delete main slider
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteMainSliderRequest $request, DeleteMainSliderAction $action)
    {
        // Delete the main slider
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Main slider deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index main sliders
     *
     * @return Response
     */
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the main sliders
            $action = new SearchMainSlidersQueryAction;
            $main_sliders = $action->execute($auth_user, $request);
            
            return Datatables::of($main_sliders)
                ->addColumn('value', function ($main_slider) {
                    return $main_slider->value;
                })
                ->filterColumn('value', function ($query, $keyword) {
                    $query->whereHas('translations', function ($translation) use ($keyword) {
                        $translation->where('title', 'like', '%' . $keyword . '%');
                    });
                })
                ->addColumn('created_at', function ($main_slider) {
                    return $main_slider->created_at ? $main_slider->created_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_at', function ($main_slider) {
                    return $main_slider->updated_at ? $main_slider->updated_at->toDateTimeString() : null;
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

            return view('settings::main_sliders.' . $blade_name);
        }
    }

    /**
     * Create main slider
     *
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('settings::main_sliders.' . $blade_name, compact('languages'), []);
    }

    public function createMainSliderModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        return view('settings::main_sliders.modals.create', compact('languages'), [])->render();
    }

    public function updateMainSliderModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        $main_slider = MainSlider::find($id);

        // If main slider does not exist, return error div
        if (!$main_slider) {
            $error = Lang::get('settings::settings.mainslider_not_found_or_you_are_not_authorized_to_edit_the_mainslider');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the languages
        $languages = Language::all();

        return view('settings::main_sliders.modals.update', compact('main_slider', 'languages'), [])->render();
    }
}
