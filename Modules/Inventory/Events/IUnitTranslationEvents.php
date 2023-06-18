<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IUnit;
use Cache;
use LaravelLocalization;
use Modules\Inventory\IUnitTranslation;

class IUnitTranslationEvents
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private function clearCaches(IUnitTranslation $i_unit_translation)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        // Clearing i_unit
        $i_unit = IUnit::find($i_unit_translation->i_unit_id);

        foreach ($supported_locales as $key => $supported_locale) {
            Cache::forget('i_unit' . $i_unit->id . '_address_' . $key);
            Cache::forget('i_unit' . $i_unit->id . '_description_' . $key);
            Cache::forget('i_unit' . $i_unit->id . '_title_' . $key);
        }
    }

    public function iUnitTranslationCreated(IUnitTranslation $i_unit_translation)
    {
        $this->clearCaches($i_unit_translation);
    }

    public function iUnitTranslationUpdated(IUnitTranslation $i_unit_translation)
    {
        $this->clearCaches($i_unit_translation);
    }

    public function iUnitTranslationSaved(IUnitTranslation $i_unit_translation)
    {
        $this->clearCaches($i_unit_translation);
    }

    public function iUnitTranslationDeleted(IUnitTranslation $i_unit_translation)
    {
        $this->clearCaches($i_unit_translation);
    }

    public function iUnitTranslationRestored(IUnitTranslation $i_unit_translation)
    {
        $this->clearCaches($i_unit_translation);
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
