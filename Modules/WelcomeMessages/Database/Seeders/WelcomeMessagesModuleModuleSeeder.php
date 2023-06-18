<?php

namespace Modules\WelcomeMessages\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;

class WelcomeMessagesModuleModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // Seed Module
        DB::table('modules')->insert([
            'name' => 'Welcome Messages Module',
            'description' => 'Welcome Messages Module',
        ]);

        // Seed Package Modules
        $module=DB::table('modules')->where('name','Welcome Messages Module')->first();
        $package = DB::table('packages')->first();
        DB::table('package_modules')->insert([
            'package_id' => $package->id,
            'module_id' => $module->id
        ]);

    }
}
