<?php

namespace Modules\Messages\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MessagesModulePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $module_id = DB::table('modules')->where('name', 'Messages Module')->first()->id;

        DB::table('permissions')->insert([
            // Manage Messages
            [
                'id' => 388,
                'parent_id' => null,
                'name' => 'Manage messages',
                'slug' => 'manage-messages',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 389,
                'parent_id' => 388,
                'name' => 'Index Messages',
                'slug' => 'index-messages',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 390,
                'parent_id' => 388,
                'name' => 'Create Message',
                'slug' => 'create-message',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 391,
                'parent_id' => 388,
                'name' => 'Update Message',
                'slug' => 'update-message',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 392,
                'parent_id' => 388,
                'name' => 'Delete Message',
                'slug' => 'delete-message',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
        ]);
    }
}
