<?php

namespace Modules\Inventory\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB, Carbon\Carbon;

class IAreaUnitTranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('i_area_unit_trans')->insert([
            ['i_area_unit_id' => 1, 'language_id' => 1, 'area_unit' => 'm2', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_area_unit_id' => 1, 'language_id' => 2, 'area_unit' => 'م2', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_area_unit_id' => 2, 'language_id' => 1, 'area_unit' => 'Square Foot', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_area_unit_id' => 2, 'language_id' => 2, 'area_unit' => 'قدم مربع', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_area_unit_id' => 3, 'language_id' => 1, 'area_unit' => 'Acre', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_area_unit_id' => 3, 'language_id' => 2, 'area_unit' => 'فدان', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
        ]);
    }
}
