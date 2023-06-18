<?php

namespace Modules\Messages\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class MessagesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(MessagesModuleModuleSeeder::class);
        $this->call(MessagesModulePermissionsSeeder::class);
        $this->call(MessagesModuleGroupPermissionsSeeder::class);
        $this->call(MessagesModuleUserPermissionsSeeder::class);
    }
}
