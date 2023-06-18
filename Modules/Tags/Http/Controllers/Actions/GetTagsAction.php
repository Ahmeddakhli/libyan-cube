<?php

namespace Modules\Tags\Http\Controllers\Actions;

use Cache;
use Modules\Tags\Tag;
use Modules\Tags\Http\Resources\TagResource;

class GetTagsAction
{
    public function execute()
    {
        return Cache::rememberForever('tags_module_tags', function() {
            $array = array();
            $tags = Tag::all();

            // Transform the tags
            $tags = TagResource::collection($tags);

            return $tags;
        });
    }
}