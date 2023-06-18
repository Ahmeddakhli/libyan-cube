<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\ISellRequest;
use Cache;

class ISellRequestEvents
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private function clearCaches(ISellRequest $i_sell_request)
    {
        //
    }

    public function iSellRequestCreated(ISellRequest $i_sell_request)
    {
        $this->clearCaches($i_sell_request);
    }

    public function iSellRequestUpdated(ISellRequest $i_sell_request)
    {
        $this->clearCaches($i_sell_request);
    }

    public function iSellRequestSaved(ISellRequest $i_sell_request)
    {
        $this->clearCaches($i_sell_request);
    }

    public function iSellRequestDeleted(ISellRequest $i_sell_request)
    {
        $this->clearCaches($i_sell_request);
    }

    public function iSellRequestRestored(ISellRequest $i_sell_request)
    {
        $this->clearCaches($i_sell_request);
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
