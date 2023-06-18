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
use Modules\Inventory\IUnitImageTranslation;

class IUnitImageTranslationEvents
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private function clearCaches(IUnitImageTranslation $i_unit_image_translation)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        // Clearing i_unit
        $i_unit = IUnitImage::find($i_unit_image_translation->i_unit_id);

        foreach ($supported_locales as $key => $supported_locale) {
            Cache::forget('i_unit_image' . $i_unit->id . '_title_' . $key);
        }
    }

    public function iUnitImageTranslationCreated(IUnitImageTranslation $i_unit_image_translation)
    {
        $this->clearCaches($i_unit_image_translation);
    }

    public function iUnitImageTranslationUpdated(IUnitImageTranslation $i_unit_image_translation)
    {
        $this->clearCaches($i_unit_image_translation);
    }

    public function iUnitImageTranslationSaved(IUnitImageTranslation $i_unit_image_translation)
    {
        $this->clearCaches($i_unit_image_translation);
    }

    public function iUnitImageTranslationDeleted(IUnitImageTranslation $i_unit_image_translation)
    {
        $this->clearCaches($i_unit_image_translation);
    }

    public function iUnitImageTranslationRestored(IUnitImageTranslation $i_unit_image_translation)
    {
        $this->clearCaches($i_unit_image_translation);
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
