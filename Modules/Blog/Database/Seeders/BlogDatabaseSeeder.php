<?php

namespace Modules\Blog\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class BlogDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(BlogModuleModuleSeeder::class);
        $this->call(BlogModulePermissionsSeeder::class);
        $this->call(BlogModuleGroupPermissionsSeeder::class);
        $this->call(BlogModuleUserPermissionsSeeder::class);
    }
}
