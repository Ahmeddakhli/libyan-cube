<?php

namespace Modules\Locations\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Arr;

class LocationsDatabaseSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();
        $this->call(LocationsModuleModuleSeeder::class);
        $this->call(LocationsModulePermissionsSeeder::class);
        $this->call(LocationsModuleUserPermissionsSeeder::class);
        $this->call(LocationsModuleGroupPermissionsSeeder::class);
        ini_set('memory_limit', '2048M'); // Allocate memory
        DB::disableQueryLog(); // Disable log


        $entries = [
            [
                "id" => "46",
                "created_at" => "2019-03-08 15:45:48",
                "updated_at" => "2019-03-08 15:45:48",
                "parent_id" => null,
                "slug" => "country",
                "code" => null,
                "is_active" => false,
                "order" => 0,
                "deleted_at" => null
            ],
            [
                "id" => "110",
                "created_at" => "2019-03-08 15:45:51",
                "updated_at" => "2019-03-08 15:45:51",
                "parent_id" => "46",
                "slug" => "EG",
                "code" => "20",
                "is_active" => true,
                "order" => 0,
                "deleted_at" => null
            ],
            [
                "id" => "52726",
                "created_at" => "2019-03-08 16:27:08",
                "updated_at" => "2019-03-08 16:27:08",
                "parent_id" => "110",
                "slug" => "cairo",
                "code" => "20",
                "is_active" => true,
                "order" => 0,
                "deleted_at" => null
            ],
            [
                "id" => "52758",
                "created_at" => "2019-03-08 16:27:09",
                "updated_at" => "2019-03-08 16:27:09",
                "parent_id" => "52726",
                "slug" => "tagamoa-el-khames",
                "code" => "20",
                "is_active" => true,
                "order" => 0,
                "deleted_at" => null
            ],
            [
                "id" => "52759",
                "created_at" => "2019-03-08 16:27:09",
                "updated_at" => "2019-03-08 16:27:09",
                "parent_id" => "52726",
                "slug" => "zamalik",
                "code" => "20",
                "is_active" => true,
                "order" => 0,
                "deleted_at" => null
            ],

        ];

        DB::table('locations')->insert($entries);
        DB::table('location_trans')->insert([
            [
                'location_id' => 110,
                'language_id' => 1,
                'name' => "Egypt",
                "created_at" => "2019-03-08 16:27:26",
                "updated_at" => "2019-03-08 16:27:26",
            ],
            [
                'location_id' => 110,
                'language_id' => 2,
                'name' => "مصر",
                "created_at" => "2019-03-08 16:27:26",
                "updated_at" => "2019-03-08 16:27:26",
            ],
            [
                'location_id' => 52726,
                'language_id' => 1,
                'name' => "Cairo",
                "created_at" => "2019-03-08 16:27:26",
                "updated_at" => "2019-03-08 16:27:26",
            ],
            [
                'location_id' => 52726,
                'language_id' => 2,
                'name' => "القاهرة",
                "created_at" => "2019-03-08 16:27:26",
                "updated_at" => "2019-03-08 16:27:26",
            ],
            [
                'location_id' => 52758,
                'language_id' => 1,
                'name' => "Tagamoa El Khames",
                "created_at" => "2019-03-08 16:27:26",
                "updated_at" => "2019-03-08 16:27:26",
            ],
            [
                'location_id' => 52758,
                'language_id' => 2,
                'name' => "التجمع الخامس",
                "created_at" => "2019-03-08 16:27:26",
                "updated_at" => "2019-03-08 16:27:26",
            ],
            [
                'location_id' => 52759,
                'language_id' => 1,
                'name' => "Zamalik",
                "created_at" => "2019-03-08 16:27:26",
                "updated_at" => "2019-03-08 16:27:26",
            ],
            [
                'location_id' => 52759,
                'language_id' => 2,
                'name' => "الزمالك",
                "created_at" => "2019-03-08 16:27:26",
                "updated_at" => "2019-03-08 16:27:26",
            ],
        ]);
    }
}
