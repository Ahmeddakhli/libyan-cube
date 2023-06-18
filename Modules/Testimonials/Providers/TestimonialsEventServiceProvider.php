<?php

namespace Modules\Testimonials\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class TestimonialsEventServiceProvider extends ServiceProvider
{
    protected $listen = [
         // Testimonial Events
        'testimonial.created' => [
            'Modules\Testimonials\Events\TestimonialEvents@testimonialCreated',
        ],
        'testimonial.updated' => [
            'Modules\Testimonials\Events\TestimonialEvents@testimonialUpdated',
        ],
        'testimonial.saved' => [
            'Modules\Testimonials\Events\TestimonialEvents@testimonialSaved',
        ],
        'testimonial.deleted' => [
            'Modules\Testimonials\Events\TestimonialEvents@testimonialDeleted',
        ],
        'testimonial.restored' => [
            'Modules\Testimonials\Events\TestimonialEvents@testimonialRestored',
        ],

         // Testimonial Translation Events
        'testimonial_translation.created' => [
            'Modules\Testimonials\Events\TestimonialTranslationEvents@testimonialTranslationCreated',
        ],
        'testimonial_translation.updated' => [
            'Modules\Testimonials\Events\TestimonialTranslationEvents@testimonialTranslationUpdated',
        ],
        'testimonial_translation.saved' => [
            'Modules\Testimonials\Events\TestimonialTranslationEvents@testimonialTranslationSaved',
        ],
        'testimonial_translation.deleted' => [
            'Modules\Testimonials\Events\TestimonialTranslationEvents@testimonialTranslationDeleted',
        ],
        'testimonial_translation.restored' => [
            'Modules\Testimonials\Events\TestimonialTranslationEvents@testimonialTranslationRestored',
        ],
    ];
}