<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IDesignTypeTranslation;
use Modules\Inventory\IDesignType;
use Cache;
use LaravelLocalization;

class IDesignTypeTranslationEvents
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

    private function clearCaches(IDesignTypeTranslation $i_design_type_translation)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        // Clearing i_bed_room
        $i_design_type = IDesignType::find($i_design_type_translation->i_design_type_id);

        foreach ($supported_locales as $key => $supported_locale) {
            // Clear cached i_design_types
            Cache::forget('inventory_module_design_types_'.$key);

            Cache::forget('i_design_type_'.$i_design_type->id.'_design_type_'.$key);
            Cache::forget('i_design_type_' . $i_design_type->id . '_description_' . $key);
        }
    }

    public function iDesignTypeTranslationCreated(IDesignTypeTranslation $i_design_type_translation)
    {
        $this->clearCaches($i_design_type_translation);
    }

    public function iDesignTypeTranslationUpdated(IDesignTypeTranslation $i_design_type_translation)
    {
        $this->clearCaches($i_design_type_translation);
    }

    public function iDesignTypeTranslationSaved(IDesignTypeTranslation $i_design_type_translation)
    {
        $this->clearCaches($i_design_type_translation);
    }

    public function iDesignTypeTranslationDeleted(IDesignTypeTranslation $i_design_type_translation)
    {
        $this->clearCaches($i_design_type_translation);
    }

    public function iDesignTypeTranslationRestored(IDesignTypeTranslation $i_design_type_translation)
    {
        $this->clearCaches($i_design_type_translation);
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
