<?php

namespace Modules\Settings\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Settings\Http\Controllers\Actions\Contacts\CreateContactAction;
use Modules\Settings\Http\Controllers\Actions\Contacts\DeleteContactAction;
use Modules\Settings\Http\Controllers\Actions\Contacts\GetContactsAction;
use Modules\Settings\Http\Controllers\Actions\Contacts\UpdateContactAction;
use Modules\Settings\Http\Requests\Contacts\CreateContactRequest;
use Modules\Settings\Http\Requests\Contacts\DeleteContactRequest;
use Modules\Settings\Http\Requests\Contacts\UpdateContactRequest;
use App\Http\Helpers\ServiceResponse;

class ContactsController extends Controller
{
    /**
     * Store contact
     *
     * @param  [string] type
     * @param  [string] value 
     * @return [json] ServiceResponse object
     */
    public function store(CreateContactRequest $request, CreateContactAction $action)
    {
        // Create the contact
        $contact = $action->execute($request->all());

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Contact created successfully';
        $resp->status = true;
        $resp->data = $contact;
        return response()->json($resp, 200);
    }

    /**
     * Update contact
     *
     * @param  [integer] id
     * @param  [string] type
     * @param  [string] value 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateContactRequest $request, UpdateContactAction $action)
    {
        // Update the contact
        $contact = $action->execute($request->input('id'), $request->except('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Contact updated successfully';
        $resp->status = true;
        $resp->data = $contact;
        return response()->json($resp, 200);
    }

    /**
     * Delete contact
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteContactRequest $request, DeleteContactAction $action)
    {
        // Delete the contact
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Contact deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index contacts
     * @return Response
     */
    public function index(Request $request, GetContactsAction $action)
    {
        // Get contact
        $contacts = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Contacts retrieved successfully';
        $resp->status = true;
        $resp->data = $contacts;
        return response()->json($resp, 200);
    }
}
