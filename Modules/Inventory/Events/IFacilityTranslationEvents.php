<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IFacilityTranslation;
use Modules\Inventory\IFacility;
use Cache;
use LaravelLocalization;

class IFacilityTranslationEvents
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

    private function clearCaches(IFacilityTranslation $i_facility_translation)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        // Clearing i_facility
        $i_facility = IFacility::find($i_facility_translation->i_facility_id);

        foreach ($supported_locales as $key => $supported_locale) {
            // Clear cached i_facilities
            Cache::forget('inventory_module_facilities_'.$key);

            Cache::forget('i_facility_'.$i_facility->id.'_facility_'.$key);
            Cache::forget('i_facility_'.$i_facility->id.'_description_'.$key);
        }
    }

    public function iFacilityTranslationCreated(IFacilityTranslation $i_facility_translation)
    {
        $this->clearCaches($i_facility_translation);
    }

    public function iFacilityTranslationUpdated(IFacilityTranslation $i_facility_translation)
    {
        $this->clearCaches($i_facility_translation);
    }

    public function iFacilityTranslationSaved(IFacilityTranslation $i_facility_translation)
    {
        $this->clearCaches($i_facility_translation);
    }

    public function iFacilityTranslationDeleted(IFacilityTranslation $i_facility_translation)
    {
        $this->clearCaches($i_facility_translation);
    }

    public function iFacilityTranslationRestored(IFacilityTranslation $i_facility_translation)
    {
        $this->clearCaches($i_facility_translation);
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
