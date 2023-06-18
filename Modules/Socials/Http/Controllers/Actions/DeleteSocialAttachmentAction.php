<?php

namespace Modules\Socials\Http\Controllers\Actions;

use App\Media;

class DeleteSocialAttachmentAction
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
