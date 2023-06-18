<?php

namespace Modules\Settings\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Settings\Http\Controllers\Actions\FooterLinks\SearchFooterLinksQueryAction;
use Modules\Settings\Http\Controllers\Actions\FooterLinks\CreateFooterLinkAction;
use Modules\Settings\Http\Controllers\Actions\FooterLinks\DeleteFooterLinkAction;
use Modules\Settings\Http\Controllers\Actions\FooterLinks\UpdateFooterLinkAction;
use Modules\Settings\Http\Requests\FooterLinks\CreateFooterLinkRequest;
use Modules\Settings\Http\Requests\FooterLinks\DeleteFooterLinkRequest;
use Modules\Settings\Http\Requests\FooterLinks\UpdateFooterLinkRequest;
use Modules\Settings\FooterLink;
use App\Http\Helpers\ServiceResponse;
use Auth, Lang;
use Yajra\Datatables\Datatables;
use App\Language;

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
     * Index footerlinks
     * @return Response
     */
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the footerlinks
            $action = new SearchFooterLinksQueryAction;
            $footer_links = $action->execute($auth_user, $request);
            
            return Datatables::of($footer_links)
                ->addColumn('value', function ($footer_link) {
                    return $footer_link->value ? $footer_link->value : $footer_link->default_value;
                })
                ->filterColumn('value', function($query, $keyword) {
                    $query->whereHas('translations', function($translation) use ($keyword) {
                        $translation->where('title', 'like', '%'.$keyword.'%');
                    });
                })
                ->addColumn('created_at', function ($footer_link) {
                    return $footer_link->created_at ? $footer_link->created_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_at', function ($footer_link) {
                    return $footer_link->updated_at ? $footer_link->updated_at->toDateTimeString() : null;
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

            return view('settings::footer_links.' . $blade_name);
        }
    }

    /**
     * Create footerlink
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('settings::footer_links.' . $blade_name, compact('languages'), []);
    }

    public function createFooterLinkModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        return view('settings::footer_links.modals.create', compact('languages'), [])->render();
    }

    public function UpdateFooterLinkModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        $footer_link = FooterLink::find($id);

        // If footer link does not exist, return error div
        if (!$footer_link) {
            $error = Lang::get('settings::settings.footer_link_not_found_or_you_are_not_authorized_to_edit_the_footer_link');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the languages
        $languages = Language::all();

        return view('settings::footer_links.modals.update', compact('footer_link', 'languages'), [])->render();
    }
}
