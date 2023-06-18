<?php

namespace Modules\About\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\About\About;
use Cache;
use App, Auth;
use LaravelLocalization;

class AboutEvents
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

    private function clearCaches(About $about)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();
        Cache::forget('about_'.$about->id.'_value_'.'en');
        Cache::forget('about_'.$about->id.'_description_'.'en');
        foreach ($supported_locales as $key => $supported_locale) {
            Cache::forget('about_module_about_sections_'.$key);
            Cache::forget('about_'.$about->id.'_value_'.$key);
            Cache::forget('about_'.$about->id.'_description_'.$key);
        }
    }

    public function aboutCreated(About $about)
    {
        $this->clearCaches($about);
    }

    public function aboutUpdated(About $about)
    {
        $this->clearCaches($about);
    }

    public function aboutSaved(About $about)
    {
        $this->clearCaches($about);
    }

    public function aboutDeleted(About $about)
    {
        $this->clearCaches($about);
    }

    public function aboutRestored(About $about)
    {
        $this->clearCaches($about);
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
