<?php

namespace Modules\Settings\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SettingsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(SettingsModuleModuleSeeder::class);
        $this->call(SettingsModulePermissionsSeeder::class);
        $this->call(SettingsModuleUserPermissionsSeeder::class);
        $this->call(SettingsModuleGroupPermissionsSeeder::class);
        $this->call(SettingTableTableSeeder::class);
    }
}
