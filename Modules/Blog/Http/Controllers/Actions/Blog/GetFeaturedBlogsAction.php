<?php

namespace Modules\Blog\Http\Controllers\Actions\Blog;

use Cache;
use Modules\Blog\Blog;
use Modules\Blog\Http\Resources\BlogResource;
use Modules\Blog\Http\Resources\FeaturedBlogResource;

class GetFeaturedBlogsAction
{
    public function __construct()
    {
        //
    }
    public function execute()
    {
        // Get the blogs
        $blogs = Blog::featured()->get();

        // Transform the  Blogs
        $blogs = FeaturedBlogResource::collection($blogs);

        // Return the result
        return $blogs;
    }
}
