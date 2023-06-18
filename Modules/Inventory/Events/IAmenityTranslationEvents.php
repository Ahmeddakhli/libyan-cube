<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IAmenityTranslation;
use Modules\Inventory\IAmenity;
use Cache;
use LaravelLocalization;

class IAmenityTranslationEvents
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

    private function clearCaches(IAmenityTranslation $iamenity_translation)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        // Clearing i_amenity
        $iamenity = IAmenity::find($iamenity_translation->i_amenity_id);

        foreach ($supported_locales as $key => $supported_locale) {
            // Clear cached i_amenities
            Cache::forget('inventory_module_amenities_'.$key);

            Cache::forget('i_amenity_'.$iamenity->id.'_amenity_'.$key);
            Cache::forget('i_amenity_'.$iamenity->id.'_description_'.$key);
        }
    }

    public function iAmenityTranslationCreated(IAmenityTranslation $iamenity_translation)
    {
        $this->clearCaches($iamenity_translation);
    }

    public function iAmenityTranslationUpdated(IAmenityTranslation $iamenity_translation)
    {
        $this->clearCaches($iamenity_translation);
    }

    public function iAmenityTranslationSaved(IAmenityTranslation $iamenity_translation)
    {
        $this->clearCaches($iamenity_translation);
    }

    public function iAmenityTranslationDeleted(IAmenityTranslation $iamenity_translation)
    {
        $this->clearCaches($iamenity_translation);
    }

    public function iAmenityTranslationRestored(IAmenityTranslation $iamenity_translation)
    {
        $this->clearCaches($iamenity_translation);
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
