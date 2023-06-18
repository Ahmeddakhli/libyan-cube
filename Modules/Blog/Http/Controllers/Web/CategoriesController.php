<?php

namespace Modules\Blog\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Blog\Http\Controllers\Actions\Categories\SearchCategoriesQueryAction;
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
use App\Http\Resources\MediaResource;
use Carbon\Carbon;
use Auth, Lang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Yajra\Datatables\Datatables;
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
        $blog_category = $action->execute($request->except(['']));

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
     * Index blog categories 
     * @return Response
     */
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the blog categories
            $action = new SearchCategoriesQueryAction;
            $blog_categorys = $action->execute($auth_user, $request);
            return Datatables::of($blog_categorys)
                ->addColumn('value', function ($blog_category) {
                    return $blog_category->value;
                })
                ->filterColumn('title', function ($query, $keyword) {
                    $query->whereHas('translations', function ($translation) use ($keyword) {
                        $translation->where('title', 'like', '%' . $keyword . '%');
                    });
                })
                ->addColumn('created_at', function ($blog_category) {
                    return $blog_category->created_at ? $blog_category->created_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_at', function ($blog_category) {
                    return $blog_category->updated_at ? $blog_category->updated_at->toDateTimeString() : null;
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
            return view('blog::blog_categories.' . $blade_name);
        }
    }

    /**
     * Create blog category
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('blog::blog_categories.' . $blade_name, compact('languages'), []);
    }

    public function createBlogModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        return view('blog::blog_categories.modals.create', compact('languages'), [])->render();
    }

    public function UpdateBlogModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        // Find blog cate
        $blog_category = BlogCategory::find($id);

        // If blog does not exist, return error div
        if (!$blog_category) {
            $error = Lang::get('blog::blog.blog_category_not_found_or_you_are_not_authorized_to_edit_the_blog_category');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the languages
        $languages = Language::all();

        return view('blog::blog_categories.modals.update', compact('blog_category', 'languages'), [])->render();
    }
}
