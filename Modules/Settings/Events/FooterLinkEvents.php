<?php

namespace Modules\Settings\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Settings\FooterLink;
use Cache;
use LaravelLocalization;

class FooterLinkEvents
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private function clearCaches(FooterLink $footer_link)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();
        Cache::forget('footer_link_' . $footer_link->id . '_value_' . 'default');
        foreach ($supported_locales as $key => $supported_locale) {
            Cache::forget('settings_module_footer_links_'.$key);
            Cache::forget('footer_link_' . $footer_link->id . '_value_' . $key);
        }
    }

    public function footerlinkCreated(FooterLink $footer_link)
    {
        $this->clearCaches($footer_link);
    }

    public function footerlinkUpdated(FooterLink $footer_link)
    {
        $this->clearCaches($footer_link);
    }

    public function footerlinkSaved(FooterLink $footer_link)
    {
        $this->clearCaches($footer_link);
    }

    public function footerlinkDeleted(FooterLink $footer_link)
    {
        $this->clearCaches($footer_link);
    }

    public function footerlinkRestored(FooterLink $footer_link)
    {
        $this->clearCaches($footer_link);
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
