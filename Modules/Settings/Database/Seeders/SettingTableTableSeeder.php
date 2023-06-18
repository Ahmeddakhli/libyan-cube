<?php

namespace Modules\Settings\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SettingTableTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();   

        DB::table('settings')->insert([
            'id' => 1,
            'enable_ar' => 1,
            'active_whatsapp_icon' => 1,
            'active_messanger_icon' => 1,
            'active_phone_icon' => 1,
        ]);

    }
}
