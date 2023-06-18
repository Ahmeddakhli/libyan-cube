<?php

namespace Modules\Careers\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Careers\CareerTranslation;
use Modules\Careers\Career;
use Cache;
use LaravelLocalization;

class CareerTranslationEvents
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

    private function clearCaches(CareerTranslation $career_translation)
    {
        // Clearing career
        $career = Career::find($career_translation->career_id);
        Cache::forget('careers_'.$career->id.'_value_'.'default');
        Cache::forget('careers_'.$career->id.'_description_'.'default');
        $supported_locales = LaravelLocalization::getSupportedLocales();
        foreach ($supported_locales as $key => $supported_locale) {
            Cache::forget('careers_'.$career->id.'_value_'.$key);
            Cache::forget('careers_'.$career->id.'_description_'.$key);
            Cache::forget('careers_'.$career->id.'_meta_title_'.$key);
            Cache::forget('careers_'.$career->id.'_meta_description_'.$key);
        }
    }

    public function careerTranslationCreated(CareerTranslation $career_translation)
    {
        $this->clearCaches($career_translation);
    }

    public function careerTranslationUpdated(CareerTranslation $career_translation)
    {
        $this->clearCaches($career_translation);
    }

    public function careerTranslationSaved(CareerTranslation $career_translation)
    {
        $this->clearCaches($career_translation);
    }

    public function careerTranslationDeleted(CareerTranslation $career_translation)
    {
        $this->clearCaches($career_translation);
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
