<?php

namespace Modules\Services\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ServicesModulePermissionsSeeder extends Seeder
{
    /**
     * Run the database Seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $module_id = DB::table('modules')->where('name', 'Services Module')->first()->id;

        DB::table('permissions')->insert([

            // Manage Services
            [
                'id' => 383,
                'parent_id' => null,
                'name' => 'Manage Services',
                'slug' => 'manage-services',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 384,
                'parent_id' => 383,
                'name' => 'Index Services',
                'slug' => 'index-services',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 385,
                'parent_id' => 383,
                'name' => 'Create Service',
                'slug' => 'create-service',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 386,
                'parent_id' => 383,
                'name' => 'Update Service',
                'slug' => 'update-service',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 387,
                'parent_id' => 383,
                'name' => 'Delete Service',
                'slug' => 'delete-service',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
        ]);
    }
}
