<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IPurposeType;
use Cache;
use LaravelLocalization;

class IPurposeTypeEvents
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

    private function clearCaches(IPurposeType $i_purpose_type)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        Cache::forget('i_purpose_type_'.$i_purpose_type->id.'_purpose_type_'.'en');
        foreach ($supported_locales as $key => $supported_locale) {
            // Clear cached i_purpose_types
            Cache::forget('inventory_module_purpose_types_'.$key);

            Cache::forget('i_purpose_type_'.$i_purpose_type->id.'_purpose_type_'.$key);
        }
    }

    public function iPurposeTypeCreated(IPurposeType $i_purpose_type)
    {
        $this->clearCaches($i_purpose_type);
    }

    public function iPurposeTypeUpdated(IPurposeType $i_purpose_type)
    {
        $this->clearCaches($i_purpose_type);
    }

    public function iPurposeTypeSaved(IPurposeType $i_purpose_type)
    {
        $this->clearCaches($i_purpose_type);
    }

    public function iPurposeTypeDeleted(IPurposeType $i_purpose_type)
    {
        $this->clearCaches($i_purpose_type);
    }

    public function iPurposeTypeRestored(IPurposeType $i_purpose_type)
    {
        $this->clearCaches($i_purpose_type);
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
