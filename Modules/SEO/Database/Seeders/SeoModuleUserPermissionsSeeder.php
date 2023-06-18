<?php

namespace Modules\SEO\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SeoModuleUserPermissionsSeeder extends Seeder
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
            ['user_id' => 1, 'permission_id' => 586, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 587, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 588, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 589, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 590, 'created_at' => Carbon::now()],
         

            // General Manager User Permissions
            ['user_id' => 2, 'permission_id' => 586, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 587, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 588, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 589, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 590, 'created_at' => Carbon::now()],
        ]);
    }
}
