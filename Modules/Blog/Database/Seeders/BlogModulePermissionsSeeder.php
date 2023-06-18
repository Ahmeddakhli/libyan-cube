<?php

namespace Modules\Blog\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BlogModulePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $module_id = DB::table('modules')->where('name', 'Blog Module')->first()->id;

        DB::table('permissions')->insert([

            // Manage Blogs
            [
                'id' => 303,
                'parent_id' => null,
                'name' => 'Manage Blog Blogs',
                'slug' => 'manage-blogs',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 304,
                'parent_id' => 303,
                'name' => 'Index Blogs',
                'slug' => 'index-blogs',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 305,
                'parent_id' => 303,
                'name' => 'Create Blog',
                'slug' => 'create-blog',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 306,
                'parent_id' => 303,
                'name' => 'Update Blog',
                'slug' => 'update-blog',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 307,
                'parent_id' => 303,
                'name' => 'Delete Blog',
                'slug' => 'delete-blog',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],

            // Manage Blog categories
            [
                'id' => 373,
                'parent_id' => null,
                'name' => 'Manage Blog Categories',
                'slug' => 'manage-blog-categories',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 374,
                'parent_id' => 373,
                'name' => 'Index Blog Categories',
                'slug' => 'index-blog-categories',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 375,
                'parent_id' => 373,
                'name' => 'Create Blog Category',
                'slug' => 'create-blog-category',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 376,
                'parent_id' => 373,
                'name' => 'Update Blog Category',
                'slug' => 'update-blog-category',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 377,
                'parent_id' => 373,
                'name' => 'Delete Blog Category',
                'slug' => 'delete-blog-category',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],

        ]);
    }
}
