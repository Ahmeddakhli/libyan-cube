<?php

namespace Modules\Notifications\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;
use Modules\Notifications\Http\Helpers\NotificationObject;

class GeneralNotification extends Notification
{
    use Queueable;

    protected $notification;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(NotificationObject $notification_object)
    {
        $this->notification_object = $notification_object;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // database: sends data to database notifications table
        // WebPushChannel:class: sends data to web push notification and catched by the service worker 
        return ['database', 'broadcast', WebPushChannel::class];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'title' => $this->notification_object->title,
            'body' => $this->notification_object->body,
            'action_url' => $this->notification_object->action_url,
            'created' => $this->notification_object->created,
            'icon' => $this->notification_object->icon,
            'type' => $this->notification_object->type,
            'related_models' => (property_exists($this->notification_object, 'related_models')) ? $this->notification_object->related_models : null
        ];
    }

    /**
     * Get the web push representation of the notification.
     *
     * @param  mixed  $notifiable
     * @param  mixed  $notification
     * @return \Illuminate\Notifications\Messages\DatabaseMessage
     */
    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title($this->notification_object->title)
            ->icon($this->notification_object->icon)
            ->body($this->notification_object->body)
            ->action('View app', 'view_app')
            ->data([
                'id' => $notification->id,
                'action_url' => $this->notification_object->action_url,
                'created' => $this->notification_object->created,
                'type' => $this->notification_object->type,
                'related_models' => (property_exists($this->notification_object, 'related_models')) ? $this->notification_object->related_models : null
            ]);
    }
}
