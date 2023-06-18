<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IPurpose;
use Cache;
use LaravelLocalization;

class IPurposeEvents
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

    private function clearCaches(IPurpose $ipurpose)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        Cache::forget('i_purpose_'.$ipurpose->id.'_purpose_'.'default');

        foreach ($supported_locales as $key => $supported_locale) {
            // Clear cached i_purposes
            Cache::forget('inventory_module_purposes_'.$key);

            Cache::forget('i_purpose_'.$ipurpose->id.'_purpose_'.$key);
        }
    }

    public function iPurposeCreated(IPurpose $ipurpose)
    {
        $this->clearCaches($ipurpose);
    }

    public function iPurposeUpdated(IPurpose $ipurpose)
    {
        $this->clearCaches($ipurpose);
    }

    public function iPurposeSaved(IPurpose $ipurpose)
    {
        $this->clearCaches($ipurpose);
    }

    public function iPurposeDeleted(IPurpose $ipurpose)
    {
        $this->clearCaches($ipurpose);
    }

    public function iPurposeRestored(IPurpose $ipurpose)
    {
        $this->clearCaches($ipurpose);
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
