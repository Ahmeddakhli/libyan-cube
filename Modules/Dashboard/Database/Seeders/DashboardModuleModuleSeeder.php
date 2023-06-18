<?php

namespace Modules\Dashboard\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;

class DashboardModuleModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        Model::unguard();

        // Create contact us in modules table 
        DB::table('modules')->insert([
            'name' => 'Dashboard Module',
            'description' => 'Dashboard Module',
        ]);

        // Create & connect contact us module with user package 
        $module = DB::table('modules')->where('name', 'Dashboard Module')->first();
        $package = DB::table('packages')->first();
        DB::table('package_modules')->insert([
            'package_id' => $package->id,
            'module_id' => $module->id
        ]);
    }
}
