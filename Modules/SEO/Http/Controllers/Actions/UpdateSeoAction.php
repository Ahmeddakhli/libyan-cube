<?php

namespace Modules\SEO\Http\Controllers\Actions;

use Modules\SEO\Seo;
use Modules\SEO\SeoTranslation;
use DB;
use Carbon\Carbon;

use Modules\SEO\Http\Resources\SeoResource;

class UpdateSeoAction
{
    public function execute($id, array $data): SeoResource
    {
        $created_at = Carbon::now()->toDateTimeString();
        $updated_at = Carbon::now()->toDateTimeString();

        // Get the seo
        $seo = Seo::find($id);

        // Delete previous translation
        SeoTranslation::where('seo_id', $seo->id)->delete();

        // Create translations
        foreach ($data['translations'] as $translation) {
            // To overcome composite primary key laravel update issue
            $seo_id = $seo->id;
            $language_id = $translation['language_id'];
            $title = '';
            $description = '';
            $key_words = '';
            $short_description = '';
            $popup_contact_us_title = '';

            if (isset($translation['title']) && !is_null($translation['title'])) {
                $title = $translation['title'];
            }

            if (isset($translation['description']) && !is_null($translation['description'])) {
                $description = $translation['description'];
            }
            if (isset($translation['key_words']) && !is_null($translation['key_words'])) {
                $key_words = $translation['key_words'];
            }
            if (isset($translation['short_description']) && !is_null($translation['short_description'])) {
                $short_description = $translation['short_description'];
            }


            if (isset($translation['popup_contact_us_title']) && !is_null($translation['popup_contact_us_title'])) {
                $popup_contact_us_title = $translation['popup_contact_us_title'];
            }
            DB::table('seo_trans')->insert([
                'seo_id' => $seo_id,
                'language_id' => $language_id,
                'title' => $title,
                'description' => $description,
                'key_words' => $key_words,
                'short_description' => $short_description,
                'popup_contact_us_title' => $popup_contact_us_title,
                'created_at' => $created_at
            ]);
        }

        // Update the seo
        // Trigger update seo on seo to cache its values
        if (isset($data['show_short_description']) && $data['show_short_description'] == 'on') {
            $data['show_short_description'] = 1;
        } else {
            $data['show_short_description'] = 0;
        }
        $seo->update($data);

        // Reload the instance
        $seo = Seo::find($seo->id);

        // Transform the result
        $seo = new SeoResource($seo);

        return $seo;
    }
}
