<?php

namespace Modules\Meetings\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class MeetingsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(MeetingsModuleModuleSeeder::class);
        $this->call(MeetingsModulePermissionsSeeder::class);
        $this->call(MeetingsModuleGroupPermissionsSeeder::class);
        $this->call(MeetingsModuleUserPermissionsSeeder::class);
    }
}
