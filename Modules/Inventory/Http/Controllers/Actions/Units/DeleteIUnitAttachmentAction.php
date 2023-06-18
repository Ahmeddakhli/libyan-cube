<?php

namespace Modules\Inventory\Http\Controllers\Actions\Units;

use App\Media;
use Modules\Attachments\Entities\Attachmentable;

class DeleteIUnitAttachmentAction
{
    public function execute($id)
    {
        // Get the media
        $media = Media::find($id);

        if ($media) {
            // Soft delete the media
            $media->delete();
        }

        // Return the response
        return null;
    }
}
