<?php

namespace Modules\Testimonials\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TestimonialsModulePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $module_id = DB::table('modules')->where('name', 'Testimonials Module')->first()->id;

        DB::table('permissions')->insert([
            // Manage Testimonials
            [
                'id' => 323,
                'parent_id' => null,
                'name' => 'Manage Testimonials',
                'slug' => 'manage-testimonials',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 324,
                'parent_id' => 323,
                'name' => 'Index Testimonials',
                'slug' => 'index-testimonials',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 325,
                'parent_id' => 323,
                'name' => 'Create Testimonial',
                'slug' => 'create-testimonial',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 326,
                'parent_id' => 323,
                'name' => 'Update Testimonial',
                'slug' => 'update-testimonial',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 327,
                'parent_id' => 323,
                'name' => 'Delete Testimonial',
                'slug' => 'delete-testimonial',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
        ]);
    }
}
