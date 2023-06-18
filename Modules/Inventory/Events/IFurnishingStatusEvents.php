<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IFurnishingStatus;
use Cache;
use LaravelLocalization;

class IFurnishingStatusEvents
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

    private function clearCaches(IFurnishingStatus $ifurnishing_status)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        foreach ($supported_locales as $key => $supported_locale) {
            // Clear cached i_furnishing_statuses
            Cache::forget('inventory_module_furnishing_statuses_'.$key);

            Cache::forget('i_furnishing_status_'.$ifurnishing_status->id.'_furnishing_status_'.$key);
        }
    }

    public function iFurnishingStatusCreated(IFurnishingStatus $ifurnishing_status)
    {
        $this->clearCaches($ifurnishing_status);
    }

    public function iFurnishingStatusUpdated(IFurnishingStatus $ifurnishing_status)
    {
        $this->clearCaches($ifurnishing_status);
    }

    public function iFurnishingStatusSaved(IFurnishingStatus $ifurnishing_status)
    {
        $this->clearCaches($ifurnishing_status);
    }

    public function iFurnishingStatusDeleted(IFurnishingStatus $ifurnishing_status)
    {
        $this->clearCaches($ifurnishing_status);
    }

    public function iFurnishingStatusRestored(IFurnishingStatus $ifurnishing_status)
    {
        $this->clearCaches($ifurnishing_status);
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
