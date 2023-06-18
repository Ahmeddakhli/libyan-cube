<?php

namespace Modules\Tags\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TagsPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $module_id = DB::table('modules')->where('name', 'Tags Module')->first()->id;

        DB::table('permissions')->insert([
            // Manage Tags
            [
                'id' => 71,
                'parent_id' => null,
                'name' => 'Manage Tags',
                'slug' => 'manage-tags',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 72,
                'parent_id' => 71,
                'name' => 'Index Tags',
                'slug' => 'index-tags',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 73,
                'parent_id' => 71,
                'name' => 'Create Tag',
                'slug' => 'create-tag',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 74,
                'parent_id' => 71,
                'name' => 'Update Tag',
                'slug' => 'update-tag',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 75,
                'parent_id' => 71,
                'name' => 'Delete Tag',
                'slug' => 'delete-tag',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
        ]);
    }
}
