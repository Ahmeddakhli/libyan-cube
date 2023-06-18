<?php

namespace Modules\Tags\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Tags\Http\Requests\CreateTagRequest;
use Modules\Tags\Http\Requests\UpdateTagRequest;
use Modules\Tags\Http\Requests\DeleteTagRequest;
use Modules\Tags\Http\Controllers\Actions\CreateTagAction;
use Modules\Tags\Http\Controllers\Actions\UpdateTagAction;
use Modules\Tags\Http\Controllers\Actions\DeleteTagAction;
use Modules\Tags\Http\Controllers\Actions\SearchTagsQueryAction;
use Modules\Tags\Tag;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth, Lang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Yajra\Datatables\Datatables;
use App\Language;

class TagsController extends Controller
{
    /**
     * Create tag
     *
     * @param  [string] tag
     * @return [json] ServiceResponse object
     */
    public function store(CreateTagRequest $request, CreateTagAction $action)
    {
        // Create the tag
        $tag = $action->execute($request->all());

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Tag created successfully';
        $resp->status = true;
        $resp->data = $tag;
        return response()->json($resp, 200);
    }

    /**
     * Update tag
     *
     * @param  [integer] id
     * @param  [string] tag
     * @return [json] ServiceResponse object
     */
    public function update(UpdateTagRequest $request, UpdateTagAction $action)
    {
        // Update the tag
        $tag = $action->execute($request->input('id'), $request->except(['id']));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Tag updated successfully';
        $resp->status = true;
        $resp->data = $tag;
        return response()->json($resp, 200);
    }

    /**
     * Delete tag
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteTagRequest $request, DeleteTagAction $action)
    {
        // Delete the tag
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Tag deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index tagss
     * @return Response
     */
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the tags
            $action = new SearchTagsQueryAction;
            $tags = $action->execute($auth_user, $request);
            return Datatables::of($tags)
                ->addColumn('created_at', function($tag) {
                    return $tag->created_at ? $tag->created_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_at', function($tag) {
                    return $tag->updated_at ? $tag->updated_at->toDateTimeString() : null;
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

            return view('tags::tags.'.$blade_name, []);
        }
    }

    /**
     * Create tag
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('tags::tags.'.$blade_name, []);
    }

    public function createTagModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        return view('tags::tags.modals.create', [])->render();
    }

    public function updateTagModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        $tag = Tag::find($id);

        // If tag does not exist, return error div
        if (!$tag) {
            $error = Lang::get('tags::tags.tag_not_found_or_you_are_not_authorized_to_edit_the_tag');
            return view('dashboard.components.error', compact('error'))->render();
        }

        return view('tags::tags.modals.update', compact('tag'), [])->render();
    }
}
