<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IBathroomTranslation;
use Modules\Inventory\IBathroom;
use Cache;
use LaravelLocalization;

class IBathroomTranslationEvents
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

    private function clearCaches(IBathroomTranslation $i_bathroom_translation)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        // Clearing i_bathroom
        $ibathroom = IBathroom::find($i_bathroom_translation->i_bathroom_id);

        foreach ($supported_locales as $key => $supported_locale) {
            // Clear cached i_bathroom
            Cache::forget('inventory_module_bathrooms_'.$key);

            Cache::forget('i_bathroom_'.$ibathroom->id.'_bathroom_'.$key);
        }
    }

    public function iBathroomTranslationCreated(IBathroomTranslation $i_bathroom_translation)
    {
        $this->clearCaches($i_bathroom_translation);
    }

    public function iBathroomTranslationUpdated(IBathroomTranslation $i_bathroom_translation)
    {
        $this->clearCaches($i_bathroom_translation);
    }

    public function iBathroomTranslationSaved(IBathroomTranslation $i_bathroom_translation)
    {
        $this->clearCaches($i_bathroom_translation);
    }

    public function iBathroomTranslationDeleted(IBathroomTranslation $i_bathroom_translation)
    {
        $this->clearCaches($i_bathroom_translation);
    }

    public function iBathroomTranslationRestored(IBathroomTranslation $i_bathroom_translation)
    {
        $this->clearCaches($i_bathroom_translation);
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
