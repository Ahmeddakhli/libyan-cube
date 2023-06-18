<?php

namespace Modules\Inventory\Http\Controllers\Actions\PaymentMethods;

use Modules\Inventory\IPaymentMethod;
use Modules\Inventory\IPaymentMethodTranslation;
use DB;
use Carbon\Carbon;
use Modules\Inventory\Http\Resources\IPaymentMethodResource;

class UpdateIPaymentMethodAction
{
    public function execute($id, array $data): IPaymentMethodResource
    {
        // Get i_payment_method
        $i_payment_method = IPaymentMethod::find($id);

        // Update/Create translations
        for ($i = 0; $i < count($data['translations']); $i++) {
            // To overcome composite primary key laravel update issue
            $i_payment_method_id = $id;
            $language_id = $data['translations'][$i]['language_id'];
            $payment_method = $data['translations'][$i]['payment_method'];
            $created_at = Carbon::now()->toDateTimeString();
            $updated_at = Carbon::now()->toDateTimeString();

            // Check if translation exists
            $i_payment_method_trnaslation = IPaymentMethodTranslation::where('i_payment_method_id', $i_payment_method_id)->where('language_id', $language_id)->first();

            if ($i_payment_method_trnaslation) {
                DB::table('i_payment_method_trans')->where('i_payment_method_id', $i_payment_method_id)->where('language_id', $language_id)->update([
                    'payment_method' => $payment_method,
                    'updated_at' => $updated_at
                ]);
            } else {
                DB::table('i_payment_method_trans')->insert([
                    'i_payment_method_id' => $i_payment_method_id,
                    'language_id' => $language_id,
                    'payment_method' => $payment_method,
                    'created_at' => $created_at
                ]);
            }
        }

        // Update i_payment_method
        $i_payment_method->update([
            'order' => isset($data['order']) ? $data['order'] : 1,
            'color_class' => isset($data['color_class']) ? $data['color_class'] : $i_payment_method->color_class
        ]);

        // Reload the instance
        $i_payment_method = IPaymentMethod::find($i_payment_method->id);

        // Transform the result
        $i_payment_method = new IPaymentMethodResource($i_payment_method);

        return $i_payment_method;
    }
}
