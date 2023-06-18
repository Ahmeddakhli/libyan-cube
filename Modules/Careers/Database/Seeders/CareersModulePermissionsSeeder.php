<?php

namespace Modules\Careers\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CareersModulePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $module_id = DB::table('modules')->where('name','Careers Module')->first()->id;

        DB::table('permissions')->insert([
            // Manage Careers
            [
                'id' => 318,
                'parent_id' => null,
                'name' => 'Manage Careers',
                'slug' => 'manage-careers',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 319,
                'parent_id' => 318,
                'name' => 'Index Careers',
                'slug' => 'index-careers',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 320,
                'parent_id' => 318,
                'name' => 'Create Career',
                'slug' => 'create-career',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 321,
                'parent_id' => 318,
                'name' => 'Update Career',
                'slug' => 'update-career',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 322,
                'parent_id' => 318,
                'name' => 'Delete Career',
                'slug' => 'delete-career',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],           
        ]);
    }
}
