<?php

namespace Modules\Notifications\Events;

use Illuminate\Queue\SerializesModels;
// use Hyn\Tenancy\Queue\TenantAwareJob;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NotificationReadAll implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @var int
     */
    public $httpHost;
    public $userId;

    /**
     * Create a new event instance.
     *
     * @param  int $userId
     * @return void
     */
    public function __construct($httpHost, $userId)
    {
        $this->httpHost = $httpHost;
        $this->userId = $userId;

        $this->dontBroadcastToCurrentUser();
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [new PrivateChannel("App.User.{$this->userId}")];
    }
}
