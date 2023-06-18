<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PackagesTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // php artisan db:seed --class=PackagesTableDataSeeder

        DB::table('packages')->insert([
            // Basic Package
            [
                'id' => 1,
                'name' => 'Basic Package',
                'description' => 'Basic REE.',
                'created_at' => Carbon::now()
            ],
        ]);
    }
}
