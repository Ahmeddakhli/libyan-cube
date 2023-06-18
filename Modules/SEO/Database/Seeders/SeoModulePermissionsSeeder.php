<?php

namespace Modules\SEO\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SeoModulePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $module_id = DB::table('modules')->where('name','Seo Module')->first()->id;

        DB::table('permissions')->insert([
            // Manage Seo
            [
                'id' => 586,
                'parent_id' => null,
                'name' => 'Manage Seo',
                'slug' => 'manage-seo',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 587,
                'parent_id' => 586,
                'name' => 'Index Seo',
                'slug' => 'index-seo',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 588,
                'parent_id' => 586,
                'name' => 'Create Seo',
                'slug' => 'create-seo',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 589,
                'parent_id' => 586,
                'name' => 'Update Seo',
                'slug' => 'update-seo',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 590,
                'parent_id' => 586,
                'name' => 'Delete Seo',
                'slug' => 'delete-seo',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],           
        ]);
    }
}
