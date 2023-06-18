<?php

namespace Modules\ContactUS\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\ContactUS\Http\Controllers\Actions\Contactus\SearchContactUsQueryAction;
use Modules\ContactUS\Http\Controllers\Actions\Contactus\CreateContactUsAction;
use Modules\ContactUS\Http\Controllers\Actions\Contactus\DeleteContactUsAction;
use Modules\ContactUS\Http\Controllers\Actions\Contactus\UpdateContactUsAction;
use Modules\ContactUS\Http\Requests\Contactus\CreateContactUsRequest;
use Modules\ContactUS\Http\Requests\Contactus\DeleteContactUsRequest;
use Modules\ContactUS\Http\Requests\Contactus\UpdateContactUsRequest;
use Modules\ContactUS\ContactUs;
use App\Http\Helpers\ServiceResponse;
use Auth, Lang;
use Yajra\Datatables\Datatables;
use App\Language;
use Modules\ContactUS\Http\Controllers\Actions\Contactus\ReadContactUsAction;
use Modules\Inventory\IProject;

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
        $data = $request->all();
        $contact_us = $action->execute($data);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = trans('contactus::contact_us.thanks_for_message_us');
        $resp->status = true;
        $resp->data = ['redirect_to' => route('front.thankYou', ['city_id' => isset($data['city_id']) ? $data['city_id'] : null, 'position' => isset($data['position']) ? $data['position'] : null,'name'=> $data['full_name'],'model_name' => isset($data['model_name']) ? $data['model_name'] : null,'link' => isset($data['link']) ? $data['link'] : null])];
        
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
     * Delete contact us
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function read(DeleteContactUsRequest $request, ReadContactUsAction $action)
    {
        // Delete the contact us
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Contact us readed successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index contact us
     * @return Response
     */
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search contact us
            $action = new SearchContactUsQueryAction;
            $contact_us = $action->execute($auth_user, $request);

            return Datatables::of($contact_us)
                ->addColumn('created_at', function ($contact_us) {
                    return $contact_us->created_at ? $contact_us->created_at->toDateTimeString() : null;
                })
                ->orderColumn('is_readed', function ($query, $order) {
                    return  $query->orderBy('is_readed', $order);
                })
                ->orderColumn('created_at', function ($query, $order) {
                    return  $query->orderBy('created_at', $order);
                })
                ->filterColumn('created_at', function ($query, $keyword) {
                    return  $query->where('created_at', 'like', '%' . $keyword . '%');
                })
                // ->orderColumn('last_updated_at', function ($query, $order) {
                //     return  $query->orderBy('updated_at', $order);
                // })
                ->make(true);
        } else {
            $blade_name = ($request->ajax() ? 'index-partial' : 'index'); // Handle Partial Return

            return view('contactus::contactus.' . $blade_name);
        }
    }

    /**
     * Index contact us
     * @return Response
     */
    public function indexRequests(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search contact us
            $action = new SearchContactUsQueryAction;
            $contact_us = $action->execute($auth_user, $request)->where('type', 'request_info');

            return Datatables::of($contact_us)
                ->addColumn('created_at', function ($contact_us) {
                    return $contact_us->created_at ? $contact_us->created_at->toDateTimeString() : null;
                })
                ->orderColumn('created_at', function ($query, $order) {
                    return  $query->orderBy('created_at', $order);
                })
                ->orderColumn('name', function ($query, $order) {
                    return  $query->orderBy('full_name', $order);
                })
                // ->orderColumn('last_updated_at', function ($query, $order) {
                //     return  $query->orderBy('updated_at', $order);
                // })
                ->make(true);
        } else {
            $blade_name = ($request->ajax() ? 'index-partial' : 'index'); // Handle Partial Return

            return view('contactus::requests.' . $blade_name);
        }
    }

    /**
     * Create contact us
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('contactus::contactus.' . $blade_name, compact('languages'), []);
    }

    public function createContactUsModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        return view('contactus::contactus.create', compact('languages'), [])->render();
    }

    public function UpdateContactUsModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        // Find contact us 
        $contact_us = ContactUs::find($id);

        // If ContactUs does not exist, return error div
        if (!$contact_us) {
            $error = Lang::get('contactus::contact_us.contact_us_not_found_or_you_are_not_authorized_to_edit_contact_us');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the languages
        $languages = Language::all();

        return view('contactus::contactus.modals.update', compact('contact_us', 'languages'), [])->render();
    }
}
