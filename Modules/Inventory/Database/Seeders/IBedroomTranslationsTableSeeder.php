<?php

namespace Modules\Inventory\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB, Carbon\Carbon;

class IBedroomTranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('i_bedroom_trans')->insert([
            ['i_bedroom_id' => 1, 'language_id' => 1, 'displayed_text' => 'Studio', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_bedroom_id' => 1, 'language_id' => 2, 'displayed_text' => 'ستوديو', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_bedroom_id' => 2, 'language_id' => 1, 'displayed_text' => '1 Bedroom', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_bedroom_id' => 2, 'language_id' => 2, 'displayed_text' => 'غرفة نوم واحدة', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_bedroom_id' => 3, 'language_id' => 1, 'displayed_text' => '2 Bedrooms', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_bedroom_id' => 3, 'language_id' => 2, 'displayed_text' => 'غرفتان نوم', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_bedroom_id' => 4, 'language_id' => 1, 'displayed_text' => '3 Bedrooms', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_bedroom_id' => 4, 'language_id' => 2, 'displayed_text' => 'ثلاثة غرف نوم', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_bedroom_id' => 5, 'language_id' => 1, 'displayed_text' => '4 Bedrooms', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_bedroom_id' => 5, 'language_id' => 2, 'displayed_text' => 'اربعة غرف نوم', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_bedroom_id' => 6, 'language_id' => 1, 'displayed_text' => '5 Bedrooms', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_bedroom_id' => 6, 'language_id' => 2, 'displayed_text' => 'خمسة غرف نوم', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_bedroom_id' => 7, 'language_id' => 1, 'displayed_text' => '6 Bedrooms', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_bedroom_id' => 7, 'language_id' => 2, 'displayed_text' => 'ست غرف نوم', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_bedroom_id' => 8, 'language_id' => 1, 'displayed_text' => '7 Bedrooms', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_bedroom_id' => 8, 'language_id' => 2, 'displayed_text' => 'سبع غرف نوم', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
        ]);
    }
}
