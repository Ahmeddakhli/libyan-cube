<?php

namespace Modules\Settings\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Settings\Http\Controllers\Actions\Logos\SearchLogosQueryAction;
use Modules\Settings\Http\Controllers\Actions\Logos\CreateLogoAction;
use Modules\Settings\Http\Controllers\Actions\Logos\DeleteLogoAction;
use Modules\Settings\Http\Controllers\Actions\Logos\UpdateLogoAction;
use Modules\Settings\Http\Requests\Logos\CreateLogoRequest;
use Modules\Settings\Http\Requests\Logos\DeleteLogoRequest;
use Modules\Settings\Http\Requests\Logos\UpdateLogoRequest;
use Modules\Settings\Logo;
use App\Http\Helpers\ServiceResponse;
use Auth, Lang;
use Yajra\Datatables\Datatables;
use App\Language;

class LogosController extends Controller
{
    /**
     * Store logo
     *
     * @param  [string] key
     * @param  [string] type
     * @param  [file] image
     * @return [json] ServiceResponse object
     */
    public function store(CreateLogoRequest $request, CreateLogoAction $action)
    {
        // Create the logo
        $data = [
            'key' => 'logo',
            'type' => $request->type,
            'value' => $request->file('image')->store('/logos', 'public')
        ];
        $logo = $action->execute($data);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Logo created successfully';
        $resp->status = true;
        $resp->data = $logo;
        return response()->json($resp, 200);
    }

    /**
     * Update logo
     *
     * @param  [integer] id
     * @param  [string] key
     * @param  [string] type
     * @param  [file] image 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateLogoRequest $request, UpdateLogoAction $action)
    {
        // Update the logo
        $data = [
            'key' => 'logo',
            'type' => $request->type,
        ];
        if ($request->hasFile('image')) {
            $data['value'] = $request->file('image')->store('/logos', 'public');
        }
        $logo = $action->execute($request->input('id'), $data);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Logo updated successfully';
        $resp->status = true;
        $resp->data = $logo;
        return response()->json($resp, 200);
    }

    /**
     * Delete logo
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteLogoRequest $request, DeleteLogoAction $action)
    {
        // Delete the logo
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Logo deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index logos
     * @return Response
     */
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the logos
            $action = new SearchLogosQueryAction;
            $logos = $action->execute($auth_user, $request);

            return Datatables::of($logos)
                ->addColumn('value', function ($logo) {
                    return $logo->value;
                })
                ->filterColumn('type', function($query, $keyword) {
                    $query->where('type', 'like', '%'.$keyword.'%');
                })
                ->addColumn('created_at', function ($logo) {
                    return $logo->created_at ? $logo->created_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_at', function ($logo) {
                    return $logo->updated_at ? $logo->updated_at->toDateTimeString() : null;
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

            return view('settings::logos.' . $blade_name);
        }
    }

    /**
     * Create logo
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('settings::logos.' . $blade_name, compact('languages'), []);
    }

    public function createLogoModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        return view('settings::logos.modals.create', compact('languages'), [])->render();
    }

    public function updateLogoModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        // Find logo
        $logo = Logo::find($id);

        // If logo does not exist, return error div
        if (!$logo) {
            $error = Lang::get('settings::settings.logo_not_found_or_you_are_not_authorized_to_edit_the_logo');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the languages
        $languages = Language::all();

        return view('settings::logos.modals.update', compact('logo', 'languages'), [])->render();
    }
}
