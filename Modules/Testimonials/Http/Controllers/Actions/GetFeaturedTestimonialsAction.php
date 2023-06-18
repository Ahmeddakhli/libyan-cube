<?php

namespace Modules\Testimonials\Http\Controllers\Actions;

use Modules\Testimonials\Http\Resources\TestimonialResource;
use Modules\Testimonials\Testimonial;
use Cache;
use App;

class GetFeaturedTestimonialsAction
{
    public function execute()
    {
        return Cache::rememberForever('testimonials_module_featured_testimonials_'.App::getLocale(), function() {
	        // Get testimonials
	        $testimonials = Testimonial::featured()->get();

            // Transform the testimonials
            $testimonials = TestimonialResource::collection($testimonials);

            return $testimonials;
        });
    }
}
