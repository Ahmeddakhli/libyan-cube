<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IPhase;
use Cache;
use LaravelLocalization;

class IPhaseEvents
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

    private function clearCaches(IPhase $i_phase)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        foreach ($supported_locales as $key => $supported_locale) {
            // Clear cached phases
            Cache::forget('inventory_module_phases_'.$key);

            Cache::forget('i_phase_'.$i_phase->id.'_phase_'.$key);
            Cache::forget('i_phase_'.$i_phase->id.'_description_'.$key);
        }
    }

    public function iPhaseCreated(IPhase $i_phase)
    {
        $this->clearCaches($i_phase);
    }

    public function iPhaseUpdated(IPhase $i_phase)
    {
        $this->clearCaches($i_phase);
    }

    public function iPhaseSaved(IPhase $i_phase)
    {
        $this->clearCaches($i_phase);
    }

    public function iPhaseDeleted(IPhase $i_phase)
    {
        $this->clearCaches($i_phase);
    }

    public function iPhaseRestored(IPhase $i_phase)
    {
        $this->clearCaches($i_phase);
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
