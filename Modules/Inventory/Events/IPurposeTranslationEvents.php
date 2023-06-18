<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\BUPurposeTranslation;
use Modules\Inventory\BUPurpose;
use Cache;
use LaravelLocalization;

class IPurposeTranslationEvents
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

    private function clearCaches(BUPurposeTranslation $ipurpose_translation)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        // Clearing i_purpose
        $ipurpose = IPurpose::find($ipurpose_translation->i_purpose_id);
        Cache::forget('i_purpose_'.$ipurpose->id.'_purpose_'.'default');

        foreach ($supported_locales as $key => $supported_locale) {
            // Clear cached i_purposes
            Cache::forget('inventory_module_purposes_'.$key);

            Cache::forget('i_purpose_'.$ipurpose->id.'_purpose_'.$key);
        }
    }

    public function iPurposeTranslationCreated(BUPurposeTranslation $ipurpose_translation)
    {
        $this->clearCaches($ipurpose_translation);
    }

    public function iPurposeTranslationUpdated(BUPurposeTranslation $ipurpose_translation)
    {
        $this->clearCaches($ipurpose_translation);
    }

    public function iPurposeTranslationSaved(BUPurposeTranslation $ipurpose_translation)
    {
        $this->clearCaches($ipurpose_translation);
    }

    public function iPurposeTranslationDeleted(BUPurposeTranslation $ipurpose_translation)
    {
        $this->clearCaches($ipurpose_translation);
    }

    public function iPurposeTranslationRestored(BUPurposeTranslation $ipurpose_translation)
    {
        $this->clearCaches($ipurpose_translation);
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
