<?php

namespace Modules\Blog\Http\Controllers\Actions\Categories;

use Modules\Blog\BlogCategory;
use Modules\Blog\Http\Resources\BlogCategoryResource;

class GetCategoryByIdAction
{
    public function execute($id)
    {
        // Find blog category
        $blog_category = BlogCategory::find($id);

        return new BlogCategoryResource($blog_category);
    }
}
