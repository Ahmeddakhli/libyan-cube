<?php

namespace Modules\Inventory\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB, Carbon\Carbon;

class IPaymentMethodTranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('i_payment_method_trans')->insert([
            ['i_payment_method_id' => 1, 'language_id' => 1, 'payment_method' => 'Cash', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_payment_method_id' => 1, 'language_id' => 2, 'payment_method' => 'نقدا', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_payment_method_id' => 2, 'language_id' => 1, 'payment_method' => 'Installments', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_payment_method_id' => 2, 'language_id' => 2, 'payment_method' => 'الأقساط', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
        ]);
    }
}
