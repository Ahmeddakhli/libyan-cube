<?php

namespace Modules\Careers\Http\Controllers\Actions;

use Modules\Careers\Career;
use Modules\Careers\CareerTranslation;
use DB;
use Carbon\Carbon;

use Modules\Careers\Http\Resources\CareerResource;

class UpdateCareerAction
{
    public function execute($id, array $data): CareerResource
    {
        $created_at = Carbon::now()->toDateTimeString();
        $updated_at = Carbon::now()->toDateTimeString();

        // Get the career
        $career = Career::find($id);

        // Update the career
        if (!isset($data['is_featured'])) {
            Career::where('id', $career->id)->update([
                'is_featured' => 0,
            ]);
        }

        // Delete previous translation
        CareerTranslation::where('career_id', $career->id)->delete();

        // Create translations
        foreach ($data['translations'] as $translation) {
            // To overcome composite primary key laravel update issue
            $career_id = $id;
            $language_id = $translation['language_id'];
            $title = $translation['title'];
            $description = $translation['description'];
            $meta_title = '';
            $meta_description = '';

            if (isset($translation['meta_title']) && !is_null($translation['meta_title'])) {
                $meta_title = $translation['meta_title'];
            } else {
                $meta_title = $translation['title'];
            }

            if (isset($translation['meta_title']) && !is_null($translation['meta_description'])) {
                $meta_description = $translation['meta_description'];
            } else {
                $meta_description = $translation['description'];
            }

            if ($translation['language_id'] == 1) {
                $slug = str_slug($translation['title']);
            }

            DB::table('career_trans')->insert([
                'career_id' => $career_id,
                'language_id' => $language_id,
                'title' => $title,
                'description' => $description,
                'meta_title' => $meta_title,
                'meta_description' => $meta_description,
                'created_at' => $created_at
            ]);
        }

        // Update the career
        // Trigger update career on career to cache its values
        $data['slug'] = $slug;
        $career->update($data);

        // Reload the instance
        $career = Career::find($career->id);

        // Transform the result
        $career = new CareerResource($career);

        return $career;
    }
}
