<?php

namespace Modules\Blog\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Blog\Http\Controllers\Actions\Categories\CreateCategoryAction;
use Modules\Blog\Http\Controllers\Actions\Categories\DeleteCategoryAction;
use Modules\Blog\Http\Controllers\Actions\Categories\GetCategoriesAction;
use Modules\Blog\Http\Controllers\Actions\Categories\UpdateCategoryAction;
use Modules\Blog\Http\Requests\Categories\CreateCategoryRequest;
use Modules\Blog\Http\Requests\Categories\DeleteCategoryRequest;
use Modules\Blog\Http\Requests\Categories\GetCategoriesRequest;
use Modules\Blog\Http\Requests\Categories\UpdateCategoryRequest;
use Modules\Blog\Http\Resources\BlogCategoryResource;
use Modules\Blog\BlogCategory;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth, Lang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Language;

class CategoriesController extends Controller
{
    /**
     * Store blog category
     *
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function store(CreateCategoryRequest $request, CreateCategoryAction $action)
    {
        // Create the blog category
        $blog_category = $action->execute($request->except([]));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Blog category created successfully';
        $resp->status = true;
        $resp->data = $blog_category;
        return response()->json($resp, 200);
    }
    /**
     * Update blog category
     *
     * @param  [integer] id
     * @param  [integer] order
     * @param  [array] translations 
     * @return [json] ServiceResponse object
     */
    public function update(UpdateCategoryRequest $request, UpdateCategoryAction $action)
    {
        // Update the blog category
        $blog_category = $action->execute($request->input('id'), $request->except(['id']));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Blog category updated successfully';
        $resp->status = true;
        $resp->data = $blog_category;
        return response()->json($resp, 200);
    }
    /**
     * Delete blog category
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteCategoryRequest $request, DeleteCategoryAction $action)
    {
        // Delete the blog category
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Blog category deleted successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index blogs
     * @return Response
     */
    public function index(Request $request, GetCategoriesAction $action)
    {
        // Get the blog categories
        $blog_categorys = $action->execute();

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Blog categories retrieved successfully';
        $resp->status = true;
        $resp->data = $blog_categorys;
        return response()->json($resp, 200);
    }
}
