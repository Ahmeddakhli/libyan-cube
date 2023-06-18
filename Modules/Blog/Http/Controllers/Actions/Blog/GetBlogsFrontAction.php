<?php

namespace Modules\Blog\Http\Controllers\Actions\Blog;

use Cache;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Blog\Blog;
use Modules\Blog\Http\Resources\BlogResource;

class GetBlogsFrontAction
{
    public function __construct()
    {
        //
    }
    public function execute($request)
    {
        // Get Blogs
        $blogs = new Blog();

        // Check if have blog category id & get data with where has this category
        if ($request->id) {
            $blogs = $blogs->where('category_id', $request->id);
        }
        if ($request->category_slug) {
            $blogs = $blogs->whereHas('categories', function ($categories) use ($request) {
                $categories->where('slug', $request->category_slug);
            });
        }
        if ($request->sort) {
            $blogs = $blogs->orderBy('created_at', $request->sort);
        }else{
            $blogs = $blogs->orderBy('created_at', 'desc');

        }
        if ($request->created_at) {
            $blogs = $blogs->whereMonth('created_at', date('m',strtotime($request->created_at)))->whereYear('created_at', date('Y',strtotime($request->created_at)));
        }

        // Paginate result
        $blogs = $blogs->paginate(6);

        // Transform result
        $blogs = BlogResource::collection($blogs);
        $blogs = new LengthAwarePaginator(
            json_decode(json_encode($blogs)),
            $blogs->total(),
            $blogs->perPage(),
            $blogs->currentPage(),
            [
                'path' => \Request::url(),
                'query' => [
                    'page' => $blogs->currentPage()
                ]
            ]
        );

        // Return the result
        return $blogs;
    }
}
