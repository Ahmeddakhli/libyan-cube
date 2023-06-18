<?php

namespace Modules\Blog\Http\Controllers\Actions\Blog;

use Modules\Blog\Blog;
use Modules\Blog\BlogTranslation;
use DB;
use Carbon\Carbon;
use Modules\Blog\Http\Resources\BlogResource;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileUnacceptableForCollection;

class CreateBlogAction
{
    public function execute(array $data, $attachments = null): BlogResource
    {
        // Create Blog
        $created_at = Carbon::now()->toDateTimeString();

        if (isset($data['is_published'])) {
            $data['published_at'] = Carbon::now();
            $data['published_by'] = auth()->user()->id;
        }
        // Create the blog
        $blog = Blog::create($data);

        if (isset($data['category_ids']) && !empty($data['category_ids'])) {
            $blog->categories()->attach($data['category_ids']);
        }

        // Create translations
        foreach ($data['translations'] as $translation) {
            // To overcome composite primary key laravel insertion issue
            $blog_id = $blog->id;
            $language_id = $translation['language_id'];
            $title = $translation['title'];
            $description = $translation['description'];
            if (isset($translation['meta_title']) && !is_null($translation['meta_title'])) {
                $meta_title = $translation['meta_title'];
            } else {
                $meta_title = $translation['title'];
            }
            if (isset($translation['meta_description']) && !is_null($translation['meta_description'])) {
                $meta_description = $translation['meta_description'];
            } else {
                $meta_description = $translation['description'];
            }

            if ($translation['language_id'] == 1) {
                $slug = str_slug($translation['title']);
            }

            DB::table('blog_trans')->insert([
                'blog_id' => $blog_id,
                'language_id' => $language_id,
                'title' => $title,
                'description' => $description,
                'meta_title' => $meta_title,
                'meta_description' => $meta_description,
                'excerpt' => (isset($translation['excerpt']) && !is_null($translation['excerpt'])) ? $translation['excerpt'] : null,
                'created_at' => $created_at
            ]);
        }

        // Trigger update event on blog to cache its values
        $blog->update([
            'slug' => $slug
        ]);

        // Upload attachments
        if ($attachments) {
            $path = storage_path('tmp/uploads');
            if (!file_exists($path)) {
                mkdir($path, 0777, true);
            }
            $errors = array();
            foreach ($attachments as $attachment) {
                // Store the file
                $name = uniqid() . '_' . trim($attachment->getClientOriginalName());
                $attachment->move($path, $name);
                $full_path = storage_path('tmp/uploads/' . $name);

                // Associate the file with the unit collection
                try {
                    $blog
                        ->addMedia(storage_path('tmp/uploads/' . $name))
                        ->toMediaCollection(request()->getHttpHost() . ',blogs,' . $blog->id . ',' . 'attachments');
                } catch (FileUnacceptableForCollection $e) {
                    $errors[] = [
                        'field' => 'file',
                        'message' => Lang::get('blog::blog.file_is_unacceptable')
                        // 'message' => $e->getMessage()
                    ];
                }
            }
        }

        // Reload the instance
        $blog = Blog::find($blog->id);

        // Transform the result
        $blog = new BlogResource($blog);

        return $blog;
    }
}
