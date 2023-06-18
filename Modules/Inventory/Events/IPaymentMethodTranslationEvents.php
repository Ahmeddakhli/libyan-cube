<?php

namespace Modules\Inventory\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Modules\Inventory\IPaymentMethodTranslation;
use Modules\Inventory\IPaymentMethod;
use Cache;
use LaravelLocalization;

class IPaymentMethodTranslationEvents
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

    private function clearCaches(IPaymentMethodTranslation $ipayment_method_translation)
    {
        $supported_locales = LaravelLocalization::getSupportedLocales();

        // Clearing i_payment_method
        $ipayment_method = IPaymentMethod::find($ipayment_method_translation->i_payment_method_id);

        foreach ($supported_locales as $key => $supported_locale) {
            // Clear cached i_payment_method
            Cache::forget('inventory_module_payment_methods_'.$key);

            Cache::forget('i_payment_method_'.$ipayment_method->id.'_payment_method_'.$key);
        }
    }

    public function iPaymentMethodTranslationCreated(IPaymentMethodTranslation $ipayment_method_translation)
    {
        $this->clearCaches($ipayment_method_translation);
    }

    public function iPaymentMethodTranslationUpdated(IPaymentMethodTranslation $ipayment_method_translation)
    {
        $this->clearCaches($ipayment_method_translation);
    }

    public function iPaymentMethodTranslationSaved(IPaymentMethodTranslation $ipayment_method_translation)
    {
        $this->clearCaches($ipayment_method_translation);
    }

    public function iPaymentMethodTranslationDeleted(IPaymentMethodTranslation $ipayment_method_translation)
    {
        $this->clearCaches($ipayment_method_translation);
    }

    public function iPaymentMethodTranslationRestored(IPaymentMethodTranslation $ipayment_method_translation)
    {
        $this->clearCaches($ipayment_method_translation);
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
