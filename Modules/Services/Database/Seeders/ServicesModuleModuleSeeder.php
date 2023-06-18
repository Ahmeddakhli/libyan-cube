<?php

namespace Modules\Services\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;
class ServicesModuleModuleSeeder extends Seeder
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
            'name' => 'Services Module',
            'description' => 'Services Module',
        ]);
        $module=DB::table('modules')->where('name','Services Module')->first();
        $package = DB::table('packages')->first();
        DB::table('package_modules')->insert([
            'package_id' => $package->id,
            'module_id' => $module->id
        ]);

    }
}
