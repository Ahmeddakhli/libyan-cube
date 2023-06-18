<?php

namespace Modules\Blog\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Blog\Http\Controllers\Actions\Blog\CreateBlogAction;
use Modules\Blog\Http\Controllers\Actions\Blog\DeleteBlogAction;
use Modules\Blog\Http\Controllers\Actions\Blog\GetBlogsAction;
use Modules\Blog\Http\Controllers\Actions\Blog\UpdateBlogAction;
use Modules\Blog\Http\Requests\Blog\CreateBlogRequest;
use Modules\Blog\Http\Requests\Blog\DeleteBlogRequest;
use Modules\Blog\Http\Requests\Blog\GetBlogsRequest;
use Modules\Blog\Http\Requests\Blog\UpdateBlogRequest;
use Modules\Blog\Http\Resources\BlogResource;
use Modules\Blog\Blog;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth, Lang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Language;

class BlogsController extends Controller
{
    /**
     * Store blog
     *
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateBlogRequest $request, CreateBlogAction $action)
    {
        // Create the blog
        $blog = $action->execute($request->except(['attachments']), $request->attachments);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Blog created successfully';
        $resp->status = true;
        $resp->data = $blog;
        return response()->json($resp, 200);
    }
    /**
     * Update blog
     *
     * @param  [integer] id
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateBlogRequest $request, UpdateBlogAction $action)
    {
        // Update the blog
        $blog = $action->execute($request->input('id'), $request->except(['id', 'attachments']), $request->attachments);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Blog updated successfully';
        $resp->status = true;
        $resp->data = $blog;
        return response()->json($resp, 200);
    }
    /**
     * Delete blog
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteBlogRequest $request, DeleteBlogAction $action)
    {
        // Delete the blog
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Blog deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index blogs
     * @return Response
     */
    public function index(Request $request, GetBlogsAction $action)
    {
        // Get the blogs
        $blogs = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Blog retrieved successfully';
        $resp->status = true;
        $resp->data = $blogs;
        return response()->json($resp, 200);
    }
}
