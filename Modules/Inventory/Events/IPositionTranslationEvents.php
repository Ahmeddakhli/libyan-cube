<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IPositionTranslation;
use Modules\Inventory\IPosition;
use Cache;
use LaravelLocalization;

class IPositionTranslationEvents
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

    private function clearCaches(IPositionTranslation $iposition_translation)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        // Clearing i_position
        $iposition = IPosition::find($iposition_translation->i_position_id);

        foreach ($supported_locales as $key => $supported_locale) {
            // Clear cached i_position
            Cache::forget('inventory_module_positions_'.$key);

            Cache::forget('i_position_'.$iposition->id.'_position_'.$key);
        }
    }

    public function iPositionTranslationCreated(IPositionTranslation $iposition_translation)
    {
        $this->clearCaches($iposition_translation);
    }

    public function iPositionTranslationUpdated(IPositionTranslation $iposition_translation)
    {
        $this->clearCaches($iposition_translation);
    }

    public function iPositionTranslationSaved(IPositionTranslation $iposition_translation)
    {
        $this->clearCaches($iposition_translation);
    }

    public function iPositionTranslationDeleted(IPositionTranslation $iposition_translation)
    {
        $this->clearCaches($iposition_translation);
    }

    public function iPositionTranslationRestored(IPositionTranslation $iposition_translation)
    {
        $this->clearCaches($iposition_translation);
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
