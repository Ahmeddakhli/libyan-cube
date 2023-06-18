<?php

namespace Modules\Blog\Http\Controllers\Actions\Blog;

use Modules\Blog\Blog;
use Modules\Blog\Http\Resources\BlogResource;

class GetBlogByIdAction
{
    public function execute($id)
    {
        $blog = Blog::find($id);

        return $blog ? new BlogResource($blog) : null;
    }
}
