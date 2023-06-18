<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IBedroomTranslation;
use Modules\Inventory\IBedroom;
use Cache;
use LaravelLocalization;

class IBedroomTranslationEvents
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

    private function clearCaches(IBedroomTranslation $i_bedroom_translation)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        // Clearing i_bed_room
        $i_bedroom = IBedroom::find($i_bedroom_translation->i_bedroom_id);

        foreach ($supported_locales as $key => $supported_locale) {
            // Clear cached i_bedrooms
            Cache::forget('inventory_module_bedrooms_'.$key);

            Cache::forget('i_bedroom_'.$i_bedroom->id.'_bedroom_'.$key);
        }
    }

    public function iBedroomTranslationCreated(IBedroomTranslation $i_bedroom_translation)
    {
        $this->clearCaches($i_bedroom_translation);
    }

    public function iBedroomTranslationUpdated(IBedroomTranslation $i_bedroom_translation)
    {
        $this->clearCaches($i_bedroom_translation);
    }

    public function iBedroomTranslationSaved(IBedroomTranslation $i_bedroom_translation)
    {
        $this->clearCaches($i_bedroom_translation);
    }

    public function iBedroomTranslationDeleted(IBedroomTranslation $i_bedroom_translation)
    {
        $this->clearCaches($i_bedroom_translation);
    }

    public function iBedroomTranslationRestored(IBedroomTranslation $i_bedroom_translation)
    {
        $this->clearCaches($i_bedroom_translation);
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
