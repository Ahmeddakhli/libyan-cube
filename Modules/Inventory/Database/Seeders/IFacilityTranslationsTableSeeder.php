<?php

namespace Modules\Inventory\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB, Carbon\Carbon;

class IFacilityTranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('i_facility_trans')->insert([
            ['i_facility_id' => 'a0f74e84-bed0-11ea-b3de-0242ac130004', 'language_id' => 1, 'facility' => 'Parking Space', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_facility_id' => 'a0f74e84-bed0-11ea-b3de-0242ac130004', 'language_id' => 2, 'facility' => 'أماكن لوقوف السيارات', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_facility_id' => 'a0f74f4c-bed0-11ea-b3de-0242ac130004', 'language_id' => 1, 'facility' => 'Power Generator', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_facility_id' => 'a0f74f4c-bed0-11ea-b3de-0242ac130004', 'language_id' => 2, 'facility' => 'مولد طاقة', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_facility_id' => 'a0f7501e-bed0-11ea-b3de-0242ac130004', 'language_id' => 1, 'facility' => 'Satellite Connection', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_facility_id' => 'a0f7501e-bed0-11ea-b3de-0242ac130004', 'language_id' => 2, 'facility' => 'اتصال قمر صناعي', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_facility_id' => 'a0f75226-bed0-11ea-b3de-0242ac130004', 'language_id' => 1, 'facility' => 'Internet Access', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_facility_id' => 'a0f75226-bed0-11ea-b3de-0242ac130004', 'language_id' => 2, 'facility' => 'خدمة الإنترنت', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_facility_id' => 'a0f752f8-bed0-11ea-b3de-0242ac130004', 'language_id' => 1, 'facility' => 'Closed Compound', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_facility_id' => 'a0f752f8-bed0-11ea-b3de-0242ac130004', 'language_id' => 2, 'facility' => 'مجمع مغلق', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
        ]);
    }
}
