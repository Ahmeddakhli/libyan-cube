<?php

namespace Modules\Notifications\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
// use Hyn\Tenancy\Queue\TenantAwareJob;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Notifications\Http\Helpers\NotificationObject;

class GeneralNotificationEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $httpHost;
    public $notification_object;
    public $user_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($httpHost, NotificationObject $notification_object, $user_id)
    {
        $this->httpHost = $httpHost;
        $this->notification_object = $notification_object;
        $this->user_id = $user_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        // Catched by socket
        /**
         * // Subscribe to dynamic channel
         * redis.psubscribe('*', function(err, count) {});
         * // Emit redis messages
         * redis.on('pmessage', function(subscribed, channel, message) {
         *    message = JSON.parse(message);
         *    io.emit(channel + ':' + message.event, message.data);
         * });
         */
        /**
         * socket.on('App.User.'+global_variables.auth_user_id+':Modules\\Notifications\\Events\\GeneralNotificationEvent', function(data) {
         *     // Data handling
         * });
         */

        // broadcase: broadcasts data to window.Echo.private(`App.User.${window.Laravel.user.id}`)
        return ['App.User.'.$this->user_id];
    }
}