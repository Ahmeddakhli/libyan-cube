<?php

namespace Modules\Settings\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Settings\FooterLinkTranslation;
use Modules\Settings\FooterLink;
use Cache;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class FooterLinksTranslationEvents
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private function clearCaches(FooterLinkTranslation $footer_link_translation)
    {
        // Clearing footer link
        $footer_link = FooterLink::find($footer_link_translation->footer_link_id);
        Cache::forget('footer_link_' . $footer_link->id . '_value_' . 'default');
        $supported_locales = LaravelLocalization::getSupportedLocales();
        foreach ($supported_locales as $key => $supported_locale) {
            Cache::forget('settings_module_footer_links_'.$key);
            Cache::forget('footer_link_' . $footer_link->id . '_value_' . $key);
        }
    }

    public function footerlinkTranslationCreated(FooterLinkTranslation $footer_link_translation)
    {
        $this->clearCaches($footer_link_translation);
    }

    public function footerlinkTranslationUpdated(FooterLinkTranslation $footer_link_translation)
    {
        $this->clearCaches($footer_link_translation);
    }

    public function footerlinkTranslationSaved(FooterLinkTranslation $footer_link_translation)
    {
        $this->clearCaches($footer_link_translation);
    }

    public function footerlinkTranslationDeleted(FooterLinkTranslation $footer_link_translation)
    {
        $this->clearCaches($footer_link_translation);
    }

    public function footerlinkTranslationRestored(FooterLinkTranslation $footer_link_translation)
    {
        $this->clearCaches($footer_link_translation);
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
