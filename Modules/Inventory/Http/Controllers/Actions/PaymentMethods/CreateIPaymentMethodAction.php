<?php

namespace Modules\Inventory\Http\Controllers\Actions\PaymentMethods;

use Modules\Inventory\IPaymentMethod;
use Modules\Inventory\IPaymentMethodTranslation;
use DB;
use Carbon\Carbon;
use Modules\Inventory\Http\Resources\IPaymentMethodResource;

class CreateIPaymentMethodAction
{
    public function execute(array $data): IPaymentMethodResource
    {
        // Create payment method
        $i_payment_method = IPaymentMethod::create([
            'order' => isset($data['order']) ? $data['order'] : 1,
            'color_class' => isset($data['color_class']) ? $data['color_class'] : null
        ]);

        // Create translations
        for ($i = 0; $i < count($data['translations']); $i++) {
            // To overcome composite primary key laravel insertion issue
            $i_payment_method_id = $i_payment_method->id;
            $language_id = $data['translations'][$i]['language_id'];
            $payment_method = $data['translations'][$i]['payment_method'];
            $created_at = Carbon::now()->toDateTimeString();

            DB::table('i_payment_method_trans')->insert([
                'i_payment_method_id' => $i_payment_method_id,
                'language_id' => $language_id,
                'payment_method' => $payment_method,
                'created_at' => $created_at
            ]);
        }

        // Trigger update event on i_payment_method to cache its values
        $i_payment_method->update();

        // Reload the instance
        $i_payment_method = IPaymentMethod::find($i_payment_method->id);

        // Transform the result
        $i_payment_method = new IPaymentMethodResource($i_payment_method);

        return $i_payment_method;
    }
}
