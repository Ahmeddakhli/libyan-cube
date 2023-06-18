<?php

namespace Modules\Notifications\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
// use Hyn\Tenancy\Queue\TenantAwareJob;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Notifications\Http\Helpers\NotificationObject;
use Modules\Notifications\Notifications\GeneralNotification;
use Modules\Notifications\Events\GeneralNotificationEvent;
use App\Http\Helpers\FCMNotification;

class GeneralNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $host;
    protected $notification_object;
    protected $notified_users;
    protected $auth_user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($host, NotificationObject $notification_object, $notified_users, $auth_user)
    {
        $this->host = $host;
        $this->notification_object = $notification_object;
        $this->notified_users = $notified_users;
        $this->auth_user = $auth_user;
    }

    public function start()
    {
        // Runs when creating the job
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Notify the users
        foreach ($this->notified_users as $user) {
            // if ($user->id != $this->auth_user->id) {
                // Database Notification && Laravel Echo Broadcast && Web Push Notification
                $user->notify(new GeneralNotification($this->notification_object));
                // // FCM notification
                // foreach ($user->deviceTokens as $token) {
                //     FCMNotification::sendPushNotification($token->device_token, $this->notification_object->title, (array)$this->notification_object);
                // }
                // Fire the socket event (Socket Notification)
                event(new GeneralNotificationEvent($this->host, $this->notification_object, $user->id));
            // }
        }
    }
}
