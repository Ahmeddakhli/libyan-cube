<?php

namespace Modules\Locations\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LocationsModulePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        
        $module_id = DB::table('modules')->where('name','Locations Module')->first()->id;

        DB::table('permissions')->insert([
            // Manage Locations
            [
                'id' => 363,
                'parent_id' => null,
                'name' => 'Manage locations',
                'slug' => 'manage-locations',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 364,
                'parent_id' => 363,
                'name' => 'Index locations',
                'slug' => 'index-locations',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 365,
                'parent_id' => 363,
                'name' => 'Create location',
                'slug' => 'create-location',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 366,
                'parent_id' => 363,
                'name' => 'Update location',
                'slug' => 'update-location',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 367,
                'parent_id' => 363,
                'name' => 'Delete location',
                'slug' => 'delete-location',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
        ]);
    }
}
