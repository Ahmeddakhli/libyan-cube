<?php

namespace Modules\Services\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ServicesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(ServicesModuleModuleSeeder::class);
        $this->call(ServicesModulePermissionsSeeder::class);
        $this->call(ServicesModuleGroupPermissionsSeeder::class);
        $this->call(ServicesModuleUserPermissionsSeeder::class);
    }
}
