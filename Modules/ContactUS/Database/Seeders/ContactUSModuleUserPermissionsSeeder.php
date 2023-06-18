<?php

namespace Modules\ContactUS\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ContactUSModuleUserPermissionsSeeder extends Seeder
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
            ['user_id' => 1, 'permission_id' => 313, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 314, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 315, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 316, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 317, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 408, 'created_at' => Carbon::now()],

            // General Manager User Permissions
            ['user_id' => 2, 'permission_id' => 313, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 314, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 315, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 316, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 317, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 408, 'created_at' => Carbon::now()],

            // Subscribe
            // Technical Support Group Permissions
            ['user_id' => 1, 'permission_id' => 398, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 399, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 400, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 401, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 402, 'created_at' => Carbon::now()],

            // General Manager Group Permissions
            ['user_id' => 2, 'permission_id' => 398, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 399, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 400, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 401, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 402, 'created_at' => Carbon::now()],
        ]);
    }
}
