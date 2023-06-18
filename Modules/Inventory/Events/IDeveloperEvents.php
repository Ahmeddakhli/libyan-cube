<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IDeveloper;
use Cache;
use LaravelLocalization;

class IDeveloperEvents
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

    private function clearCaches(IDeveloper $i_developer)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        Cache::forget('i_developer_'.$i_developer->id.'_developer_'.'default');
        Cache::forget('i_developer_'.$i_developer->id.'_description_'.'default');
        foreach ($supported_locales as $key => $supported_locale) {
            // Clear cached i_developers
            Cache::forget('inventory_module_developers_'.$key);

            Cache::forget('i_developer_'.$i_developer->id.'_developer_'.$key);
            Cache::forget('i_developer_'.$i_developer->id.'_description_'.$key);
            Cache::forget('i_developer_'.$i_developer->id.'_meta_title_'.$key);
            Cache::forget('i_developer_'.$i_developer->id.'_meta_description_'.$key);
        }
    }

    public function iDeveloperCreated(IDeveloper $i_developer)
    {
        $this->clearCaches($i_developer);
    }

    public function iDeveloperUpdated(IDeveloper $i_developer)
    {
        $this->clearCaches($i_developer);
    }

    public function iDeveloperSaved(IDeveloper $i_developer)
    {
        $this->clearCaches($i_developer);
    }

    public function iDeveloperDeleted(IDeveloper $i_developer)
    {
        $this->clearCaches($i_developer);
    }

    public function iDeveloperRestored(IDeveloper $i_developer)
    {
        $this->clearCaches($i_developer);
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
