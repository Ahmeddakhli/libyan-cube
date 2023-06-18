<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IPurposeTranslation;
use Modules\Inventory\IPurpose;
use Cache;
use LaravelLocalization;

class IPurposeTypeTranslationEvents
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

    private function clearCaches(IPurposeTranslation $ipurpose_translation)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        // Clearing i_purpose_type
        $i_purpose_type = IPurposeType::find($i_purpose_type_translation->i_purpose_type_id);

        Cache::forget('i_purpose_type_'.$i_purpose_type->id.'_purpose_type_'.'en');

        foreach ($supported_locales as $key => $supported_locale) {
            // Clear cached i_purpose_types
            Cache::forget('inventory_module_purpose_types_'.$key);

            Cache::forget('i_purpose_type_'.$i_purpose_type->id.'_purpose_type_'.$key);
        }
    }

    public function iPurposeTypeTranslationCreated(IPurposeTranslation $ipurpose_translation)
    {
        $this->clearCaches($i_purpose_type_translation);
    }

    public function iPurposeTypeTranslationUpdated(IPurposeTranslation $ipurpose_translation)
    {
        $this->clearCaches($i_purpose_type_translation);
    }

    public function iPurposeTypeTranslationSaved(IPurposeTranslation $ipurpose_translation)
    {
        $this->clearCaches($i_purpose_type_translation);
    }

    public function iPurposeTypeTranslationDeleted(IPurposeTranslation $ipurpose_translation)
    {
        $this->clearCaches($i_purpose_type_translation);
    }

    public function iPurposeTypeTranslationRestored(IPurposeTranslation $ipurpose_translation)
    {
        $this->clearCaches($i_purpose_type_translation);
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
