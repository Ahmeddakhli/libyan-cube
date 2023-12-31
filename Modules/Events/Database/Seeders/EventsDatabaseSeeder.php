<?php

namespace Modules\Events\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class EventsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(EventsModuleModuleSeeder::class);
        $this->call(EventsModulePermissionsSeeder::class);
        $this->call(EventsModuleGroupPermissionsSeeder::class);
        $this->call(EventsModuleUserPermissionsSeeder::class);
    }
}
