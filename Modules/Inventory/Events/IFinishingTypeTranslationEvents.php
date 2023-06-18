<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IFinishingTypeTranslation;
use Modules\Inventory\IFinishingType;
use Cache;
use LaravelLocalization;

class IFinishingTypeTranslationEvents
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

    private function clearCaches(IFinishingTypeTranslation $i_finishing_type_translation)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        // Clearing i_finishing_type
        $i_finishing_type = IFinishingType::find($i_finishing_type_translation->i_finishing_type_id);

        foreach ($supported_locales as $key => $supported_locale) {
            // Clear cached i_finishing_types
            Cache::forget('inventory_module_finishing_types_'.$key);

            Cache::forget('i_finishing_type_'.$i_finishing_type->id.'_finishing_type_'.$key);
        }
    }

    public function iFinishingTypeTranslationCreated(IFinishingTypeTranslation $i_finishing_type_translation)
    {
        $this->clearCaches($i_finishing_type_translation);
    }

    public function iFinishingTypeTranslationUpdated(IFinishingTypeTranslation $i_finishing_type_translation)
    {
        $this->clearCaches($i_finishing_type_translation);
    }

    public function iFinishingTypeTranslationSaved(IFinishingTypeTranslation $i_finishing_type_translation)
    {
        $this->clearCaches($i_finishing_type_translation);
    }

    public function iFinishingTypeTranslationDeleted(IFinishingTypeTranslation $i_finishing_type_translation)
    {
        $this->clearCaches($i_finishing_type_translation);
    }

    public function iFinishingTypeTranslationRestored(IFinishingTypeTranslation $i_finishing_type_translation)
    {
        $this->clearCaches($i_finishing_type_translation);
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
