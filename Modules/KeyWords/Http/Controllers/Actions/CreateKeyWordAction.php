<?php

namespace Modules\KeyWords\Http\Controllers\Actions;

use Modules\KeyWords\KeyWord;
use Modules\KeyWords\KeyWordTranslation;
use DB;
use Carbon\Carbon;
use Modules\Attachments\Http\Controllers\Actions\StoreMultiDimensionsAttachmentsAction;
use Modules\KeyWords\Http\Resources\KeyWordResource;
use Modules\KeyWords\KeyWordLocation;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileUnacceptableForCollection;

class CreateKeyWordAction
{
    public function execute(array $data): KeyWordResource
    {
        // Get time 
        $created_at = Carbon::now()->toDateTimeString();

        // Create key word
        $key_word = KeyWord::create($data);

        // Create translations
        for ($i = 0; $i < count($data['translations']); $i++) {
            // To overcome composite primary key laravel insertion issue
            // Prepare data for key word translation 
            $key_word_id = $key_word->id;
            $language_id = $data['translations'][$i]['language_id'];
            $title = $data['translations'][$i]['title'];

            // Create key word translation
            DB::table('key_word_trans')->insert([
                'key_word_id' => $key_word_id,
                'language_id' => $language_id,
                'title' => $title,
                'created_at' => $created_at
            ]);
        }

        if (isset($data['region_ids']) && !empty($data['region_ids'])) {

            $key_word->regions()->attach($data['region_ids'],['type' => 'region']);
        }

        if (isset($data['city_ids']) && !empty($data['city_ids'])) {
            $key_word->cities()->attach($data['city_ids'],['type'=>'city']);
        }

        if (isset($data['type_ids']) && !empty($data['type_ids'])) {

            $key_word->types()->attach($data['type_ids']);
        }
        // Trigger update key word on key word to cache its values
        $key_word->update();

        // Reload the instance
        $key_word = KeyWord::find($key_word->id);

        // Transform the result
        $key_word = new KeyWordResource($key_word);

        return $key_word;
    }
}
