<?php

namespace Modules\Meetings\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MeetingsModuleGroupPermissionsSeeder extends Seeder
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
            ['group_id' => 1, 'permission_id' => 338, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 339, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 340, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 341, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 342, 'created_at' => Carbon::now()],


            // General Manager Group Permissions
            ['group_id' => 2, 'permission_id' => 338, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 339, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 340, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 341, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 342, 'created_at' => Carbon::now()],

        ]);
    }
}
