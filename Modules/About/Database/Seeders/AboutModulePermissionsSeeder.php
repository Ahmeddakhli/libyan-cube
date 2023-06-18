<?php

namespace Modules\About\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AboutModulePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $module_id = DB::table('modules')->where('name','About Module')->first()->id;

        DB::table('permissions')->insert([
            // Manage About Sections
            [
                'id' => 333,
                'parent_id' => null,
                'name' => 'Manage About Sections',
                'slug' => 'manage-about-sections',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 334,
                'parent_id' => 333,
                'name' => 'Index About Sections',
                'slug' => 'index-about-sections',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 335,
                'parent_id' => 333,
                'name' => 'Create About Section',
                'slug' => 'create-about-section',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 336,
                'parent_id' => 333,
                'name' => 'Update About Section',
                'slug' => 'update-about-section',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 337,
                'parent_id' => 333,
                'name' => 'Delete About Section',
                'slug' => 'delete-about-section',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],

           
        ]);
    }
}
