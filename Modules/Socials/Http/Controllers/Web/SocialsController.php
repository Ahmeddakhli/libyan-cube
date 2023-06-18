<?php

namespace Modules\Socials\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Socials\Http\Controllers\Actions\SearchSocialsQueryAction;
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
use App\Http\Resources\MediaResource;
use Carbon\Carbon;
use Auth, Lang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Yajra\Datatables\Datatables;
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
        $social = $action->execute($request->input('id'), $request->except(['id', 'attachments']), $request->translations, $request->attachments);

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
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {

            // Search the socials
            $action = new SearchSocialsQueryAction;
            $socials = $action->execute($auth_user, $request);

            return Datatables::of($socials)
                ->addColumn('value', function ($social) {
                    return $social->value;
                })
                ->filterColumn('value', function ($query, $keyword) {
                    $query->whereHas('translations', function ($translation) use ($keyword) {
                        $translation->where('title', 'like', '%' . $keyword . '%');
                    });
                })
                ->addColumn('created_at', function ($social) {
                    return $social->created_at ? $social->created_at->toDateTimeString() : '';
                })
                ->addColumn('last_updated_at', function ($social) {
                    return $social->created_at ? $social->updated_at->toDateTimeString() : '';
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

            return view('socials::socials.' . $blade_name);
        }
    }

    /**
     * Create social
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('socials::socials.' . $blade_name, compact('languages'), []);
    }

    public function createSocialModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        return view('socials::socials.modals.create', compact('languages'), [])->render();
    }

    public function UpdateSocialModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        $social = Social::find($id);

        // If social does not exist, return error div
        if (!$social) {
            $error = Lang::get('socials::social.social_not_found_or_you_are_not_authorized_to_edit_the_social');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the languages
        $languages = Language::all();

        return view('socials::socials.modals.update', compact('social', 'languages'), [])->render();
    }

    public function deleteAttachments(Request $request, DeleteSocialAttachmentAction $action)
    {
        // Delete social  
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Social attachment deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }
}
