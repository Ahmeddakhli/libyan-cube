<?php

namespace Modules\Meetings\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Meetings\Meeting;
use Cache;
use LaravelLocalization;

class MeetingEvents
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

    private function clearCaches(Meeting $meeting)
    {
        //
    }

    public function meetingCreated(Meeting $meeting)
    {
        $this->clearCaches($meeting);
    }

    public function meetingUpdated(Meeting $meeting)
    {
        $this->clearCaches($meeting);
    }

    public function meetingSaved(Meeting $meeting)
    {
        $this->clearCaches($meeting);
    }

    public function meetingDeleted(Meeting $meeting)
    {
        $this->clearCaches($meeting);
    }

    public function meetingRestored(Meeting $meeting)
    {
        $this->clearCaches($meeting);
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
