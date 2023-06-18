<?php

namespace Modules\Inventory\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB, Carbon\Carbon;

class IPurposeTranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('i_purpose_trans')->insert([
            ['i_purpose_id' => 1, 'language_id' => 1, 'purpose' => 'Bussiness', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_id' => 1, 'language_id' => 2, 'purpose' => 'أعمال', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_id' => 2, 'language_id' => 1, 'purpose' => 'Tourist', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_id' => 2, 'language_id' => 2, 'purpose' => 'سياحى', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_id' => 3, 'language_id' => 1, 'purpose' => 'Residential', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_id' => 3, 'language_id' => 2, 'purpose' => 'سكني', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
        ]);
    }
}
