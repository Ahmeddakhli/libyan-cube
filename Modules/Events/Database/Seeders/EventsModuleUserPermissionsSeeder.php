<?php

namespace Modules\Events\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventsModuleUserPermissionsSeeder extends Seeder
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
            ['user_id' => 1, 'permission_id' => 308, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 309, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 310, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 311, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 312, 'created_at' => Carbon::now()],


            // General Manager User Permissions
            ['user_id' => 2, 'permission_id' => 308, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 309, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 310, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 311, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 312, 'created_at' => Carbon::now()],
        ]);
    }
}
