<?php

namespace Modules\Ratings\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Ratings\Rating;
use Cache;
use LaravelLocalization;

class RatingEvents
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

    private function clearCaches(Rating $rating)
    {
        //
    }

    public function ratingCreated(Rating $rating)
    {
        $this->clearCaches($rating);
    }

    public function ratingUpdated(Rating $rating)
    {
        $this->clearCaches($rating);
    }

    public function ratingSaved(Rating $rating)
    {
        $this->clearCaches($rating);
    }

    public function ratingDeleted(Rating $rating)
    {
        $this->clearCaches($rating);
    }

    public function ratingRestored(Rating $rating)
    {
        $this->clearCaches($rating);
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
