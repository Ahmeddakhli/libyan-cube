<?php

namespace Modules\CMS\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CMSModulePrivacyPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $module_id = DB::table('modules')->where('name', 'CMS Module')->first()->id;

        // Terms
        DB::table('permissions')->insert([
            [
                'id' => 551,
                'parent_id' => null,
                'name' => 'Manage Privacies',
                'slug' => 'manage-privacies',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 552,
                'parent_id' => 551,
                'name' => 'Index Privacies',
                'slug' => 'index-privacies',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 553,
                'parent_id' => 551,
                'name' => 'Create Privacy',
                'slug' => 'create-privacy',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 554,
                'parent_id' => 551,
                'name' => 'Update Privacy',
                'slug' => 'update-privacy',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 555,
                'parent_id' => 551,
                'name' => 'Delete Privacy',
                'slug' => 'delete-privacy',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
        ]);
        DB::table('group_permissions')->insert([
            // Technical Support Group Permissions
            ['group_id' => 1, 'permission_id' => 551, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 552, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 553, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 554, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 555, 'created_at' => Carbon::now()],

            // General Manager Group Permissions
            ['group_id' => 2, 'permission_id' => 551, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 552, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 553, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 554, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 555, 'created_at' => Carbon::now()],

        ]);

        DB::table('user_permissions')->insert([
            // Technical Support Group Permissions
            ['user_id' => 1, 'permission_id' => 551, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 552, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 553, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 554, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 555, 'created_at' => Carbon::now()],

            // General Manager Group Permissions
            ['user_id' => 2, 'permission_id' => 551, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 552, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 553, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 554, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 555, 'created_at' => Carbon::now()],

        ]);
    }
}
