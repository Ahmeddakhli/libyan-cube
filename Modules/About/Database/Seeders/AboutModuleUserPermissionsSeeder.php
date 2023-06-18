<?php

namespace Modules\About\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AboutModuleUserPermissionsSeeder extends Seeder
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
            ['user_id' => 1, 'permission_id' => 333, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 334, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 335, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 336, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 337, 'created_at' => Carbon::now()],
         
            // General Manager User Permissions
            ['user_id' => 2, 'permission_id' => 333, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 334, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 335, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 336, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 337, 'created_at' => Carbon::now()],
        ]);
    }
}
