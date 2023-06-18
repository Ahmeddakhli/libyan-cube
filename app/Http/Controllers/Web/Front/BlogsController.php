<?php

namespace App\Http\Controllers\Web\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Blog\Blog;
use Modules\Blog\Http\Controllers\Actions\Blog\GetBlogByIdAction;
use Modules\Blog\Http\Controllers\Actions\Blog\GetBlogsFrontAction;
use Modules\Blog\Http\Controllers\Actions\Categories\GetCategoriesAction;
use Modules\Blog\Http\Resources\BlogResource;

class BlogsController extends Controller
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
    public function index(Request $request)
    {
        $id = $request->id;
        $action = new GetBlogsFrontAction();
        $blogs = $action->execute($request);

        $blog_categories = json_decode(json_encode((new GetCategoriesAction)->execute()));
        // Return blog view
        $features = $this->features();
        $features['blogs'] = $blogs;
        $features['blog_categories'] = $blog_categories;
        
        if($request->ajax()){
            return view('front.partials.blogs.category-blog',compact('blogs'))->render();
        }else{

            return view('front.pages.blogs', $features);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, GetBlogByIdAction $action)
    {
        // Get blog
        $blog = $action->execute($id);

        if (!$blog) {
            abort(404);
        } else {
            $blog = json_decode(json_encode($blog));
        }

        $related_blogs = json_decode(json_encode(BlogResource::collection(Blog::where('category_id', $blog->category_id)->where('id','!=',$blog->id)->orderBy('created_at','desc')->take(3)->get())));
        
        $archives = Blog::select(DB::raw("DATE_FORMAT(created_at, '%M') new_date"),  DB::raw('MONTH(created_at) month'),'created_at')
        ->groupby('month')
        ->get();
        // Get feature page data
        $features = $this->features();

        // Set feature blog
        $features['blog'] = $blog;
        $features['related_blogs'] = $related_blogs;
        $features['archives'] = $archives;

        // Return view response
        return view('front.pages.single-blog', $features);
    }
}
