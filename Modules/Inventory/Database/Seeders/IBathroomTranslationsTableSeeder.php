<?php

namespace Modules\Inventory\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB, Carbon\Carbon;

class IBathroomTranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('i_bathroom_trans')->insert([
            ['i_bathroom_id' => 1, 'language_id' => 1, 'displayed_text' => '1 Bathroom', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_bathroom_id' => 1, 'language_id' => 2, 'displayed_text' => 'حمام واحد', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_bathroom_id' => 2, 'language_id' => 1, 'displayed_text' => '2 Bathrooms', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_bathroom_id' => 2, 'language_id' => 2, 'displayed_text' => 'حمامان', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_bathroom_id' => 3, 'language_id' => 1, 'displayed_text' => '3 Bathrooms', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_bathroom_id' => 3, 'language_id' => 2, 'displayed_text' => 'ثلاثة حمامات', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_bathroom_id' => 4, 'language_id' => 1, 'displayed_text' => '4 Bathrooms', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_bathroom_id' => 4, 'language_id' => 2, 'displayed_text' => 'اربعة حمامات', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_bathroom_id' => 5, 'language_id' => 1, 'displayed_text' => '5 Bathrooms', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_bathroom_id' => 5, 'language_id' => 2, 'displayed_text' => 'خمسة حمامات', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
        ]);
    }
}
