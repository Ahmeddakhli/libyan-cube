<?php

namespace Modules\Testimonials\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TestimonialsModuleUserPermissionsSeeder extends Seeder
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
            ['user_id' => 1, 'permission_id' => 323, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 324, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 325, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 326, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 327, 'created_at' => Carbon::now()],

            // General Manager User Permissions
            ['user_id' => 2, 'permission_id' => 323, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 324, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 325, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 326, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 327, 'created_at' => Carbon::now()],

        ]);
    }
}
