<?php

namespace Modules\KeyWords\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\KeyWords\KeyWord;
use Cache;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class KeyWordEvents
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
    }
    private function clearCaches(KeyWord $key_word)
    {
        // Get locale
        $supported_locales = LaravelLocalization::getSupportedLocales();

        // Clear event cache for every locale
        foreach ($supported_locales as $key => $supported_locale) {
            Cache::forget('key_word_' . $key_word->id . '_value_' . $key);
        }
    }

    public function keyWordCreated(KeyWord $key_word)
    {
        $this->clearCaches($key_word);
    }
    
    public function keyWordUpdated(KeyWord $key_word)
    {
        $this->clearCaches($key_word);
    }

    public function keyWordSaved(KeyWord $key_word)
    {
        $this->clearCaches($key_word);
    }

    public function keyWordDeleted(KeyWord $key_word)
    {
        $this->clearCaches($key_word);
    }

    public function keyWordRestored(KeyWord $key_word)
    {
        $this->clearCaches($key_word);
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
