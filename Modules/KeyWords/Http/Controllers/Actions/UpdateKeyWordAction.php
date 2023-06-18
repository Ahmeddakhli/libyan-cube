<?php

namespace Modules\KeyWords\Http\Controllers\Actions;

use Modules\KeyWords\KeyWord;
use Modules\KeyWords\KeyWordTranslation;
use DB;
use Carbon\Carbon;
use Modules\Attachments\Http\Controllers\Actions\StoreMultiDimensionsAttachmentsAction;
use Modules\KeyWords\Http\Resources\KeyWordResource;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileUnacceptableForCollection;

class UpdateKeyWordAction
{

    public function execute($id, array $data): KeyWordResource
    {
        // Prepare time stamps
        $created_at = Carbon::now()->toDateTimeString();
        $updated_at = Carbon::now()->toDateTimeString();

        // Get key word
        $key_word = KeyWord::find($id);

        // Delete previous translations
        KeyWordTranslation::where('key_word_id', $key_word->id)->delete();

        // Create key word translations
        for ($i = 0; $i < count($data['translations']); $i++) {
            // Prepare translation data
            $key_word_id = $id;
            $language_id = $data['translations'][$i]['language_id'];
            $translation_data = [
                'title' => $data['translations'][$i]['title'],
                'updated_at' => $updated_at
            ];

            // Add additional fields
            $translation_data['key_word_id'] = $key_word_id;
            $translation_data['language_id'] = $language_id;
            $translation_data['created_at'] = $created_at;

            // Create now translation 
            DB::table('key_word_trans')->insert($translation_data);
        }


        $key_word->regions()->detach();
        if (isset($data['region_ids']) && !empty($data['region_ids'])) {
            $key_word->regions()->attach($data['region_ids'],['type' => 'region']);
        }

        if (isset($data['city_ids']) && !empty($data['city_ids'])) {
            $key_word->cities()->attach($data['city_ids'],['type'=>'city']);
        }

        if (isset($data['type_ids']) && !empty($data['type_ids'])) {
            $key_word->types()->detach();
            $key_word->types()->attach($data['type_ids']);
        }

        // Update key word
        // Trigger update key word on key word to cache its values
        $key_word->update($data);

        // Transform the result
        $key_word = new KeyWordResource($key_word);

        // Return the response
        return $key_word;
    }
}
