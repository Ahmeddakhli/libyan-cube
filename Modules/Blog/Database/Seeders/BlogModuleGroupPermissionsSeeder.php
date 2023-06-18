<?php

namespace Modules\Blog\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BlogModuleGroupPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('group_permissions')->insert([
            // Blog
            // Technical Support Group Permissions
            ['group_id' => 1, 'permission_id' => 303, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 304, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 305, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 306, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 307, 'created_at' => Carbon::now()],


            // General Manager Group Permissions
            ['group_id' => 2, 'permission_id' => 303, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 304, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 305, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 306, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 307, 'created_at' => Carbon::now()],


            // Blog Categories
            // Technical Support Group Permissions
            ['group_id' => 1, 'permission_id' => 373, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 374, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 375, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 376, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 377, 'created_at' => Carbon::now()],


            // General Manager Group Permissions
            ['group_id' => 2, 'permission_id' => 373, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 374, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 375, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 376, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 377, 'created_at' => Carbon::now()],
        ]);
    }
}
