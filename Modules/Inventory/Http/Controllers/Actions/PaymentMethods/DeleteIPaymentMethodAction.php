<?php

namespace Modules\Inventory\Http\Controllers\Actions\PaymentMethods;

use Modules\Inventory\IPaymentMethod;
use DB;
use Carbon\Carbon;

class DeleteIPaymentMethodAction
{

    public function execute($id)
    {
        // Get the i_payment_method
        $i_payment_method = IPaymentMethod::find($id);

        // Delete the translations manually to overcome laravel issue with composite primary key
        $i_payment_method_translations = $i_payment_method->translations;
        foreach ($i_payment_method_translations as $i_payment_method_translation) {
            $deleted_at = Carbon::now()->toDateTimeString();
            $i_payment_method_id = $i_payment_method_translation->i_payment_method_id;
            $language_id = $i_payment_method_translation->language_id;

            DB::table('i_payment_method_trans')->where('i_payment_method_id', $i_payment_method_id)->where('language_id', $language_id)->update([
                'deleted_at' => $deleted_at
            ]);
        }

        $i_payment_method->delete();

        return null;
    }
}
