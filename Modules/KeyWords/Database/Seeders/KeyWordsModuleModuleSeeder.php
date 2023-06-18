<?php

namespace Modules\KeyWords\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;

class KeyWordsModuleModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // Seed Module KeyWords 
        DB::table('modules')->insert([
            'name' => 'Key Words Module',
            'description' => 'Key Words Module',
        ]);

        // Attach module to packages module
        $module = DB::table('modules')->where('name', 'Key Words Module')->first();
        $package = DB::table('packages')->first();
        DB::table('package_modules')->insert([
            'package_id' => $package->id,
            'module_id' => $module->id
        ]);
    }
}
