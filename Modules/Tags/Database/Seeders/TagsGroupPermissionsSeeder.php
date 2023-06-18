<?php

namespace Modules\Tags\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TagsGroupPermissionsSeeder extends Seeder
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
            ['group_id' => 1, 'permission_id' => 71, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 72, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 73, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 74, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 75, 'created_at' => Carbon::now()],

            // General Managers Group Permissions
            ['group_id' => 2, 'permission_id' => 71, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 72, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 73, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 74, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 75, 'created_at' => Carbon::now()],
        ]);
    }
}
