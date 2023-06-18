<?php

namespace Modules\Settings\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SettingsModuleGroupPermissionsSeeder extends Seeder
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
            // Technical Support group Permissions
            ['group_id' => 1, 'permission_id' => 343, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 344, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 345, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 346, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 347, 'created_at' => Carbon::now()],

            // General Manager group Permissions
            ['group_id' => 2, 'permission_id' => 343, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 344, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 345, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 346, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 347, 'created_at' => Carbon::now()],

            // Technical Support group Permissions
            ['group_id' => 1, 'permission_id' => 348, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 349, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 350, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 351, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 352, 'created_at' => Carbon::now()],

            // General Manager group Permissions
            ['group_id' => 2, 'permission_id' => 348, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 349, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 350, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 351, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 352, 'created_at' => Carbon::now()],

            // Technical Support group Permissions
            ['group_id' => 1, 'permission_id' => 353, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 354, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 355, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 356, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 357, 'created_at' => Carbon::now()],

            // General Manager group Permissions
            ['group_id' => 2, 'permission_id' => 353, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 354, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 355, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 356, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 357, 'created_at' => Carbon::now()],

            // Technical Support group Permissions
            ['group_id' => 1, 'permission_id' => 358, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 359, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 360, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 361, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 362, 'created_at' => Carbon::now()],

            // General Manager group Permissions
            ['group_id' => 2, 'permission_id' => 358, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 359, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 360, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 361, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 362, 'created_at' => Carbon::now()],

            // Technical Support group Permissions
            ['group_id' => 1, 'permission_id' => 393, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 394, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 395, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 396, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 397, 'created_at' => Carbon::now()],

            // General Manager group Permissions
            ['group_id' => 2, 'permission_id' => 393, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 394, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 395, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 396, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 397, 'created_at' => Carbon::now()],

            // Technical Support group Permissions
            ['group_id' => 1, 'permission_id' => 403, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 404, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 405, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 406, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 407, 'created_at' => Carbon::now()],

            // General Manager group Permissions
            ['group_id' => 2, 'permission_id' => 403, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 404, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 405, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 406, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 407, 'created_at' => Carbon::now()],

            // Technical Support group Permissions
            ['group_id' => 1, 'permission_id' => 546, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 547, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 548, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 549, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 550, 'created_at' => Carbon::now()],

            // General Manager group Permissions
            ['group_id' => 2, 'permission_id' => 546, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 547, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 548, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 549, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 550, 'created_at' => Carbon::now()],
        ]);
    }
}
