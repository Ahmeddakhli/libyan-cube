<?php

namespace Modules\Testimonials\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Testimonials\Testimonial;
use Cache;
use LaravelLocalization;

class TestimonialEvents
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

    private function clearCaches(Testimonial $testimonial)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();
        Cache::forget('testimonials_' . $testimonial->id . '_value_' . 'default');
        Cache::forget('testimonials_' . $testimonial->id . '_description_' . 'default');

        // Clearing Testimonial Cache
        foreach ($supported_locales as $key => $supported_locale) {
            Cache::forget('testimonials_module_testimonials_' . $key);
            Cache::forget('testimonials_module_featured_testimonials_' . $key);
            Cache::forget('testimonials_' . $testimonial->id . '_value_' . $key);
            Cache::forget('testimonials_' . $testimonial->id . '_description_' . $key);
        }
    }

    public function testimonialCreated(Testimonial $testimonial)
    {
        $this->clearCaches($testimonial);
    }

    public function testimonialUpdated(Testimonial $testimonial)
    {
        $this->clearCaches($testimonial);
    }

    public function testimonialSaved(Testimonial $testimonial)
    {
        $this->clearCaches($testimonial);
    }

    public function testimonialDeleted(Testimonial $testimonial)
    {
        $this->clearCaches($testimonial);
    }

    public function testimonialRestored(Testimonial $testimonial)
    {
        $this->clearCaches($testimonial);
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
