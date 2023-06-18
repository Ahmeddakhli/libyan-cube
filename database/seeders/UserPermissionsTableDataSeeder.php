<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UserPermissionsTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // php artisan db:seed --class=UserPermissionsTableDataSeeder

        DB::table('user_permissions')->insert([
            // Technical Support User Permissions
            ['user_id' => 1, 'permission_id' => 1, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 2, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 3, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 4, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 5, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 6, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 7, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 8, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 9, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 10, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 11, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 12, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 13, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 14, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 15, 'created_at' => Carbon::now()],
            ['user_id' => 1, 'permission_id' => 16, 'created_at' => Carbon::now()],

            // General Manager User Permissions
            ['user_id' => 2, 'permission_id' => 1, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 2, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 3, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 4, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 5, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 6, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 7, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 8, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 9, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 10, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 11, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 12, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 13, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 14, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 15, 'created_at' => Carbon::now()],
            ['user_id' => 2, 'permission_id' => 16, 'created_at' => Carbon::now()],
        ]);
    }
}
