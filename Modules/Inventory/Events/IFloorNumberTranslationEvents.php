<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IFloorNumberTranslation;
use Modules\Inventory\IFloorNumber;
use Cache;
use LaravelLocalization;

class IFloorNumberTranslationEvents
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

    private function clearCaches(IFloorNumberTranslation $ifloor_number_translation)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        // Clearing i_floor_number
        $ifloor_number = IFloorNumber::find($ifloor_number_translation->i_floor_number_id);

        foreach ($supported_locales as $key => $supported_locale) {
            // Clear cached i_floor_numbers
            Cache::forget('inventory_module_floor_numbers_'.$key);

            Cache::forget('i_floor_number_'.$ifloor_number->id.'_floor_number_'.$key);
        }
    }

    public function iFloorNumberTranslationCreated(IFloorNumberTranslation $ifloor_number_translation)
    {
        $this->clearCaches($ifloor_number_translation);
    }

    public function iFloorNumberTranslationUpdated(IFloorNumberTranslation $ifloor_number_translation)
    {
        $this->clearCaches($ifloor_number_translation);
    }

    public function iFloorNumberTranslationSaved(IFloorNumberTranslation $ifloor_number_translation)
    {
        $this->clearCaches($ifloor_number_translation);
    }

    public function iFloorNumberTranslationDeleted(IFloorNumberTranslation $ifloor_number_translation)
    {
        $this->clearCaches($ifloor_number_translation);
    }

    public function iFloorNumberTranslationRestored(IFloorNumberTranslation $ifloor_number_translation)
    {
        $this->clearCaches($ifloor_number_translation);
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
