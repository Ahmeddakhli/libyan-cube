<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class HostnamesDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('host_details')->insert([
            [
                'id' => 1,
                'fqdn' => request()->getHttpHost(),
                'package_id' => 1,
                'owner_email' => 'support@8worx.com',
                'owner_mobile_number' =>'01207395400'

            ]
        ]);
        DB::table('host_details')->insert([
            [
                'id' => 2,
                'fqdn' => 'advisors.laravel.com',
                'package_id' => 1,
                'owner_email' => 'support@8worx.com',
                'owner_mobile_number' =>'01207395400'

            ]
        ]);
    }
}
