<?php

namespace Modules\Services\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ServicesModuleGroupPermissionsSeeder extends Seeder
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
            // Services
            // Technical Support Group Permissions
            ['group_id' => 1, 'permission_id' => 383, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 384, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 385, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 386, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 387, 'created_at' => Carbon::now()],


            // General Manager Group Permissions
            ['group_id' => 2, 'permission_id' => 383, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 384, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 385, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 386, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 387, 'created_at' => Carbon::now()],

        ]);
    }
}
