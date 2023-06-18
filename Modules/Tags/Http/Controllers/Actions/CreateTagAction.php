<?php

namespace Modules\Tags\Http\Controllers\Actions;

use Modules\Tags\Tag;
use Modules\Tags\Http\Resources\TagResource;

class CreateTagAction
{
    public function __construct()
    {
        //
    }

    public function execute(array $data) : TagResource
    {
        // Create the tag
        $tag = new Tag($data);
        $tag->save();

        // Transform the result
        $tag = new TagResource($tag);

        // Return the response
        return $tag;
    }
}