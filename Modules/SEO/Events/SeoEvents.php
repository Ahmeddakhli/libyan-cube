<?php

namespace Modules\SEO\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\SEO\Seo;
use Cache;
use LaravelLocalization;

class SeoEvents
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

    private function clearCaches(Seo $seo)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();
        Cache::forget('seo_'.$seo->id.'_value_'.'default');
        Cache::forget('seo_'.$seo->id.'_key_words_'.'default');
        Cache::forget('seo_'.$seo->id.'_short_description_'.'default');
        Cache::forget('seo_'.$seo->id.'_description_'.'default');
        Cache::forget('seo_'.$seo->id.'_popup_contact_us_title_'.'default');
        
        foreach ($supported_locales as $key => $supported_locale) {
            Cache::forget('seo_'.$seo->id.'_value_'.$key);
            Cache::forget('seo_'.$seo->id.'_key_words_'.$key);
            Cache::forget('seo_'.$seo->id.'_short_description_'.$key);
            Cache::forget('seo_'.$seo->id.'_description_'.$key);
            Cache::forget('seo_'.$seo->id.'_popup_contact_us_title_'.$key);
        }
    }

    public function seoCreated(Seo $seo)
    {
        $this->clearCaches($seo);
    }

    public function seoUpdated(Seo $seo)
    {
        $this->clearCaches($seo);
    }

    public function seoSaved(Seo $seo)
    {
        $this->clearCaches($seo);
    }

    public function seoDeleted(Seo $seo)
    {
        $this->clearCaches($seo);
    }

    public function seoRestored(Seo $seo)
    {
        $this->clearCaches($seo);
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
