<?php

namespace Modules\SEO\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SeoDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(SeoModuleModuleSeeder::class);
        $this->call(SeoModulePermissionsSeeder::class);
        $this->call(SeoModuleGroupPermissionsSeeder::class);
        $this->call(SeoModuleUserPermissionsSeeder::class);
    }
}
