<?php

namespace Modules\KeyWords\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KeyWordsModuleGroupPermissionsSeeder extends Seeder
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
            ['group_id' => 1, 'permission_id' => 414, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 415, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 416, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 417, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 418, 'created_at' => Carbon::now()],


            // General Manager Group Permissions
            ['group_id' => 2, 'permission_id' => 414, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 415, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 416, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 417, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 418, 'created_at' => Carbon::now()],
        ]);
    }
}
