<?php

namespace Modules\Meetings\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MeetingsModulePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $module_id = DB::table('modules')->where('name', 'Meetings Module')->first()->id;

        DB::table('permissions')->insert([
            // Manage Meetings
            [
                'id' => 338,
                'parent_id' => null,
                'name' => 'Manage meetings',
                'slug' => 'manage-meetings',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 339,
                'parent_id' => 338,
                'name' => 'Index meetings',
                'slug' => 'index-meetings',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 340,
                'parent_id' => 338,
                'name' => 'Create meeting',
                'slug' => 'create-meeting',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 341,
                'parent_id' => 338,
                'name' => 'Update meeting',
                'slug' => 'update-meeting',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 342,
                'parent_id' => 338,
                'name' => 'Delete meeting',
                'slug' => 'delete-meeting',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
        ]);
    }
}
