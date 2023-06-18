<?php

namespace Modules\ContactUS\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\ContactUS\Http\Controllers\Actions\Contactus\CreateContactUsAction;
use Modules\ContactUS\Http\Controllers\Actions\Contactus\DeleteContactUsAction;
use Modules\ContactUS\Http\Controllers\Actions\Contactus\UpdateContactUsAction;
use Modules\ContactUS\Http\Controllers\Actions\Contactus\GetContactUSAction;
use Modules\ContactUS\Http\Requests\Contactus\CreateContactUsRequest;
use Modules\ContactUS\Http\Requests\Contactus\DeleteContactUsRequest;
use Modules\ContactUS\Http\Requests\Contactus\UpdateContactUsRequest;
use Modules\ContactUS\ContactUs;
use App\Http\Helpers\ServiceResponse;
use Auth, Lang;
use App\Language;

class ContactUSController extends Controller
{
    /**
     * Store contact us
     *
     * @param  [string] full_name
     * @param  [string] phone
     * @param  [string] email
     * @param  [string] message
     * @param  [string] link
     * @param  [date] best_time_to_call_from
     * @param  [date] best_time_to_call_to
     * @return [json] ServiceResponse object
     */
    public function store(CreateContactUsRequest $request, CreateContactUsAction $action)
    {
        // Create the contact us
        $contact_us = $action->execute($request->all());

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Thanks for reaching us.';
        $resp->status = true;
        $resp->data = $contact_us;
        return response()->json($resp, 200);
    }

    /**
     * Update contact us
     *
     * @param  [integer] id
     * @param  [string] full_name
     * @param  [string] phone
     * @param  [string] email
     * @param  [string] message
     * @param  [string] link
     * @param  [date] best_time_to_call_from
     * @param  [date] best_time_to_call_to
     * @return [json] ServiceResponse object
     */
    public function update(UpdateContactUsRequest $request, UpdateContactUsAction $action)
    {
        // Update the contact us
        $contact_us = $action->execute($request->input('id'), $request->except(['id']));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Contact us updated successfully';
        $resp->status = true;
        $resp->data = $contact_us;
        return response()->json($resp, 200);
    }

    /**
     * Delete contact us
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteContactUsRequest $request, DeleteContactUsAction $action)
    {
        // Delete the contact us
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Contact us deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index contact us
     * @return Response
     */
    public function index(Request $request, GetContactUSAction $action)
    {
        // Get contact us
        $contact_us = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Contact us retrieved successfully';
        $resp->status = true;
        $resp->data = $contact_us;
        return response()->json($resp, 200);
    }
}
