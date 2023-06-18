<?php

namespace Modules\Events\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventsModulePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $module_id = DB::table('modules')->where('name','Events Module')->first()->id;

        DB::table('permissions')->insert([
            // Manage Events
            [
                'id' => 308,
                'parent_id' => null,
                'name' => 'Manage events',
                'slug' => 'manage-events',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 309,
                'parent_id' => 308,
                'name' => 'Index events',
                'slug' => 'index-events',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 310,
                'parent_id' => 308,
                'name' => 'Create event',
                'slug' => 'create-event',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 311,
                'parent_id' => 308,
                'name' => 'Update event',
                'slug' => 'update-event',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 312,
                'parent_id' => 308,
                'name' => 'Delete event',
                'slug' => 'delete-event',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
        ]);
    }
}
