<?php

namespace Modules\Notifications\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;
class NotificationsModuleSeeder extends Seeder
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
            'name' => 'Notifications Module',
            'description' => 'Notifications Module',
        ]);
        $module=DB::table('modules')->where('name','Notifications Module')->first();
        $package = DB::table('packages')->first();
        DB::table('package_modules')->insert([
            'package_id' => $package->id,
            'module_id' => $module->id
        ]);

    }
}
