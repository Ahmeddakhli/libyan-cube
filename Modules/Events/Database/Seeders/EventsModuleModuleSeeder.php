<?php

namespace Modules\Events\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;

class EventsModuleModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // Seed Module Events 
        DB::table('modules')->insert([
            'name' => 'Events Module',
            'description' => 'Events Module',
        ]);

        // Attach module to packages module
        $module = DB::table('modules')->where('name', 'Events Module')->first();
        $package = DB::table('packages')->first();
        DB::table('package_modules')->insert([
            'package_id' => $package->id,
            'module_id' => $module->id
        ]);
    }
}
