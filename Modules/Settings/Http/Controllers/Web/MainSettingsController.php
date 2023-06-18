<?php

namespace Modules\Settings\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Settings\Http\Controllers\Actions\Settings\SearchSettingsQueryAction;
use Modules\Settings\Http\Controllers\Actions\Settings\CreateSettingAction;
use Modules\Settings\Http\Controllers\Actions\Settings\DeleteSettingAction;
use Modules\Settings\Http\Controllers\Actions\Settings\UpdateSettingAction;
use Modules\Settings\Http\Requests\Settings\CreateSettingRequest;
use Modules\Settings\Http\Requests\Settings\DeleteSettingRequest;
use Modules\Settings\Http\Requests\Settings\UpdateSettingRequest;
use Modules\Settings\Setting;
use App\Http\Helpers\ServiceResponse;
use Auth, Lang;
use Yajra\Datatables\Datatables;
use App\Language;

class MainSettingsController extends Controller
{
    /**
     * Store setting
     *
     * @param  [string] type
     * @param  [string] value 
     * @return [json] ServiceResponse object
     */
    public function store(CreateSettingRequest $request, CreateSettingAction $action)
    {
        // Create the setting
        $request->all() = [
            'type' => $request->type,
            'value' => $request->value
        ];
        $setting = $action->execute($request->all());

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Setting created successfully';
        $resp->status = true;
        $resp->data = $setting;
        return response()->json($resp, 200);
    }

    /**
     * Update setting
     *
     * @param  [integer] id
     * @param  [string] type
     * @param  [string] value 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateSettingRequest $request, UpdateSettingAction $action)
    {
        // Update the setting
        $setting = $action->execute($request->input('id'),$request->except(['id']));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Setting updated successfully';
        $resp->status = true;
        $resp->data = $setting;
        return response()->json($resp, 200);
    }

    /**
     * Delete setting
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteSettingRequest $request, DeleteSettingAction $action)
    {
        // Delete the setting
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Setting deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index settings
     * @return Response
     */
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the settings
            $action = new SearchSettingsQueryAction;
            $settings = $action->execute($auth_user, $request);

            return Datatables::of($settings)
                ->addColumn('value', function ($setting) {
                    return $setting->value;
                })
                ->filterColumn('value', function($query, $keyword) {
                    $query->where('type', 'like', '%'.$keyword.'%')->orWhere('value', 'like', '%'.$keyword.'%');
                })
                ->addColumn('created_at', function ($setting) {
                    return $setting->created_at ? $setting->created_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_at', function ($setting) {
                    return $setting->updated_at ? $setting->updated_at->toDateTimeString() : null;
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

            return view('settings::settings.' . $blade_name);
        }
    }

    /**
     * Create setting
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('settings::settings.' . $blade_name, compact('languages'), []);
    }

    public function createSettingModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        return view('settings::settings.modals.create', compact('languages'), [])->render();
    }

    public function updateSettingModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        $setting = Setting::find($id);
        // If setting does not exist, return error div
        if (!$setting) {
            $error = Lang::get('settings::settings.setting_not_found_or_you_are_not_authorized_to_edit_the_setting');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the languages
        $languages = Language::all();

        return view('settings::settings.modals.update', compact('setting', 'languages'), [])->render();
    }
}
