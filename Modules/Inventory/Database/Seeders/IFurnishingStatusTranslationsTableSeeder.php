<?php

namespace Modules\Inventory\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB, Carbon\Carbon;

class IFurnishingStatusTranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('i_furnishing_status_trans')->insert([
            ['i_fur_status_id' => 1, 'language_id' => 1, 'furnishing_status' => 'Furnished', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_fur_status_id' => 1, 'language_id' => 2, 'furnishing_status' => 'مفروشة', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_fur_status_id' => 2, 'language_id' => 1, 'furnishing_status' => 'Unfurnished', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_fur_status_id' => 2, 'language_id' => 2, 'furnishing_status' => 'غير مفروشة', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_fur_status_id' => 3, 'language_id' => 1, 'furnishing_status' => 'Partly Furnished', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_fur_status_id' => 3, 'language_id' => 2, 'furnishing_status' => 'مفروشة جزئيا', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
        ]);
    }
}
