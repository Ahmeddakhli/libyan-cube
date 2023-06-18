<?php

namespace Modules\WelcomeMessages\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WelcomeMessagesModuleGroupPermissionsSeeder extends Seeder
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
            ['group_id' => 1, 'permission_id' => 409, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 410, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 411, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 412, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 413, 'created_at' => Carbon::now()],
         
            // General Manager Group Permissions
            ['group_id' => 2, 'permission_id' => 409, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 410, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 411, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 412, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 413, 'created_at' => Carbon::now()],
        ]);
    }
}
