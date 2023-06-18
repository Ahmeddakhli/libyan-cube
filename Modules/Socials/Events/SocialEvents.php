<?php

namespace Modules\Socials\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Socials\Social;
use Cache;
use LaravelLocalization;

class SocialEvents
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

    private function clearCaches(Social $social)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        // Clearing social
        foreach ($supported_locales as $key => $supported_locale) {
            Cache::forget('socials_'.$social->id.'_value_'.$key);
        }
    }

    public function socialCreated(Social $social)
    {
        $this->clearCaches($social);
    }

    public function socialUpdated(Social $social)
    {
        $this->clearCaches($social);
    }

    public function socialSaved(Social $social)
    {
        $this->clearCaches($social);
    }

    public function socialDeleted(Social $social)
    {
        $this->clearCaches($social);
    }

    public function socialRestored(Social $social)
    {
        $this->clearCaches($social);
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
