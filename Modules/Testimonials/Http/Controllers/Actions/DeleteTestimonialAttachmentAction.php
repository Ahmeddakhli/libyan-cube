<?php

namespace Modules\Testimonials\Http\Controllers\Actions;

use App\Media;

class DeleteTestimonialAttachmentAction
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
