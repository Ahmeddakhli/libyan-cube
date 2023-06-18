<?php

namespace Modules\Events\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventsModuleGroupPermissionsSeeder extends Seeder
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
            ['group_id' => 1, 'permission_id' => 308, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 309, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 310, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 311, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 312, 'created_at' => Carbon::now()],


            // General Manager Group Permissions
            ['group_id' => 2, 'permission_id' => 308, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 309, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 310, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 311, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 312, 'created_at' => Carbon::now()],
        ]);
    }
}
