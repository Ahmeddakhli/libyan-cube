<?php

namespace Modules\Settings\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Settings\HowWorkTranslation;
use Modules\Settings\HowWork;
use Cache;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class HowWorkTranslationEvents
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
    private function clearCaches(HowWorkTranslation $how_work_translation)
    {
        // Clearing how work
        $how_work = HowWork::find($how_work_translation->how_work_id);

        Cache::forget('how_work_' . $how_work->id . '_default_value');
        Cache::forget('how_work_' . $how_work->id . '_default_description');

        $supported_locales = LaravelLocalization::getSupportedLocales();
        foreach ($supported_locales as $key => $supported_locale) {
            Cache::forget('settings_module_how_works_' . $key);
            Cache::forget('how_work_' . $how_work->id . '_value_' . $key);
            Cache::forget('how_work_' . $how_work->id . '_description_' . $key);
        }
    }

    public function howWorkTranslationCreated(HowWorkTranslation $how_work_translation)
    {
        $this->clearCaches($how_work_translation);
    }

    public function howWorkTranslationUpdated(HowWorkTranslation $how_work_translation)
    {
        $this->clearCaches($how_work_translation);
    }

    public function howWorkTranslationSaved(HowWorkTranslation $how_work_translation)
    {
        $this->clearCaches($how_work_translation);
    }

    public function howWorkTranslationDeleted(HowWorkTranslation $how_work_translation)
    {
        $this->clearCaches($how_work_translation);
    }

    public function howWorkTranslationRestored(HowWorkTranslation $how_work_translation)
    {
        $this->clearCaches($how_work_translation);
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
