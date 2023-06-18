<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IFurnishingStatusTranslation;
use Modules\Inventory\IFurnishingStatus;
use Cache;
use LaravelLocalization;

class IFurnishingStatusTranslationEvents
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

    private function clearCaches(IFurnishingStatusTranslation $ifurnishing_status_translation)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        // Clearing i_furnishing_status
        $ifurnishing_status = IFurnishingStatus::find($ifurnishing_status_translation->i_fur_status_id);

        foreach ($supported_locales as $key => $supported_locale) {
            // Clear cached i_furnishing_statuses
            Cache::forget('inventory_module_furnishing_statuses_'.$key);

            Cache::forget('i_furnishing_status_'.$ifurnishing_status->id.'_furnishing_status_'.$key);
        }
    }

    public function iFurnishingStatusTranslationCreated(IFurnishingStatusTranslation $ifurnishing_status_translation)
    {
        $this->clearCaches($ifurnishing_status_translation);
    }

    public function iFurnishingStatusTranslationUpdated(IFurnishingStatusTranslation $ifurnishing_status_translation)
    {
        $this->clearCaches($ifurnishing_status_translation);
    }

    public function iFurnishingStatusTranslationSaved(IFurnishingStatusTranslation $ifurnishing_status_translation)
    {
        $this->clearCaches($ifurnishing_status_translation);
    }

    public function iFurnishingStatusTranslationDeleted(IFurnishingStatusTranslation $ifurnishing_status_translation)
    {
        $this->clearCaches($ifurnishing_status_translation);
    }

    public function iFurnishingStatusTranslationRestored(IFurnishingStatusTranslation $ifurnishing_status_translation)
    {
        $this->clearCaches($ifurnishing_status_translation);
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
