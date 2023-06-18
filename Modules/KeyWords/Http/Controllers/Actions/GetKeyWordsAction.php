<?php

namespace Modules\KeyWords\Http\Controllers\Actions;

use Cache;
use Modules\KeyWords\KeyWord;
use Modules\KeyWords\Http\Resources\KeyWordResource;

class GetKeyWordsAction
{
    public function execute()
    {
        // Get key words
        $key_words = KeyWord::all();

        // Transform key word
        $key_words = KeyWordResource::collection($key_words);

        // Return the response
        return $key_words;
    }
}
