<?php

namespace Modules\WelcomeMessages\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class WelcomeMessagesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

         $this->call(WelcomeMessagesModuleModuleSeeder::class);
         $this->call(WelcomeMessagesModulePermissionsSeeder::class);
         $this->call(WelcomeMessagesModuleGroupPermissionsSeeder::class);
         $this->call(WelcomeMessagesModuleUserPermissionsSeeder::class);

    }
}
