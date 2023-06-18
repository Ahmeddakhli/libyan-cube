<?php

namespace Modules\Notifications\Events;

use Illuminate\Queue\SerializesModels;
// use Hyn\Tenancy\Queue\TenantAwareJob;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NotificationRead implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    /**
     * @var int
     */
    public $httpHost;
    public $userId;

    /**
     * @var int
     */
    public $notificationId;

    /**
     * Create a new event instance.
     *
     * @param  int $userId
     * @param  int $notificationId
     * @return void
     */
    public function __construct($httpHost, $userId, $notificationId)
    {
        $this->httpHost = $httpHost;
        $this->userId = $userId;
        $this->notificationId = $notificationId;

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
