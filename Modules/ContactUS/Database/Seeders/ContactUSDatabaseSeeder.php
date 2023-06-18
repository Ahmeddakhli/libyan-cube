<?php

namespace Modules\ContactUS\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ContactUSDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(ContactUSModuleModuleSeeder::class);
        $this->call(ContactUSModulePermissionsSeeder::class);
        $this->call(ContactUSModuleGroupPermissionsSeeder::class);
        $this->call(ContactUSModuleUserPermissionsSeeder::class);
    }
}
