<?php

namespace Modules\Testimonials\Http\Controllers\Actions;

use Modules\Testimonials\Testimonial;

class DeleteTestimonialAction
{
    public function execute($id)
    {
        // Delete testimonial
        $testimonial = Testimonial::find($id)->delete();

        // Return the response
        return null;
    }
}
