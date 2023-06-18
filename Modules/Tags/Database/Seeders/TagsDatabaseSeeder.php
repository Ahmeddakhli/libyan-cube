<?php

namespace Modules\Tags\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class TagsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        
        $this->call(TagsModuleModuleSeeder::class);
        $this->call(TagsPermissionsSeeder::class);
        $this->call(TagsGroupPermissionsSeeder::class);
        $this->call(TagsUserPermissionsSeeder::class);

    }
}
