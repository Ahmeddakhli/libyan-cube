<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IUnitImage;
use Cache;
use LaravelLocalization;

class IUnitImageEvents
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private function clearCaches(IUnitImage $i_unit_image)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        foreach ($supported_locales as $key => $supported_locale) {
            Cache::forget('i_unit_image' . $i_unit_image->id . '_title_' . $key);
        }
    }

    public function iUnitImageCreated(IUnitImage $i_unit_image)
    {
        $this->clearCaches($i_unit_image);
    }

    public function iUnitImageUpdated(IUnitImage $i_unit_image)
    {
        $this->clearCaches($i_unit_image);
    }

    public function iUnitImageSaved(IUnitImage $i_unit_image)
    {
        $this->clearCaches($i_unit_image);
    }

    public function iUnitImageDeleted(IUnitImage $i_unit_image)
    {
        $this->clearCaches($i_unit_image);
    }

    public function iUnitImageRestored(IUnitImage $i_unit_image)
    {
        $this->clearCaches($i_unit_image);
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
