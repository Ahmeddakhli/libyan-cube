<?php

namespace Modules\ContactUS\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\ContactUS\ContactUs;
use Cache;
use LaravelLocalization;

class ContactUsEvents
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private function clearCaches(ContactUs $contact_us)
    {
        // $supported_locales = LaravelLocalization::getSupportedLocales();
        // foreach ($supported_locales as $key => $supported_locale) {
        //     //
        // }
    }

    public function contactUsCreated(ContactUs $contact_us)
    {
        $this->clearCaches($contact_us);
    }

    public function contactUsUpdated(ContactUs $contact_us)
    {
        $this->clearCaches($contact_us);
    }

    public function contactUsSaved(ContactUs $contact_us)
    {
        $this->clearCaches($contact_us);
    }

    public function contactUsDeleted(ContactUs $contact_us)
    {
        $this->clearCaches($contact_us);
    }

    public function contactUsRestored(ContactUs $contact_us)
    {
        $this->clearCaches($contact_us);
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
