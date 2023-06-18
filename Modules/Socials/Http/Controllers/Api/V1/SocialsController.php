<?php

namespace Modules\Socials\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Socials\Http\Controllers\Actions\CreateSocialAction;
use Modules\Socials\Http\Controllers\Actions\DeleteSocialAction;
use Modules\Socials\Http\Controllers\Actions\GetSocialsAction;
use Modules\Socials\Http\Controllers\Actions\UpdateSocialAction;
use Modules\Socials\Http\Controllers\Actions\DeleteSocialAttachmentAction;
use Modules\Socials\Http\Requests\CreateSocialRequest;
use Modules\Socials\Http\Requests\DeleteSocialRequest;
use Modules\Socials\Http\Requests\UpdateSocialRequest;
use Modules\Socials\Http\Resources\SocialResource;
use Modules\Socials\Social;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth, Lang;
use App\Language;

class SocialsController extends Controller
{
    /**
     * Store social
     *
     * @param  [string] icon
     * @param  [string] link
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateSocialRequest $request, CreateSocialAction $action)
    {
        // Create the social
        $social = $action->execute($request->except(['translations']), $request->translations);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Social created successfully';
        $resp->status = true;
        $resp->data = $social;
        
        return response()->json($resp, 200);
    }

    /**
     * Update social
     *
     * @param  [integer] id
     * @param  [string] icon
     * @param  [string] link
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateSocialRequest $request, UpdateSocialAction $action)
    {
        // Update the social
        $social = $action->execute($request->input('id'), $request->except(['id', 'translations']), $request->translations);
       
        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Social updated successfully';
        $resp->status = true;
        $resp->data = $social;

        return response()->json($resp, 200);
    }

    /**
     * Delete social
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteSocialRequest $request, DeleteSocialAction $action)
    {
        // Delete the social
        $action->execute($request->input('id'));
       
        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Social deleted successfully';
        $resp->status = true;
        $resp->data = null;

        return response()->json($resp, 200);
    }

    /**
     * Index socials
     * @return Response
     */
    public function index(Request $request, GetSocialsAction $action)
    {
        // Get socials
        $socials = $action->execute();
        
        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Socials retrieved successfully';
        $resp->status = true;
        $resp->data = $socials;

        return response()->json($resp, 200);
    }
}
