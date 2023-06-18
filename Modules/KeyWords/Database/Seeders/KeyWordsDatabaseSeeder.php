<?php

namespace Modules\KeyWords\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class KeyWordsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(KeyWordsModuleModuleSeeder::class);
        $this->call(KeyWordsModulePermissionsSeeder::class);
        $this->call(KeyWordsModuleGroupPermissionsSeeder::class);
        $this->call(KeyWordsModuleUserPermissionsSeeder::class);
    }
}
