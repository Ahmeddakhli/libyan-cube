<?php

namespace Modules\KeyWords\Http\Controllers\Actions;

use Modules\KeyWords\KeyWord;
use Modules\KeyWords\Http\Resources\KeyWordResource;

class GetKeyWordByIdAction
{
    public function execute($id)
    {
        // Find the key word 
        $key_word = KeyWord::find($id);

        // Return transformed key word
        return new KeyWordResource($key_word);
    }
}
