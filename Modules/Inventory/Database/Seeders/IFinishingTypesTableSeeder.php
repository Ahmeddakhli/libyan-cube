<?php

namespace Modules\Inventory\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB, Carbon\Carbon;

class IFinishingTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('i_finishing_types')->insert([
            ['id' => 1, 'order' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['id' => 2, 'order' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['id' => 3, 'order' => 3, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['id' => 4, 'order' => 4, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['id' => 5, 'order' => 5, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['id' => 6, 'order' => 6, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
        ]);
    }
}
