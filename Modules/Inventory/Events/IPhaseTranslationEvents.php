<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IPhaseTranslation;
use Modules\Inventory\IPhase;
use Cache;
use LaravelLocalization;

class IPhaseTranslationEvents
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

    private function clearCaches(IPhaseTranslation $i_phase_translation)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        $i_phase = IPhase::find($i_phase_translation->i_phase_id);

        foreach ($supported_locales as $key => $supported_locale) {
            Cache::forget('inventory_module_phases_'.$key);

            Cache::forget('i_phase_'.$i_phase->id.'_phase_'.$key);
            Cache::forget('i_phase_'.$i_phase->id.'_description_'.$key);
        }
    }

    public function iPhaseTranslationCreated(IPhaseTranslation $i_phase_translation)
    {
        $this->clearCaches($i_phase_translation);
    }

    public function iPhaseTranslationUpdated(IPhaseTranslation $i_phase_translation)
    {
        $this->clearCaches($i_phase_translation);
    }

    public function iPhaseTranslationSaved(IPhaseTranslation $i_phase_translation)
    {
        $this->clearCaches($i_phase_translation);
    }

    public function iPhaseTranslationDeleted(IPhaseTranslation $i_phase_translation)
    {
        $this->clearCaches($i_phase_translation);
    }

    public function iPhaseTranslationRestored(IPhaseTranslation $i_phase_translation)
    {
        $this->clearCaches($i_phase_translation);
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
