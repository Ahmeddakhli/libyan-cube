<?php

namespace Modules\Settings\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Settings\Http\Controllers\Actions\Logos\CreateLogoAction;
use Modules\Settings\Http\Controllers\Actions\Logos\DeleteLogoAction;
use Modules\Settings\Http\Controllers\Actions\Logos\GetLogosAction;
use Modules\Settings\Http\Controllers\Actions\Logos\UpdateLogoAction;
use Modules\Settings\Http\Requests\Logos\CreateLogoRequest;
use Modules\Settings\Http\Requests\Logos\DeleteLogoRequest;
use Modules\Settings\Http\Requests\Logos\UpdateLogoRequest;
use App\Http\Helpers\ServiceResponse;

class LogosController extends Controller
{
    /**
     * Store logo
     *
     * @param  [string] key
     * @param  [file] image
     * @param  [string] type 
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
     * @param  [file] image
     * @param  [string] type 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateLogoRequest $request, UpdateLogoAction $action)
    {
        // Update the logo
        $data = [
            'key' => 'logo',
            'type' => $request->type,
            'value' => $request->file('image')->store('/logos', 'public')
        ];
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
    public function index(Request $request, GetLogosAction $action)
    {
        // Get logos
        $logos = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Logos retrieved successfully';
        $resp->status = true;
        $resp->data = $logos;
        return response()->json($resp, 200);
    }
}
