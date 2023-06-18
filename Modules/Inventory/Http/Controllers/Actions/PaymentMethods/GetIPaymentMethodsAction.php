<?php

namespace Modules\Inventory\Http\Controllers\Actions\PaymentMethods;

use Cache;
use Modules\Inventory\IPaymentMethod;
use Modules\Inventory\Http\Resources\IPaymentMethodResource;
use App;

class GetIPaymentMethodsAction
{
    public function execute()
    {
        return Cache::rememberForever('inventory_module_payment_methods_'.App::getLocale(), function () {
            $i_payment_methods = IPaymentMethod::with('translations')->get();

            // Transform the i_payment_methods
            $i_payment_methods = IPaymentMethodResource::collection($i_payment_methods);

            return $i_payment_methods;
        });
    }
}
