<?php

namespace Modules\Socials\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SocialsModuleGroupPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('group_permissions')->insert([
            // Technical Support group permissions
            ['group_id' => 1, 'permission_id' => 328, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 329, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 330, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 331, 'created_at' => Carbon::now()],
            ['group_id' => 1, 'permission_id' => 332, 'created_at' => Carbon::now()],
            
            // General Manager group permissions
            ['group_id' => 2, 'permission_id' => 328, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 329, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 330, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 331, 'created_at' => Carbon::now()],
            ['group_id' => 2, 'permission_id' => 332, 'created_at' => Carbon::now()],
           
        ]);
    }
}
