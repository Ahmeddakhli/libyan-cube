<?php

namespace Modules\Testimonials\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Testimonials\TestimonialTranslation;
use Modules\Testimonials\Testimonial;
use Cache;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class TestimonialTranslationEvents
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    private function clearCaches(TestimonialTranslation $testimonial_translation)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        // Clearing Testimonial Cache
        $testimonial = Testimonial::find($testimonial_translation->testimonial_id);
        Cache::forget('testimonials_' . $testimonial->id . '_value_' . 'default');
        Cache::forget('testimonials_' . $testimonial->id . '_description_' . 'default');

        foreach ($supported_locales as $key => $supported_locale) {
            Cache::forget('testimonials_module_testimonials_' . $key);
            Cache::forget('testimonials_module_featured_testimonials_' . $key);
            Cache::forget('testimonials_' . $testimonial->id . '_value_' . $key);
            Cache::forget('testimonials_' . $testimonial->id . '_description_' . $key);
        }
    }

    public function testimonialTranslationCreated(TestimonialTranslation $testimonial_translation)
    {
        $this->clearCaches($testimonial_translation);
    }

    public function testimonialTranslationUpdated(TestimonialTranslation $testimonial_translation)
    {
        $this->clearCaches($testimonial_translation);
    }

    public function testimonialTranslationSaved(TestimonialTranslation $testimonial_translation)
    {
        $this->clearCaches($testimonial_translation);
    }

    public function testimonialTranslationDeleted(TestimonialTranslation $testimonial_translation)
    {
        $this->clearCaches($testimonial_translation);
    }

    public function testimonialTranslationRestored(TestimonialTranslation $testimonial_translation)
    {
        $this->clearCaches($testimonial_translation);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
