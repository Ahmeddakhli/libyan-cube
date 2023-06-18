<?php

namespace Modules\WelcomeMessages\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WelcomeMessagesModuleUserPermissionsSeeder extends Seeder
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
            ['user_id' => 1, 'permission_id' => 409, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 410, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 411, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 412, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 413, 'created_at' => Carbon::now()],

            // General Manager User Permissions
            ['user_id' => 2, 'permission_id' => 409, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 410, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 411, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 412, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 413, 'created_at' => Carbon::now()],
        ]);
    }
}
