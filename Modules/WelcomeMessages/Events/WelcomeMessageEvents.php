<?php

namespace Modules\WelcomeMessages\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\WelcomeMessages\WelcomeMessage;
use Cache;
use App, Auth;
use LaravelLocalization;

class WelcomeMessageEvents
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

    private function clearCaches(WelcomeMessage $welcome_message)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();
        foreach ($supported_locales as $key => $supported_locale) {
            Cache::forget('welcome_messages_'.$key);
            Cache::forget('welcome_messages_'.$welcome_message->id.'_value_'.$key);
        }
    }

    public function welcomeMessageCreated(WelcomeMessage $welcome_message)
    {
        $this->clearCaches($welcome_message);
    }

    public function welcomeMessageUpdated(WelcomeMessage $welcome_message)
    {
        $this->clearCaches($welcome_message);
    }

    public function welcomeMessageSaved(WelcomeMessage $welcome_message)
    {
        $this->clearCaches($welcome_message);
    }

    public function welcomeMessageDeleted(WelcomeMessage $welcome_message)
    {
        $this->clearCaches($welcome_message);
    }

    public function welcomeMessageRestored(WelcomeMessage $welcome_message)
    {
        $this->clearCaches($welcome_message);
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
