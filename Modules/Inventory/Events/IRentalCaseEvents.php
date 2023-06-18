<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IRentalCase;
use Cache;

class IRentalCaseEvents
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

    private function clearCaches(IRentalCase $i_rental_case)
    {
        //
    }

    public function iRentalCaseCreated(IRentalCase $i_rental_case)
    {
        $this->clearCaches($i_rental_case);
    }

    public function iRentalCaseUpdated(IRentalCase $i_rental_case)
    {
        $this->clearCaches($i_rental_case);
    }

    public function iRentalCaseSaved(IRentalCase $i_rental_case)
    {
        $this->clearCaches($i_rental_case);
    }

    public function iRentalCaseDeleted(IRentalCase $i_rental_case)
    {
        $this->clearCaches($i_rental_case);
    }

    public function iRentalCaseRestored(IRentalCase $i_rental_case)
    {
        $this->clearCaches($i_rental_case);
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
