<?php

namespace Modules\KeyWords\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KeyWordsModulePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $module_id = DB::table('modules')->where('name', 'Key Words Module')->first()->id;

        DB::table('permissions')->insert([
            // Manage Key Words
            [
                'id' => 414,
                'parent_id' => null,
                'name' => 'Manage Key Words',
                'slug' => 'manage-key-words',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 415,
                'parent_id' => 414,
                'name' => 'Index Key Words',
                'slug' => 'index-key-words',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 416,
                'parent_id' => 414,
                'name' => 'Create Key Word',
                'slug' => 'create-key-word',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 417,
                'parent_id' => 414,
                'name' => 'Update Key Word',
                'slug' => 'update-key-word',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 418,
                'parent_id' => 414,
                'name' => 'Delete Key Word',
                'slug' => 'delete-key-word',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
        ]);
    }
}
