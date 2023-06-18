<?php

namespace Modules\Settings\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Settings\Logo;
use Cache;
use App, Auth;
use LaravelLocalization;

class LogoEvents
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private function clearCaches(Logo $logo)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();
        foreach ($supported_locales as $key => $supported_locale) {
            Cache::forget('settings_module_logos_'.$key);
            Cache::forget('settings_module_front_logos_'.$key);
        }
    }

    public function logoCreated(Logo $logo)
    {
        $this->clearCaches($logo);
    }

    public function logoUpdated(Logo $logo)
    {
        $this->clearCaches($logo);
    }

    public function logoSaved(Logo $logo)
    {
        $this->clearCaches($logo);
    }

    public function logoDeleted(Logo $logo)
    {
        $this->clearCaches($logo);
    }

    public function logoRestored(Logo $logo)
    {
        $this->clearCaches($logo);
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
