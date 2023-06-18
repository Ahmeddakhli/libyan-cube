<?php

namespace App\Http\Controllers\Web\Front;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ServiceResponse;
use Illuminate\Http\Request;
use Modules\ContactUS\Http\Controllers\Actions\Subscribes\CreateSubscribeAction;
use Modules\ContactUS\Http\Requests\Subscribes\CreateSubscribeRequest;
use Modules\Settings\Http\Controllers\Actions\Contacts\GetContactsAction;
use Modules\Settings\Http\Controllers\Actions\Branches\GetBranchesAction;
use Modules\About\Http\Controllers\Actions\GetAboutAction;
use Modules\Settings\Http\Controllers\Actions\Contacts\GetFrontContactsAction;

class ContactUsController extends Controller
{
    public function features()
    {
        return [];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $action =  new GetFrontContactsAction;
        $contacts = json_decode(json_encode($action->execute()));

        $action =  new GetBranchesAction;
        $branches = json_decode(json_encode($action->execute()));

        $action = new GetAboutAction;
        $about_sections = json_decode(json_encode($action->execute()));

        $features = $this->features();
        $features['contacts'] = $contacts;
        $features['branches'] = $branches;
        $features['about_sections'] = $about_sections;

        return view('front.pages.contact_us', $features);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subscribe(CreateSubscribeRequest $request, CreateSubscribeAction $action)
    {
        $subscribe = $action->execute($request->except('_token'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = trans('contactus::contact_us.thanks_for_message_us');
        $resp->status = true;
        $resp->data = $subscribe;
        return response()->json($resp, 200);
    }
}
