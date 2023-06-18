<?php

namespace Modules\Inventory\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB, Carbon\Carbon;

class IDesignTypeTranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('i_design_type_trans')->insert([
            ['i_design_type_id' => 1, 'language_id' => 1, 'type' => 'Type A', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_design_type_id' => 1, 'language_id' => 2, 'type' => 'النوع الاول', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_design_type_id' => 2, 'language_id' => 1, 'type' => 'Type B', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_design_type_id' => 2, 'language_id' => 2, 'type' => 'النوع الثاني', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_design_type_id' => 3, 'language_id' => 1, 'type' => 'Type C', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_design_type_id' => 3, 'language_id' => 2, 'type' => 'النوع الثالث', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
        ]);
    }
}
