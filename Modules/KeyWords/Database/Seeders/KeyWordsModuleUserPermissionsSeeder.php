<?php

namespace Modules\KeyWords\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KeyWordsModuleUserPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('user_permissions')->insert([
            // Technical Support User Permissions
            ['user_id' => 1, 'permission_id' => 414, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 415, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 416, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 417, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 418, 'created_at' => Carbon::now()],


            // General Manager User Permissions
            ['user_id' => 2, 'permission_id' => 414, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 415, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 416, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 417, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 418, 'created_at' => Carbon::now()],
        ]);
    }
}
