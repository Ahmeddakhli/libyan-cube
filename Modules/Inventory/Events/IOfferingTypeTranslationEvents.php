<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IOfferingTypeTranslation;
use Modules\Inventory\IOfferingType;
use Cache;
use LaravelLocalization;

class IOfferingTypeTranslationEvents
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

    private function clearCaches(IOfferingTypeTranslation $ioffering_type_translation)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        // Clearing i_offering_type
        $ioffering_type = IOfferingType::find($ioffering_type_translation->i_fur_status_id);

        Cache::forget('i_offering_type_'.$ioffering_type->id.'_offering_type_'.'en');

        foreach ($supported_locales as $key => $supported_locale) {
            // Clear cached i_offering_type
            Cache::forget('inventory_module_offering_types_'.$key);

            Cache::forget('i_offering_type_'.$ioffering_type->id.'_offering_type_'.$key);
        }
    }

    public function iOfferingTypeTranslationCreated(IOfferingTypeTranslation $ioffering_type_translation)
    {
        $this->clearCaches($ioffering_type_translation);
    }

    public function iOfferingTypeTranslationUpdated(IOfferingTypeTranslation $ioffering_type_translation)
    {
        $this->clearCaches($ioffering_type_translation);
    }

    public function iOfferingTypeTranslationSaved(IOfferingTypeTranslation $ioffering_type_translation)
    {
        $this->clearCaches($ioffering_type_translation);
    }

    public function iOfferingTypeTranslationDeleted(IOfferingTypeTranslation $ioffering_type_translation)
    {
        $this->clearCaches($ioffering_type_translation);
    }

    public function iOfferingTypeTranslationRestored(IOfferingTypeTranslation $ioffering_type_translation)
    {
        $this->clearCaches($ioffering_type_translation);
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
