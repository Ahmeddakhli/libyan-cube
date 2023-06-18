<?php

namespace Modules\Inventory\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB, Carbon\Carbon;

class IOfferingTypeTranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('i_offering_type_trans')->insert([
            ['i_offering_type_id' => 1, 'language_id' => 1, 'offering_type' => 'Rent', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_offering_type_id' => 1, 'language_id' => 2, 'offering_type' => 'للإيجار', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_offering_type_id' => 2, 'language_id' => 1, 'offering_type' => 'Resale', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_offering_type_id' => 2, 'language_id' => 2, 'offering_type' => 'لإعادة البيع', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_offering_type_id' => 3, 'language_id' => 1, 'offering_type' => 'Primary', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_offering_type_id' => 3, 'language_id' => 2, 'offering_type' => 'ابتدائي', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
        ]);
    }
}
