<?php

namespace Modules\Tags\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth;
use Modules\Tags\Http\Requests\CreateTagRequest;
use Modules\Tags\Http\Requests\UpdateTagRequest;
use Modules\Tags\Http\Requests\GetTagsRequest;
use Modules\Tags\Http\Requests\DeleteTagRequest;
use Modules\Tags\Http\Controllers\Actions\CreateTagAction;
use Modules\Tags\Http\Controllers\Actions\UpdateTagAction;
use Modules\Tags\Http\Controllers\Actions\GetTagsAction;
use Modules\Tags\Http\Controllers\Actions\DeleteTagAction;

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
     * Index tags
     *
     * @return [json] ServiceResponse object
     */
    public function index(GetTagsRequest $request, GetTagsAction $action)
    {
        // Get tags
        $tags = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Tags retrieved successfully';
        $resp->status = true;
        $resp->data = $tags;
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
}
