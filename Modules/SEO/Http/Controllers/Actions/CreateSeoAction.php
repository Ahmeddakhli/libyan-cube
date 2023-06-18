<?php

namespace Modules\SEO\Http\Controllers\Actions;

use Modules\SEO\Seo;
use Modules\SEO\SeoTranslation;
use DB;
use Carbon\Carbon;
use Modules\SEO\Http\Resources\SeoResource;

class CreateSeoAction
{
    public function execute(array $data): SeoResource
    {
        $created_at = Carbon::now()->toDateTimeString();

        // Create seo
        $seo = Seo::create($data);

        // Create translations
        foreach ($data['translations'] as $translation) {
            // To overcome composite primary key laravel insertion issue
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

        // Reload the instance
        $seo = Seo::find($seo->id);

        // Transform the result
        $seo = new SeoResource($seo);

        return $seo;
    }
}
