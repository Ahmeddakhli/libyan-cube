<?php

namespace Modules\Attachments\Http\Controllers\Actions;

use App\Media;

class DeleteMediaAttachmentAction
{
    public function __construct()
    {
        //
    }

    public function execute($id)
    {
        // Get the media
        $media = Media::find($id);
        // Delete Multi dimensionals
        $action = new DeleteMultiDimensionalsAction;
        $action->execute($media);

        $media->delete();

        // Return the response
        return null;
    }
}
