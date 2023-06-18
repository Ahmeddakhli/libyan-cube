<?php

namespace Modules\Messages\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Messages\Message;
use Cache;
use LaravelLocalization;

class MessageEvents
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private function clearCaches(Message $message)
    {
        //
    }

    public function messageCreated(Message $message)
    {
        $this->clearCaches($message);
    }

    public function messageUpdated(Message $message)
    {
        $this->clearCaches($message);
    }

    public function messageSaved(Message $message)
    {
        $this->clearCaches($message);
    }

    public function messageDeleted(Message $message)
    {
        $this->clearCaches($message);
    }

    public function messageRestored(Message $message)
    {
        $this->clearCaches($message);
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
