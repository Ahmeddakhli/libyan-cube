<?php

namespace Modules\SEO\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\SEO\SeoTranslation;
use Modules\SEO\Seo;
use Cache;
use LaravelLocalization;

class SeoTranslationEvents
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

    private function clearCaches(SeoTranslation $seo_translation)
    {
        // Clearing seo
        $seo = Seo::find($seo_translation->seo_id);
        Cache::forget('seo_' . $seo->id . '_value_' . 'default');
        Cache::forget('seo_' . $seo->id . '_key_words_' . 'default');
        Cache::forget('seo_' . $seo->id . '_short_description_' . 'default');
        Cache::forget('seo_' . $seo->id . '_description_' . 'default');
        Cache::forget('seo_' . $seo->id . '_popup_contact_us_title_' . 'default');
        
        $supported_locales = LaravelLocalization::getSupportedLocales();
        foreach ($supported_locales as $key => $supported_locale) {
            Cache::forget('seo_' . $seo->id . '_value_' . $key);
            Cache::forget('seo_' . $seo->id . '_key_words_' . $key);
            Cache::forget('seo_' . $seo->id . '_short_description_' . $key);
            Cache::forget('seo_' . $seo->id . '_description_' . $key);
            Cache::forget('seo_' . $seo->id . '_popup_contact_us_title_' . $key);
            
        }
    }

    public function seoTranslationCreated(SeoTranslation $seo_translation)
    {
        $this->clearCaches($seo_translation);
    }

    public function seoTranslationUpdated(SeoTranslation $seo_translation)
    {
        $this->clearCaches($seo_translation);
    }

    public function seoTranslationSaved(SeoTranslation $seo_translation)
    {
        $this->clearCaches($seo_translation);
    }

    public function seoTranslationDeleted(SeoTranslation $seo_translation)
    {
        $this->clearCaches($seo_translation);
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
