<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IFinishingType;
use Cache;
use LaravelLocalization;

class IFinishingTypeEvents
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

    private function clearCaches(IFinishingType $i_finishing_type)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        foreach ($supported_locales as $key => $supported_locale) {
            // Clear cached i_finishing_types
            Cache::forget('inventory_module_finishing_types_'.$key);

            Cache::forget('i_finishing_type_'.$i_finishing_type->id.'_finishing_type_'.$key);
        }
    }

    public function iFinishingTypeCreated(IFinishingType $i_finishing_type)
    {
        $this->clearCaches($i_finishing_type);
    }

    public function iFinishingTypeUpdated(IFinishingType $i_finishing_type)
    {
        $this->clearCaches($i_finishing_type);
    }

    public function iFinishingTypeSaved(IFinishingType $i_finishing_type)
    {
        $this->clearCaches($i_finishing_type);
    }

    public function iFinishingTypeDeleted(IFinishingType $i_finishing_type)
    {
        $this->clearCaches($i_finishing_type);
    }

    public function iFinishingTypeRestored(IFinishingType $i_finishing_type)
    {
        $this->clearCaches($i_finishing_type);
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
