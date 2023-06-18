<?php

namespace Modules\KeyWords\Http\Controllers\Actions;

use Modules\KeyWords\KeyWord;
use DB;
use Carbon\Carbon;

class DeleteKeyWordAction
{
    public function execute($id)
    {
        // Get the key word
        $key_word = KeyWord::find($id);

        // Delete the translations manually to overcome laravel issue with composite primary key
        $key_word_translations = $key_word->translations;
        foreach ($key_word_translations as $key_word_translation) {
            $deleted_at = Carbon::now()->toDateTimeString();
            $key_word_id = $key_word_translation->key_word_id;
            $language_id = $key_word_translation->language_id;
            DB::table('key_word_trans')->where('key_word_id', $key_word_id)->where('language_id', $language_id)->update([
                'deleted_at' => $deleted_at
            ]);
        }
        
        // Delete key word 
        $key_word->delete();

        return null;
    }
}
