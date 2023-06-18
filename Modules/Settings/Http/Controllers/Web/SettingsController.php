<?php

namespace Modules\Settings\Http\Controllers\Web;

use App\Http\Helpers\ServiceResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Settings\Http\Controllers\Actions\Settings\UpdateSettingAction;
use Modules\Settings\Http\Requests\Settings\UpdateSettingRequest;
use Modules\Settings\Setting;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('settings::settings.settings');
    }

    public function mainSettingsIndex()
    {
        $setting = Setting::where('id',1)->first();
        return view('settings::main_settings.index-partial',compact('setting'));
    }
    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('settings::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('settings::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('settings::edit');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
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

}
