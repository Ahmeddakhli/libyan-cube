<?php

namespace Modules\Blog\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Blog\Http\Controllers\Actions\Blog\SearchBlogsQueryAction;
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
use App\Http\Resources\MediaResource;
use Carbon\Carbon;
use Auth, Lang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Yajra\Datatables\Datatables;
use App\Language;
use Modules\Blog\BlogCategory;

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
        $resp->message = trans('blog::blog.blog_created_sucessfully');
        $resp->status = true;
        switch ($request->creation_type) {
            case 'save_continue':
                $resp->data = ['redirect_to' => route('blogs.modals.update', ['id' => $blog->id]), 'blog' => $blog];
                break;
            case 'save_only':
                $resp->data = ['redirect_to' => route('blogs.index'), 'blog' => $blog];
                break;
            default:
                # code...
                break;
        }
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
        $resp->message = trans('blog::blog.blog_updated_sucessfully');
        $resp->status = true;
        switch ($request->creation_type) {
            case 'save_continue':
                $resp->data = ['redirect_to' => route('blogs.modals.update', ['id' => $blog->id]), 'blog' => $blog];
                break;
            case 'save_only':
                $resp->data = ['redirect_to' => route('blogs.index'), 'blog' => $blog];
                break;
            default:
                # code...
                break;
        }
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
        $resp->message = trans('blog::blog.blog_deleted_sucessfully');
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Index blogs
     * @return Response
     */
    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            // Search the I_blogs
            $action = new SearchBlogsQueryAction;
            $blogs = $action->execute($auth_user, $request);
            return Datatables::of($blogs)
                ->addColumn('value', function ($blog) {
                    return $blog->value;
                })
                ->filterColumn('title', function ($query, $keyword) {
                    $query->whereHas('translations', function ($translation) use ($keyword) {
                        $translation->where('title', 'like', '%' . $keyword . '%');
                    });
                })
                ->orderColumn('value', function ($query, $order) {
                    return $query->with(['translations' => function ($translation) use ($order) {
                        $translation->orderBy('title', $order);
                    }]);
                })
                ->addColumn('created_at', function ($blog) {
                    return $blog->created_at ? $blog->created_at->toDateTimeString() : null;
                })
                ->addColumn('last_updated_at', function ($blog) {
                    return $blog->updated_at ? $blog->updated_at->toDateTimeString() : null;
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
            return view('blog::blogs.' . $blade_name);
        }
    }

    /**
     * Create blog
     * @return Response
     */
    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        // Get categories 
        $categories = BlogCategory::all();

        $blade_name = ($request->ajax() ? 'create-partial' : 'create'); // Handle Partial Return

        return view('blog::blogs.' . $blade_name, compact('languages', 'categories'), []);
    }

    public function createBlogModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the languages
        $languages = Language::all();

        return view('blog::blogs.create', compact('languages'), [])->render();
    }

    public function UpdateBlogModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        $blog = Blog::find($id);
        $attachments = json_decode(json_encode(MediaResource::collection($blog->getMedia(request()->getHttpHost() . ',blogs,' . $blog->id . ',' . 'attachments'))));

        // Get categories 
        $categories = BlogCategory::all();

        // If blog does not exist, return error div
        if (!$blog) {
            $error = Lang::get('blog::blog.blog_not_found_or_you_are_not_authorized_to_edit_the_blog');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the languages
        $languages = Language::all();
        $blade_name = ($request->ajax() ? 'update-partial' : 'update'); // Handle Partial Return

        return view('blog::blogs.' . $blade_name, compact('blog', 'categories', 'languages', 'attachments'), []);

    }
}
