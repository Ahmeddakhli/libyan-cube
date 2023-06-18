<?php

namespace Modules\CMS\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CMSModuleGroupPermissionsSeeder extends Seeder
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
            ['group_id' => 1, 'permission_id' => 536, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 537, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 538, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 539, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 540, 'created_at' => Carbon::now()],

            // General Manager Group Permissions
            ['group_id' => 2, 'permission_id' => 536, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 537, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 538, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 539, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 540, 'created_at' => Carbon::now()],


            // Technical Support Group Permissions
            ['group_id' => 1, 'permission_id' => 541, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 542, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 543, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 544, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 545, 'created_at' => Carbon::now()],

            // General Manager Group Permissions
            ['group_id' => 2, 'permission_id' => 541, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 542, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 543, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 544, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 545, 'created_at' => Carbon::now()],

            // // Technical Support Group Permissions
            // ['group_id' => 1, 'permission_id' => 546, 'created_at' => Carbon::now()],
            // ['group_id' => 1, 'permission_id' => 547, 'created_at' => Carbon::now()],
            // ['group_id' => 1, 'permission_id' => 548, 'created_at' => Carbon::now()],
            // ['group_id' => 1, 'permission_id' => 549, 'created_at' => Carbon::now()],
            // ['group_id' => 1, 'permission_id' => 550, 'created_at' => Carbon::now()],

            // // General Manager Group Permissions
            // ['group_id' => 2, 'permission_id' => 546, 'created_at' => Carbon::now()],
            // ['group_id' => 2, 'permission_id' => 547, 'created_at' => Carbon::now()],
            // ['group_id' => 2, 'permission_id' => 548, 'created_at' => Carbon::now()],
            // ['group_id' => 2, 'permission_id' => 549, 'created_at' => Carbon::now()],
            // ['group_id' => 2, 'permission_id' => 550, 'created_at' => Carbon::now()],

            // // Technical Support Group Permissions
            // ['group_id' => 1, 'permission_id' => 551, 'created_at' => Carbon::now()],
            // ['group_id' => 1, 'permission_id' => 552, 'created_at' => Carbon::now()],
            // ['group_id' => 1, 'permission_id' => 553, 'created_at' => Carbon::now()],
            // ['group_id' => 1, 'permission_id' => 554, 'created_at' => Carbon::now()],
            // ['group_id' => 1, 'permission_id' => 555, 'created_at' => Carbon::now()],

            // // General Manager Group Permissions
            // ['group_id' => 2, 'permission_id' => 551, 'created_at' => Carbon::now()],
            // ['group_id' => 2, 'permission_id' => 552, 'created_at' => Carbon::now()],
            // ['group_id' => 2, 'permission_id' => 553, 'created_at' => Carbon::now()],
            // ['group_id' => 2, 'permission_id' => 554, 'created_at' => Carbon::now()],
            // ['group_id' => 2, 'permission_id' => 555, 'created_at' => Carbon::now()],

            // // Technical Support Group Permissions
            // ['group_id' => 1, 'permission_id' => 556, 'created_at' => Carbon::now()],
            // ['group_id' => 1, 'permission_id' => 557, 'created_at' => Carbon::now()],
            // ['group_id' => 1, 'permission_id' => 558, 'created_at' => Carbon::now()],
            // ['group_id' => 1, 'permission_id' => 559, 'created_at' => Carbon::now()],
            // ['group_id' => 1, 'permission_id' => 560, 'created_at' => Carbon::now()],

            // // General Manager Group Permissions
            // ['group_id' => 2, 'permission_id' => 556, 'created_at' => Carbon::now()],
            // ['group_id' => 2, 'permission_id' => 557, 'created_at' => Carbon::now()],
            // ['group_id' => 2, 'permission_id' => 558, 'created_at' => Carbon::now()],
            // ['group_id' => 2, 'permission_id' => 559, 'created_at' => Carbon::now()],
            // ['group_id' => 2, 'permission_id' => 560, 'created_at' => Carbon::now()],

            // // Technical Support Group Permissions
            // ['group_id' => 1, 'permission_id' => 561, 'created_at' => Carbon::now()],
            // ['group_id' => 1, 'permission_id' => 562, 'created_at' => Carbon::now()],
            // ['group_id' => 1, 'permission_id' => 563, 'created_at' => Carbon::now()],
            // ['group_id' => 1, 'permission_id' => 564, 'created_at' => Carbon::now()],
            // ['group_id' => 1, 'permission_id' => 565, 'created_at' => Carbon::now()],

            // // General Manager Group Permissions
            // ['group_id' => 2, 'permission_id' => 561, 'created_at' => Carbon::now()],
            // ['group_id' => 2, 'permission_id' => 562, 'created_at' => Carbon::now()],
            // ['group_id' => 2, 'permission_id' => 563, 'created_at' => Carbon::now()],
            // ['group_id' => 2, 'permission_id' => 564, 'created_at' => Carbon::now()],
            // ['group_id' => 2, 'permission_id' => 565, 'created_at' => Carbon::now()],

            // // Technical Support Group Permissions
            // ['group_id' => 1, 'permission_id' => 566, 'created_at' => Carbon::now()],
            // ['group_id' => 1, 'permission_id' => 567, 'created_at' => Carbon::now()],
            // ['group_id' => 1, 'permission_id' => 568, 'created_at' => Carbon::now()],
            // ['group_id' => 1, 'permission_id' => 569, 'created_at' => Carbon::now()],
            // ['group_id' => 1, 'permission_id' => 570, 'created_at' => Carbon::now()],

            // // General Manager Group Permissions
            // ['group_id' => 2, 'permission_id' => 566, 'created_at' => Carbon::now()],
            // ['group_id' => 2, 'permission_id' => 567, 'created_at' => Carbon::now()],
            // ['group_id' => 2, 'permission_id' => 568, 'created_at' => Carbon::now()],
            // ['group_id' => 2, 'permission_id' => 569, 'created_at' => Carbon::now()],
            // ['group_id' => 2, 'permission_id' => 570, 'created_at' => Carbon::now()],

            // // Technical Support Group Permissions
            // ['group_id' => 1, 'permission_id' => 571, 'created_at' => Carbon::now()],
            // ['group_id' => 1, 'permission_id' => 572, 'created_at' => Carbon::now()],
            // ['group_id' => 1, 'permission_id' => 573, 'created_at' => Carbon::now()],
            // ['group_id' => 1, 'permission_id' => 574, 'created_at' => Carbon::now()],
            // ['group_id' => 1, 'permission_id' => 575, 'created_at' => Carbon::now()],

            // // General Manager Group Permissions
            // ['group_id' => 2, 'permission_id' => 571, 'created_at' => Carbon::now()],
            // ['group_id' => 2, 'permission_id' => 572, 'created_at' => Carbon::now()],
            // ['group_id' => 2, 'permission_id' => 573, 'created_at' => Carbon::now()],
            // ['group_id' => 2, 'permission_id' => 574, 'created_at' => Carbon::now()],
            // ['group_id' => 2, 'permission_id' => 575, 'created_at' => Carbon::now()],
        ]);
    }
}
