<?php

namespace Modules\Settings\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Settings\Contact;
use Cache;
use App, Auth;
use LaravelLocalization;

class ContactEvents
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private function clearCaches(Contact $contact)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();
        foreach ($supported_locales as $key => $supported_locale) {
            // Clear cached contacts
            Cache::forget('settings_module_contacts_'.$key);
        }
    }

    public function contactCreated(Contact $contact)
    {
        $this->clearCaches($contact);
    }

    public function contactUpdated(Contact $contact)
    {
        $this->clearCaches($contact);
    }

    public function contactSaved(Contact $contact)
    {
        $this->clearCaches($contact);
    }

    public function contactDeleted(Contact $contact)
    {
        $this->clearCaches($contact);
    }

    public function contactRestored(Contact $contact)
    {
        $this->clearCaches($contact);
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
