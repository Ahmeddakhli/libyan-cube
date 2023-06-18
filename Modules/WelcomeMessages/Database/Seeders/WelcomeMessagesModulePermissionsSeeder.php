<?php

namespace Modules\WelcomeMessages\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WelcomeMessagesModulePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $module_id = DB::table('modules')->where('name','Welcome Messages Module')->first()->id;

        DB::table('permissions')->insert([
            // Manage WelcomeMessages
            [
                'id' => 409,
                'parent_id' => null,
                'name' => 'Manage Welcome Messages',
                'slug' => 'manage-welcome-messages',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 410,
                'parent_id' => 409,
                'name' => 'Index Welcome Messages',
                'slug' => 'index-welcome-messages',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 411,
                'parent_id' => 409,
                'name' => 'Create Welcome Message',
                'slug' => 'create-welcome-message',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 412,
                'parent_id' => 409,
                'name' => 'Update Welcome Message',
                'slug' => 'update-welcome-message',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 413,
                'parent_id' => 409,
                'name' => 'Delete Welcome Message',
                'slug' => 'delete-welcome-message',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
        ]);
    }
}
