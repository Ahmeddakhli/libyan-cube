<?php

namespace Modules\SEO\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SeoModuleGroupPermissionsSeeder extends Seeder
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
            // Technical Support Group Permissions
            ['group_id' => 1, 'permission_id' => 586, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 587, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 588, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 589, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 590, 'created_at' => Carbon::now()],
         

            // General Manager Group Permissions
            ['group_id' => 2, 'permission_id' => 586, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 587, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 588, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 589, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 590, 'created_at' => Carbon::now()],
        ]);
    }
}
