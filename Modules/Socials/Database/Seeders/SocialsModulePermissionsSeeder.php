<?php

namespace Modules\Socials\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SocialsModulePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $module_id = DB::table('modules')->where('name', 'Socials Module')->first()->id;

        DB::table('permissions')->insert([
            // Manage Socials
            [
                'id' => 328,
                'parent_id' => null,
                'name' => 'Manage socials',
                'slug' => 'manage-socials',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 329,
                'parent_id' => 328,
                'name' => 'Index socials',
                'slug' => 'index-socials',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 330,
                'parent_id' => 328,
                'name' => 'Create social',
                'slug' => 'create-social',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 331,
                'parent_id' => 328,
                'name' => 'Update social',
                'slug' => 'update-social',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 332,
                'parent_id' => 328,
                'name' => 'Delete social',
                'slug' => 'delete-social',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
        ]);
    }
}
