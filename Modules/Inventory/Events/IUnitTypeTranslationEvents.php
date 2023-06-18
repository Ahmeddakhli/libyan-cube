<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\UnitTypeTranslation;
use Modules\Inventory\UnitType;
use Cache;
use LaravelLocalization;

class IUnitTypeTranslationEvents
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

    private function clearCaches(UnitTypeTranslation $i_unit_type_translation)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        // Clearing i unit type
        $i_unit_type = UnitType::find($i_unit_type_translation->i_unit_type_id);

        foreach ($supported_locales as $key => $supported_locale) {
            // Clear cached i unit types
            Cache::forget('inventory_module_unit_types_'.$key);

            Cache::forget('i_unit_type_'.$i_unit_type->id.'_unit_type_'.$key);
            Cache::forget('i_unit_type_'.$i_unit_type->id.'_description_'.$key);
        }
    }

    public function iUnitTypeTranslationCreated(UnitTypeTranslation $i_unit_type_translation)
    {
        $this->clearCaches($i_unit_type_translation);
    }

    public function iUnitTypeTranslationUpdated(UnitTypeTranslation $i_unit_type_translation)
    {
        $this->clearCaches($i_unit_type_translation);
    }

    public function iUnitTypeTranslationSaved(UnitTypeTranslation $i_unit_type_translation)
    {
        $this->clearCaches($i_unit_type_translation);
    }

    public function iUnitTypeTranslationDeleted(UnitTypeTranslation $i_unit_type_translation)
    {
        $this->clearCaches($i_unit_type_translation);
    }

    public function iUnitTypeTranslationRestored(UnitTypeTranslation $i_unit_type_translation)
    {
        $this->clearCaches($i_unit_type_translation);
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
