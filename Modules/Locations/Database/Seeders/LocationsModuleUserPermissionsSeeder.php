<?php

namespace Modules\Locations\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LocationsModuleUserPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('user_permissions')->insert([

            // Technical Support User Permissions
            ['user_id' => 1, 'permission_id' => 363, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 364, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 365, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 366, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 367, 'created_at' => Carbon::now()],


            // General Manager User Permissions
            ['user_id' => 2, 'permission_id' => 363, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 364, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 365, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 366, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 367, 'created_at' => Carbon::now()],

        ]);
    }
}
