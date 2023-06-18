<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IPosition;
use Cache;
use LaravelLocalization;

class IPositionEvents
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

    private function clearCaches(IPosition $iposition)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        foreach ($supported_locales as $key => $supported_locale) {
            // Clear cached i_positions
            Cache::forget('inventory_module_positions_'.$key);

            Cache::forget('i_position_'.$iposition->id.'_position_'.$key);
        }
    }

    public function iPositionCreated(IPosition $iposition)
    {
        $this->clearCaches($iposition);
    }

    public function iPositionUpdated(IPosition $iposition)
    {
        $this->clearCaches($iposition);
    }

    public function iPositionSaved(IPosition $iposition)
    {
        $this->clearCaches($iposition);
    }

    public function iPositionDeleted(IPosition $iposition)
    {
        $this->clearCaches($iposition);
    }

    public function iPositionRestored(IPosition $iposition)
    {
        $this->clearCaches($iposition);
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
