<?php

namespace Modules\KeyWords\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\KeyWords\KeyWordTranslation;
use Modules\KeyWords\KeyWord;
use Cache;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class KeyWordTranslationEvents
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

    private function clearCaches(KeyWordTranslation $key_word_translation)
    {   
        // Get event 
        $key_word = KeyWord::find($key_word_translation->key_word_id);

        // Get locale
        $supported_locales = LaravelLocalization::getSupportedLocales();

        // Clear event cache for every locale
        foreach ($supported_locales as $key => $supported_locale) {
            Cache::forget('key_word_' . $key_word->id . '_value_' . $key);
        }
    }

    public function keyWordTranslationCreated(KeyWordTranslation $key_word_translation)
    {
        $this->clearCaches($key_word_translation);
    }

    public function keyWordTranslationUpdated(KeyWordTranslation $key_word_translation)
    {
        $this->clearCaches($key_word_translation);
    }

    public function keyWordTranslationSaved(KeyWordTranslation $key_word_translation)
    {
        $this->clearCaches($key_word_translation);
    }

    public function keyWordTranslationDeleted(KeyWordTranslation $key_word_translation)
    {
        $this->clearCaches($key_word_translation);
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
