<?php

namespace Modules\Settings\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Settings\Http\Controllers\Actions\Contacts\SearchContactsQueryAction;
use Modules\Settings\Http\Controllers\Actions\Contacts\CreateContactAction;
use Modules\Settings\Http\Controllers\Actions\Contacts\DeleteContactAction;
use Modules\Settings\Http\Controllers\Actions\Contacts\UpdateContactAction;
use Modules\Settings\Http\Requests\Contacts\CreateContactRequest;
use Modules\Settings\Http\Requests\Contacts\DeleteContactRequest;
use Modules\Settings\Http\Requests\Contacts\UpdateContactRequest;
use Modules\Settings\Contact;
use App\Http\Helpers\ServiceResponse;
use Auth, Lang;
use Yajra\Datatables\Datatables;
use App\Language;

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
        $contact = $action->execute($request->input('id'),$request->except('id'));

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
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the contacts
            $action = new SearchContactsQueryAction;
            $contacts = $action->execute($auth_user, $request);

            return Datatables::of($contacts)
                ->addColumn('value', function ($contact) {
                    return $contact->value;
                })
                ->filterColumn('value', function($query, $keyword) {
                    $query->where('type', 'like', '%'.$keyword.'%')->orWhere('value', 'like', '%'.$keyword.'%');
                })
                ->addColumn('created_at', function ($contact) {
                    return $contact->created_at ? $contact->created_at->toDateTimeString()  : null;
                })
                ->addColumn('last_updated_at', function ($contact) {
                    return $contact->updated_at ? $contact->updated_at->toDateTimeString() : null;
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

            return view('settings::contacts.' . $blade_name);
        }
    }

    /**
     * Create contact
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('settings::contacts.' . $blade_name, compact('languages'), []);
    }

    public function createContactModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        return view('settings::contacts.modals.create', compact('languages'), [])->render();
    }

    public function updateContactModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        $contact = Contact::find($id);
        // If contact does not exist, return error div
        if (!$contact) {
            $error = Lang::get('settings::settings.contact_not_found_or_you_are_not_authorized_to_edit_the_contact');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the languages
        $languages = Language::all();

        return view('settings::contacts.modals.update', compact('contact', 'languages'), [])->render();
    }
}
