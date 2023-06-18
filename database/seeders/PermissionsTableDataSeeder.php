<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PermissionsTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // php artisan db:seed --class=PermissionsTableDataSeeder

        DB::table('permissions')->insert([
            // Manage Groups
            [
                'id' => 1,
                'parent_id' => null,
                'name' => 'Manage Groups',
                'slug' => 'manage-groups',
                'is_hidden' => 0,
                'created_at' => Carbon::now()
            ],
            [
                'id' => 2,
                'parent_id' => 1,
                'name' => 'Index Groups',
                'slug' => 'index-groups',
                'is_hidden' => 0,
                'created_at' => Carbon::now()
            ],
            [
                'id' => 3,
                'parent_id' => 1,
                'name' => 'Create Group',
                'slug' => 'create-group',
                'is_hidden' => 0,
                'created_at' => Carbon::now()
            ],
            [
                'id' => 4,
                'parent_id' => 1,
                'name' => 'View Group',
                'slug' => 'view-group',
                'is_hidden' => 0,
                'created_at' => Carbon::now()
            ],
            [
                'id' => 5,
                'parent_id' => 1,
                'name' => 'Update Group',
                'slug' => 'update-group',
                'is_hidden' => 0,
                'created_at' => Carbon::now()
            ],
            [
                'id' => 6,
                'parent_id' => 1,
                'name' => 'Delete Group',
                'slug' => 'delete-group',
                'is_hidden' => 0,
                'created_at' => Carbon::now()
            ],
            [
                'id' => 7,
                'parent_id' => 1,
                'name' => 'Update Group Permissions',
                'slug' => 'update-group-permissions',
                'is_hidden' => 0,
                'created_at' => Carbon::now()
            ],

            // Manage Users
            [
                'id' => 8,
                'parent_id' => null,
                'name' => 'Manage Users',
                'slug' => 'manage-users',
                'is_hidden' => 0,
                'created_at' => Carbon::now()
            ],
            [
                'id' => 9,
                'parent_id' => 8,
                'name' => 'Index Users',
                'slug' => 'index-users',
                'is_hidden' => 0,
                'created_at' => Carbon::now()
            ],
            [
                'id' => 10,
                'parent_id' => 8,
                'name' => 'Create User',
                'slug' => 'create-user',
                'is_hidden' => 0,
                'created_at' => Carbon::now()
            ],
            [
                'id' => 11,
                'parent_id' => 8,
                'name' => 'View User',
                'slug' => 'view-user',
                'is_hidden' => 0,
                'created_at' => Carbon::now()
            ],
            [
                'id' => 12,
                'parent_id' => 8,
                'name' => 'Update User',
                'slug' => 'update-user',
                'is_hidden' => 0,
                'created_at' => Carbon::now()
            ],
            [
                'id' => 13,
                'parent_id' => 8,
                'name' => 'Delete User',
                'slug' => 'delete-user',
                'is_hidden' => 0,
                'created_at' => Carbon::now()
            ],
            [
                'id' => 15,
                'parent_id' => 8,
                'name' => 'Update User Permissions',
                'slug' => 'update-user-permissions',
                'is_hidden' => 0,
                'created_at' => Carbon::now()
            ],

            // Suspend User
            [
                'id' => 16,
                'parent_id' => 8,
                'name' => 'Suspend User',
                'slug' => 'suspend-user',
                'is_Hidden' => 0,
                'created_at' => Carbon::now()
            ],
        ]);
    }
}
