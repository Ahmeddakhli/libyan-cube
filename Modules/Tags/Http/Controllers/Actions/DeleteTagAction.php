<?php

namespace Modules\Tags\Http\Controllers\Actions;

use Modules\Tags\Tag;

class DeleteTagAction
{
    public function __construct()
    {
        //
    }

    public function execute($id)
    {
        // Get the tag
        $tag = Tag::find($id);

        // Delete the tag
        $tag->delete();

        // Return the response
        return null;
    }
}