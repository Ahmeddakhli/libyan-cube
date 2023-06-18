<?php

namespace Modules\Tags\Http\Controllers\Actions;

use Modules\Tags\Tag;
use Modules\Tags\Http\Resources\TagResource;

class UpdateTagAction
{
    public function execute($id, array $data) : TagResource
    {
        // Get the tag
        $tag = Tag::find($id);

        // Update the tag
        $tag->update($data);

        // Transform the result
        $tag = new TagResource($tag);

        // Return the response
        return $tag;
    }
}