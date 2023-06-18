<?php

namespace Modules\Settings\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Settings\Http\Controllers\Actions\FooterLinks\CreateFooterLinkAction;
use Modules\Settings\Http\Controllers\Actions\FooterLinks\DeleteFooterLinkAction;
use Modules\Settings\Http\Controllers\Actions\FooterLinks\GetFooterLinksAction;
use Modules\Settings\Http\Controllers\Actions\FooterLinks\UpdateFooterLinkAction;
use Modules\Settings\Http\Requests\FooterLinks\CreateFooterLinkRequest;
use Modules\Settings\Http\Requests\FooterLinks\DeleteFooterLinkRequest;
use Modules\Settings\Http\Requests\FooterLinks\UpdateFooterLinkRequest;
use App\Http\Helpers\ServiceResponse;

class FooterLinksController extends Controller
{
    /**
     * Store footer link
     *
     * @param  [string] link
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateFooterLinkRequest $request, CreateFooterLinkAction $action)
    {
        // Create the footer link
        $footer_link = $action->execute($request->all(), $request->translations);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Footer link created successfully';
        $resp->status = true;
        $resp->data = $footer_link;
        return response()->json($resp, 200);
    }

    /**
     * Update footer link
     *
     * @param  [integer] id
     * @param  [string] link
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateFooterLinkRequest $request, UpdateFooterLinkAction $action)
    {
        // Update the footer link
        $footer_link = $action->execute($request->input('id'), $request->except('id'), $request->translations);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Footer link updated successfully';
        $resp->status = true;
        $resp->data = $footer_link;
        return response()->json($resp, 200);
    }

    /**
     * Delete footer link
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteFooterLinkRequest $request, DeleteFooterLinkAction $action)
    {
        // Delete the footer link
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Footer link deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index footer links
     * @return Response
     */
    public function index(Request $request, GetFooterLinksAction $action)
    {
        // Delete footer links
        $footer_links =  $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Footer links retrieved successfully';
        $resp->status = true;
        $resp->data = $footer_links;
        return response()->json($resp, 200);
    }
}
