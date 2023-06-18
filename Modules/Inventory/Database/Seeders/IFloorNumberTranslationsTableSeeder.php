<?php

namespace Modules\Inventory\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB, Carbon\Carbon;

class IFloorNumberTranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('i_floor_number_trans')->insert([
            ['i_floor_number_id' => 1, 'language_id' => 1, 'displayed_text' => 'Basement', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 1, 'language_id' => 2, 'displayed_text' => 'القبو', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 2, 'language_id' => 1, 'displayed_text' => 'Ground', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 2, 'language_id' => 2, 'displayed_text' => 'ارضى', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 3, 'language_id' => 1, 'displayed_text' => 'Floor 1', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 3, 'language_id' => 2, 'displayed_text' => 'الدور الاول', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 4, 'language_id' => 1, 'displayed_text' => 'Floor 2', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 4, 'language_id' => 2, 'displayed_text' => 'الدور الثانى', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 5, 'language_id' => 1, 'displayed_text' => 'Floor 3', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 5, 'language_id' => 2, 'displayed_text' => 'الدور الثالث', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 6, 'language_id' => 1, 'displayed_text' => 'Floor 4', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 6, 'language_id' => 2, 'displayed_text' => 'الدور الرابع', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 7, 'language_id' => 1, 'displayed_text' => 'Floor 5', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 7, 'language_id' => 2, 'displayed_text' => 'الدور الخامس', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 8, 'language_id' => 1, 'displayed_text' => 'Floor 6', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 8, 'language_id' => 2, 'displayed_text' => 'الدور السادس', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 9, 'language_id' => 1, 'displayed_text' => 'Floor 7', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 9, 'language_id' => 2, 'displayed_text' => 'الدور السابع', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 10, 'language_id' => 1, 'displayed_text' => 'Floor 8', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 10, 'language_id' => 2, 'displayed_text' => 'الدور الثامن', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 11, 'language_id' => 1, 'displayed_text' => 'Floor 9', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 11, 'language_id' => 2, 'displayed_text' => 'الدور التاسع', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 12, 'language_id' => 1, 'displayed_text' => 'Floor 10', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 12, 'language_id' => 2, 'displayed_text' => 'الدور العاشر', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 13, 'language_id' => 1, 'displayed_text' => 'Floor 11', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 13, 'language_id' => 2, 'displayed_text' => 'الدور الحادى عشر', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 14, 'language_id' => 1, 'displayed_text' => 'Floor 12', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 14, 'language_id' => 2, 'displayed_text' => 'الدور الثانى عشر', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 15, 'language_id' => 1, 'displayed_text' => 'Floor 13', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 15, 'language_id' => 2, 'displayed_text' => 'الدور الثالث عشر', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 16, 'language_id' => 1, 'displayed_text' => 'Floor 14', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 16, 'language_id' => 2, 'displayed_text' => 'الدور الرابع عشر', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 17, 'language_id' => 1, 'displayed_text' => 'Floor 15', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 17, 'language_id' => 2, 'displayed_text' => 'الدور الخامس عشر', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 18, 'language_id' => 1, 'displayed_text' => 'Floor 16', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 18, 'language_id' => 2, 'displayed_text' => 'الدور السادس عشر', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 19, 'language_id' => 1, 'displayed_text' => 'Floor 17', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 19, 'language_id' => 2, 'displayed_text' => 'الدور السابع عشر', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 20, 'language_id' => 1, 'displayed_text' => 'Floor 18', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 20, 'language_id' => 2, 'displayed_text' => 'الدور الثامن عشر', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 21, 'language_id' => 1, 'displayed_text' => 'Floor 19', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 21, 'language_id' => 2, 'displayed_text' => 'الدور التاسع عشر', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 22, 'language_id' => 1, 'displayed_text' => 'Floor 20', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 22, 'language_id' => 2, 'displayed_text' => 'الدور العشرين', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 23, 'language_id' => 1, 'displayed_text' => 'Floor 21', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 23, 'language_id' => 2, 'displayed_text' => 'الدور الحادى والعشرين', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 24, 'language_id' => 1, 'displayed_text' => 'Floor 22', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 24, 'language_id' => 2, 'displayed_text' => 'الدور الثانى والعشرين', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 25, 'language_id' => 1, 'displayed_text' => 'Floor 23', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 25, 'language_id' => 2, 'displayed_text' => 'الدور الثالث والعشرين', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 26, 'language_id' => 1, 'displayed_text' => 'Floor 24', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 26, 'language_id' => 2, 'displayed_text' => 'الدور الرابع والعشرين', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 27, 'language_id' => 1, 'displayed_text' => 'Floor 25', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 27, 'language_id' => 2, 'displayed_text' => 'الدور الخامس والعشرين', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 28, 'language_id' => 1, 'displayed_text' => 'Floor 26', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 28, 'language_id' => 2, 'displayed_text' => 'الدور السادس والعشرين', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 29, 'language_id' => 1, 'displayed_text' => 'Floor 27', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 29, 'language_id' => 2, 'displayed_text' => 'الدور السابع والعشرين', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 30, 'language_id' => 1, 'displayed_text' => 'Floor 28', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 30, 'language_id' => 2, 'displayed_text' => 'الدور الثامن والعشرين', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 31, 'language_id' => 1, 'displayed_text' => 'Floor 29', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 31, 'language_id' => 2, 'displayed_text' => 'الدور التاسع والعشرين', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 32, 'language_id' => 1, 'displayed_text' => 'Floor 30', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 32, 'language_id' => 2, 'displayed_text' => 'الدور الثلاثسن', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 33, 'language_id' => 1, 'displayed_text' => 'Roof', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_floor_number_id' => 33, 'language_id' => 2, 'displayed_text' => 'السطح', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
        ]);
    }
}
