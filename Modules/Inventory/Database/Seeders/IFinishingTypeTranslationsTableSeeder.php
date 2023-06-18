<?php

namespace Modules\Inventory\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB, Carbon\Carbon;

class IFinishingTypeTranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('i_finishing_type_trans')->insert([
            ['i_finishing_type_id' => 1, 'language_id' => 1, 'finishing_type' => 'Unfinished', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_finishing_type_id' => 1, 'language_id' => 2, 'finishing_type' => 'غير منتهى', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_finishing_type_id' => 2, 'language_id' => 1, 'finishing_type' => 'Fully Finished', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_finishing_type_id' => 2, 'language_id' => 2, 'finishing_type' => 'انتهى بالكامل', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_finishing_type_id' => 3, 'language_id' => 1, 'finishing_type' => 'Super Lux', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_finishing_type_id' => 3, 'language_id' => 2, 'finishing_type' => 'سوبر لوكس', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_finishing_type_id' => 4, 'language_id' => 1, 'finishing_type' => 'Ultra Super Lux', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_finishing_type_id' => 4, 'language_id' => 2, 'finishing_type' => 'الترا سوبر لوكس', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_finishing_type_id' => 5, 'language_id' => 1, 'finishing_type' => 'Core Shell', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_finishing_type_id' => 5, 'language_id' => 2, 'finishing_type' => 'كور شل', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_finishing_type_id' => 6, 'language_id' => 1, 'finishing_type' => 'Semi Finished', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_finishing_type_id' => 6, 'language_id' => 2, 'finishing_type' => 'نصف تشطيب', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
        ]);
    }
}
