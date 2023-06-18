<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IDeveloperTranslation;
use Modules\Inventory\IDeveloper;
use Cache;
use LaravelLocalization;

class IDeveloperTranslationEvents
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

    private function clearCaches(IDeveloperTranslation $i_developer_translation)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        // Clearing i_developer
        $i_developer = IDeveloper::find($i_developer_translation->i_developer_id);

        Cache::forget('i_developer_'.$i_developer->id.'_developer_'.'default');
        Cache::forget('i_developer_'.$i_developer->id.'_description_'.'default');

        foreach ($supported_locales as $key => $supported_locale) {
            // Clear cached i_developers
            Cache::forget('inventory_module_developers_'.$key);

            Cache::forget('i_developer_'.$i_developer->id.'_developer_'.$key);
            Cache::forget('i_developer_'.$i_developer->id.'_description_'.$key);
            Cache::forget('i_developer_'.$i_developer->id.'_meta_description_'.$key);
        }
    }

    public function iDeveloperTranslationCreated(IDeveloperTranslation $i_developer_translation)
    {
        $this->clearCaches($i_developer_translation);
    }

    public function iDeveloperTranslationUpdated(IDeveloperTranslation $i_developer_translation)
    {
        $this->clearCaches($i_developer_translation);
    }

    public function iDeveloperTranslationSaved(IDeveloperTranslation $i_developer_translation)
    {
        $this->clearCaches($i_developer_translation);
    }

    public function iDeveloperTranslationDeleted(IDeveloperTranslation $i_developer_translation)
    {
        $this->clearCaches($i_developer_translation);
    }

    public function iDeveloperTranslationRestored(IDeveloperTranslation $i_developer_translation)
    {
        $this->clearCaches($i_developer_translation);
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
