<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IOfferingType;
use Cache;
use LaravelLocalization;

class IOfferingTypeEvents
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

    private function clearCaches(IOfferingType $ioffering_type)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        Cache::forget('i_offering_type_'.$ioffering_type->id.'_offering_type_'.'en');

        foreach ($supported_locales as $key => $supported_locale) {
            // Clear cached i_offering_types
            Cache::forget('inventory_module_offering_types_'.$key);

            Cache::forget('i_offering_type_'.$ioffering_type->id.'_offering_type_'.$key);
        }
    }

    public function iOfferingTypeCreated(IOfferingType $ioffering_type)
    {
        $this->clearCaches($ioffering_type);
    }

    public function iOfferingTypeUpdated(IOfferingType $ioffering_type)
    {
        $this->clearCaches($ioffering_type);
    }

    public function iOfferingTypeSaved(IOfferingType $ioffering_type)
    {
        $this->clearCaches($ioffering_type);
    }

    public function iOfferingTypeDeleted(IOfferingType $ioffering_type)
    {
        $this->clearCaches($ioffering_type);
    }

    public function iOfferingTypeRestored(IOfferingType $ioffering_type)
    {
        $this->clearCaches($ioffering_type);
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
