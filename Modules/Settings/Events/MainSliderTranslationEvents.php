<?php

namespace Modules\Settings\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Settings\MainSliderTranslation;
use Modules\Settings\MainSlider;
use Cache;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class MainSliderTranslationEvents
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
    private function clearCaches(MainSliderTranslation $main_slider_translation)
    {
        // Clearing main slider
        $main_slider = MainSlider::find($main_slider_translation->main_slider_id);

        Cache::forget('main_slider_' . $main_slider->id . '_default_value');
        Cache::forget('main_slider_' . $main_slider->id . '_default_description');

        $supported_locales = LaravelLocalization::getSupportedLocales();
        foreach ($supported_locales as $key => $supported_locale) {
            Cache::forget('settings_module_main_sliders_' . $key);
            Cache::forget('main_slider_' . $main_slider->id . '_value_' . $key);
            Cache::forget('main_slider_' . $main_slider->id . '_description_' . $key);
        }
    }

    public function mainsliderTranslationCreated(MainSliderTranslation $main_slider_translation)
    {
        $this->clearCaches($main_slider_translation);
    }

    public function mainsliderTranslationUpdated(MainSliderTranslation $main_slider_translation)
    {
        $this->clearCaches($main_slider_translation);
    }

    public function mainsliderTranslationSaved(MainSliderTranslation $main_slider_translation)
    {
        $this->clearCaches($main_slider_translation);
    }

    public function mainsliderTranslationDeleted(MainSliderTranslation $main_slider_translation)
    {
        $this->clearCaches($main_slider_translation);
    }

    public function mainsliderTranslationRestored(MainSliderTranslation $main_slider_translation)
    {
        $this->clearCaches($main_slider_translation);
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
