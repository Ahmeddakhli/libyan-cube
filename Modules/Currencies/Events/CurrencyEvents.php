<?php

namespace Modules\Currencies\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Currencies\Currency;
use Cache;

class CurrencyEvents
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

    private function clearCaches(Currency $currency)
    {
        // Clearing cached currencies
        Cache::forget('currencies_module_currencies');
    }

    public function currencyCreated(Currency $currency)
    {
        $this->clearCaches($currency);
    }

    public function currencyUpdated(Currency $currency)
    {
        $this->clearCaches($currency);
    }

    public function currencySaved(Currency $currency)
    {
        $this->clearCaches($currency);
    }

    public function currencyDeleted(Currency $currency)
    {
        $this->clearCaches($currency);
    }

    public function currencyRestored(Currency $currency)
    {
        $this->clearCaches($currency);
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
