<?php

namespace Modules\Careers\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CareersDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(CareersModuleModuleSeeder::class);
        $this->call(CareersModulePermissionsSeeder::class);
        $this->call(CareersModuleGroupPermissionsSeeder::class);
        $this->call(CareersModuleUserPermissionsSeeder::class);
    }
}
