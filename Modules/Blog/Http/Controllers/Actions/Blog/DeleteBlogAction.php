<?php

namespace Modules\Blog\Http\Controllers\Actions\Blog;

use Modules\Blog\Blog; 
use DB;
use Carbon\Carbon;

class DeleteBlogAction
{
    public function __construct()
    {
        //
    }

    public function execute($id)
    {
        // Get the blog
        $blog = Blog::find($id);

        // Delete the translations manually to overcome laravel issue with composite primary key
        $blog_translations = $blog->translations;
        foreach ($blog_translations as $blog_translation) {
            $deleted_at = Carbon::now()->toDateTimeString();

            $blog_id = $blog_translation->blog_id;
            $language_id = $blog_translation->language_id;

            // Delete the translation
            $connection = DB::table('blog_trans')->where('blog_id',$blog_id)->where('language_id',$language_id)->update([
                'deleted_at'=>$deleted_at
            ]);
        }

        // Delete the blog
        $blog->delete();

        // Return the result
        return null;
    }
}