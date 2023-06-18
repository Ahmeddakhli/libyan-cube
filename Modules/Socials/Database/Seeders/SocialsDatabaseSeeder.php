<?php

namespace Modules\Socials\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SocialsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(SocialsModuleModuleSeeder::class);
        $this->call(SocialsModulePermissionsSeeder::class);
        $this->call(SocialsModuleUserPermissionsSeeder::class);
        $this->call(SocialsModuleGroupPermissionsSeeder::class);
        $this->call(SocialsTableDataSeeder::class);
    }
}
