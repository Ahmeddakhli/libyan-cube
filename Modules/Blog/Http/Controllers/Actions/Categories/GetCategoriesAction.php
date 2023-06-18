<?php

namespace Modules\Blog\Http\Controllers\Actions\Categories;

use Cache;
use Modules\Blog\BlogCategory;
use Modules\Blog\Http\Resources\BlogCategoryResource;

class GetCategoriesAction
{
    public function execute()
    {
        // Get the blog categories
        $blog_category = BlogCategory::all();

        // Transform the  blog categories
        $blog_category = BlogCategoryResource::collection($blog_category);

        // Return the result
        return $blog_category;
    }
}
