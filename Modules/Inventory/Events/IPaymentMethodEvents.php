<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IPaymentMethod;
use Cache;
use LaravelLocalization;

class IPaymentMethodEvents
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

    private function clearCaches(IPaymentMethod $ipayment_method)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        foreach ($supported_locales as $key => $supported_locale) {
            // Clear cached i_payment_methods
            Cache::forget('inventory_module_payment_methods_'.$key);

            Cache::forget('i_payment_method_'.$ipayment_method->id.'_payment_method_'.$key);
        }
    }

    public function iPaymentMethodCreated(IPaymentMethod $ipayment_method)
    {
        $this->clearCaches($ipayment_method);
    }

    public function iPaymentMethodUpdated(IPaymentMethod $ipayment_method)
    {
        $this->clearCaches($ipayment_method);
    }

    public function iPaymentMethodSaved(IPaymentMethod $ipayment_method)
    {
        $this->clearCaches($ipayment_method);
    }

    public function iPaymentMethodDeleted(IPaymentMethod $ipayment_method)
    {
        $this->clearCaches($ipayment_method);
    }

    public function iPaymentMethodRestored(IPaymentMethod $ipayment_method)
    {
        $this->clearCaches($ipayment_method);
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
