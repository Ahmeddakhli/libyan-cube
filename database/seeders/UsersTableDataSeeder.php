<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UsersTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // php artisan db:seed --class=UsersTableDataSeeder

        // Technical Support Account
        DB::table('users')->insert([
            'id' => 1,
            'group_id' => 1,
            'full_name' => 'Technical Support',
            'image' => 'front/images/logo.png',
            'username' => 'technical_support',
            'email' => 'technical_support@8worx.com',
            'password' => '$2y$10$H2Vof82ZT3GfX/86sDKy0uXImjiEIiM56DEzKEg/W0k/K2pfZrU3e',
            'mobile_number' => '01207395400',
            'created_at' => Carbon::now()
        ]);

        // General Manager Account
        DB::table('users')->insert([
            'id' => 2,
            'group_id' => 2,
            'full_name' => 'General Manager',
            'image' => 'front/images/logo.png',
            'username' => 'general_manager',
            'email' => 'general_manager@advisors.com',
            'password' => '$2y$10$H2Vof82ZT3GfX/86sDKy0uXImjiEIiM56DEzKEg/W0k/K2pfZrU3e',
            'mobile_number' => '000000000000',
            'created_at' => Carbon::now()
        ]);
    }
}
