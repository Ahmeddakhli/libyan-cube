<?php

namespace Modules\CMS\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CMSDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(CMSModuleModuleSeeder::class);
        $this->call(CMSModulePermissionsSeeder::class);
        $this->call(CMSModuleUserPermissionsSeeder::class);
        $this->call(CMSModuleGroupPermissionsSeeder::class);
        $this->call(CMSModulePrivacyPermissionsSeeder::class);
    }
}
