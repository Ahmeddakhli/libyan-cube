<?php

namespace Modules\Messages\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MessagesModuleGroupPermissionsSeeder extends Seeder
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
            ['group_id' => 1, 'permission_id' => 388, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 389, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 390, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 391, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 392, 'created_at' => Carbon::now()],


            // General Manager Group Permissions
            ['group_id' => 2, 'permission_id' => 388, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 389, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 390, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 391, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 392, 'created_at' => Carbon::now()],

        ]);
    }
}
