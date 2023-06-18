<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IDesignType;
use Cache;
use LaravelLocalization;

class IDesignTypeEvents
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

    private function clearCaches(IDesignType $i_design_type)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        foreach ($supported_locales as $key => $supported_locale) {
            // Clear cached i_design_types
            Cache::forget('inventory_module_design_types_'.$key);

            Cache::forget('i_design_type_'.$i_design_type->id.'_design_type_'.$key);
            Cache::forget('i_design_type_' . $i_design_type->id . '_description_' . $key);
        }
    }

    public function IDesignTypeCreated(IDesignType $i_design_type)
    {
        $this->clearCaches($i_design_type);
    }

    public function IDesignTypeUpdated(IDesignType $i_design_type)
    {
        $this->clearCaches($i_design_type);
    }

    public function IDesignTypeSaved(IDesignType $i_design_type)
    {
        $this->clearCaches($i_design_type);
    }

    public function IDesignTypeDeleted(IDesignType $i_design_type)
    {
        $this->clearCaches($i_design_type);
    }

    public function IDesignTypeRestored(IDesignType $i_design_type)
    {
        $this->clearCaches($i_design_type);
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
