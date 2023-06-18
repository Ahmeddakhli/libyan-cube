<?php

namespace Modules\Socials\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;

class SocialsModuleModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        
        DB::table('modules')->insert([
            'name' => 'Socials Module',
            'description' => 'Socials Module',
        ]);

        $module = DB::table('modules')->where('name', 'Socials Module')->first();
        $package = DB::table('packages')->first();
        DB::table('package_modules')->insert([
            'package_id' => $package->id,
            'module_id' => $module->id
        ]);
    }
}
