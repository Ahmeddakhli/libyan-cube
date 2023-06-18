<?php

namespace Modules\Inventory\Http\Controllers\Actions\Projects;

use App\Media;

class DeleteIProjectAttachmentAction
{
    public function execute($id)
    {
        // Get the media
        $media = Media::find($id);

        // Soft delete the media
        $media->delete();

        // Return the response
        return null;
    }
}
