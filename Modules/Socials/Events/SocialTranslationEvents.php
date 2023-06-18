<?php

namespace Modules\Socials\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Socials\SocialTranslation;
use Modules\Socials\Social;
use Cache;
use LaravelLocalization;

class SocialTranslationEvents
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

    private function clearCaches(SocialTranslation $social_translation)
    {
        // Clearing social
        $social = Social::find($social_translation->social_id);

        $supported_locales = LaravelLocalization::getSupportedLocales();
        foreach ($supported_locales as $key => $supported_locale) {
            Cache::forget('socials_'.$social->id.'_value_'.$key);
        }
    }

    public function socialTranslationCreated(SocialTrnaslation $social_translation)
    {
        $this->clearCaches($socil_translation);
    }

    public function socialTranslationUpdated(SocialTrnaslation $social_translation)
    {
        $this->clearCaches($socil_translation);
    }

    public function socialTranslationSaved(SocialTrnaslation $social_translation)
    {
        $this->clearCaches($socil_translation);
    }

    public function socialTranslationDeleted(SocialTrnaslation $social_translation)
    {
        $this->clearCaches($socil_translation);
    }

    public function socialTranslationRestored(SocialTrnaslation $social_translation)
    {
        $this->clearCaches($socil_translation);
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
