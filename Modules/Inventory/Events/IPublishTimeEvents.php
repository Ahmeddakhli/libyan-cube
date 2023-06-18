<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IPublishTime;
use Cache;

class IPublishTimeEvents
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

    private function clearCaches(IPublishTime $ipublish_time)
    {
        //
    }

    public function iPublishTimeCreated(IPublishTime $ipublish_time)
    {
        $this->clearCaches($ipublish_time);
    }

    public function iPublishTimeUpdated(IPublishTime $ipublish_time)
    {
        $this->clearCaches($ipublish_time);
    }

    public function iPublishTimeSaved(IPublishTime $ipublish_time)
    {
        $this->clearCaches($ipublish_time);
    }

    public function iPublishTimeDeleted(IPublishTime $ipublish_time)
    {
        $this->clearCaches($ipublish_time);
    }

    public function iPublishTimeRestored(IPublishTime $ipublish_time)
    {
        $this->clearCaches($ipublish_time);
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
