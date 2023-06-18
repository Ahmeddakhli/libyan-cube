<?php

namespace Modules\Attachments\Http\Controllers\Actions;

use App\Media;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Attachments\Entities\Attachmentable;
use Illuminate\Support\Facades\Storage;

class DeleteMediaAction
{
    /** 
     * @param [integer] id
     * @return [Boolean] return
     */
    public function execute($id)
    {
        // Get the media
        $media = Media::find($id);
        
        if ($media) {
            // Delete Multi dimensionals
            $action = new DeleteMultiDimensionalsAction;
            $action->execute($media);
            // Soft delete the media
            $media->delete();
        }

        return null;
    }
}
