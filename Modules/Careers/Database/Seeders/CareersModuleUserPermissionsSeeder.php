<?php

namespace Modules\Careers\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CareersModuleUserPermissionsSeeder extends Seeder
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
            ['user_id' => 1, 'permission_id' => 318, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 319, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 320, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 321, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 322, 'created_at' => Carbon::now()],
         

            // General Manager User Permissions
            ['user_id' => 2, 'permission_id' => 318, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 319, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 320, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 321, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 322, 'created_at' => Carbon::now()],
        ]);
    }
}
