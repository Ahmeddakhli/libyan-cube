<?php

namespace Modules\ContactUS\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\ContactUS\Subscribe;
use Cache;
use LaravelLocalization;

class SubscribeEvents
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private function clearCaches(Subscribe $subscribe)
    {
        // $supported_locales = LaravelLocalization::getSupportedLocales();
        // foreach ($supported_locales as $key => $supported_locale) {
        //     //
        // }
    }

    public function subscribeCreated(Subscribe $subscribe)
    {
        $this->clearCaches($subscribe);
    }

    public function subscribeUpdated(Subscribe $subscribe)
    {
        $this->clearCaches($subscribe);
    }

    public function subscribeSaved(Subscribe $subscribe)
    {
        $this->clearCaches($subscribe);
    }

    public function subscribeDeleted(Subscribe $subscribe)
    {
        $this->clearCaches($subscribe);
    }

    public function subscribeRestored(Subscribe $subscribe)
    {
        $this->clearCaches($subscribe);
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
