<?php

namespace Modules\Settings\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Settings\Http\Controllers\Actions\HowWorks\SearchHowWorksQueryAction;
use Modules\Settings\Http\Controllers\Actions\HowWorks\CreateHowWorkAction;
use Modules\Settings\Http\Controllers\Actions\HowWorks\DeleteHowWorkAction;
use Modules\Settings\Http\Controllers\Actions\HowWorks\UpdateHowWorkAction;
use Modules\Settings\Http\Requests\HowWorks\CreateHowWorkRequest;
use Modules\Settings\Http\Requests\HowWorks\DeleteHowWorkRequest;
use Modules\Settings\Http\Requests\HowWorks\UpdateHowWorkRequest;
use Modules\Settings\Http\Resources\HowWorkResource;
use Modules\Settings\HowWork;
use App\Http\Helpers\ServiceResponse;
use App\Http\Resources\MediaResource;
use Carbon\Carbon;
use Auth, Lang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Yajra\Datatables\Datatables;
use App\Language;

class HowWorksController extends Controller
{
    /**
     * Store how work
     * 
     * @param  [file] image
     * @param  [string] link
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateHowWorkRequest $request, CreateHowWorkAction $action)
    {
        // Create the how work
        $data = [
            'link' => $request->link,
        ];
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('/how_works', 'public');
        }
        $how_work = $action->execute($data, $request->translations);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'How work created successfully';
        $resp->status = true;
        $resp->data = $how_work;
        return response()->json($resp, 200);
    }

    /**
     * Update how work
     *
     * @param  [integer] id
     * @param  [file] image
     * @param  [string] link
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateHowWorkRequest $request, UpdateHowWorkAction $action)
    {
        // Update the how work
        $data = [
            'link' => $request->link,
        ];
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('/how_works', 'public');
        }
        $how_work = $action->execute($request->input('id'), $data, $request->translations);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'How work updated successfully';
        $resp->status = true;
        $resp->data = $how_work;
        return response()->json($resp, 200);
    }

    /**
     * Delete how work
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteHowWorkRequest $request, DeleteHowWorkAction $action)
    {
        // Delete the how work
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'How work deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index how works
     *
     * @return Response
     */
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the how works
            $action = new SearchHowWorksQueryAction;
            $how_works = $action->execute($auth_user, $request);
            
            return Datatables::of($how_works)
                ->addColumn('value', function ($how_work) {
                    return $how_work->value ? $how_work->value : $how_work->default_value;
                })
                ->filterColumn('value', function ($query, $keyword) {
                    $query->whereHas('translations', function ($translation) use ($keyword) {
                        $translation->where('title', 'like', '%' . $keyword . '%');
                    });
                })
                ->addColumn('created_at', function ($how_work) {
                    return $how_work->created_at ? $how_work->created_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_at', function ($how_work) {
                    return $how_work->updated_at ? $how_work->updated_at->toDateTimeString() : null;
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

            return view('settings::how_works.' . $blade_name);
        }
    }

    /**
     * Create how work
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

        return view('settings::how_works.' . $blade_name, compact('languages'), []);
    }

    public function createHowWorkModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        return view('settings::how_works.modals.create', compact('languages'), [])->render();
    }

    public function updateHowWorkModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        $how_work = HowWork::find($id);

        // If how work does not exist, return error div
        if (!$how_work) {
            $error = Lang::get('settings::settings.howwork_not_found_or_you_are_not_authorized_to_edit_the_howwork');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the languages
        $languages = Language::all();

        return view('settings::how_works.modals.update', compact('how_work', 'languages'), [])->render();
    }
}
