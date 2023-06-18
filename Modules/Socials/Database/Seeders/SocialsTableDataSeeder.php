<?php

namespace Modules\Socials\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB;

class SocialsTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('socials')->insert([
            [
                'id'=>1,
                'link' => 'https://www.facebook.com/',
                'icon' => 'fab fa-facebook-f',
                'is_featured' => 1,
            ],
            [
                'id'=>2,
                'link' => 'https://twitter.com/',
                'icon' => 'fab fa-twitter',
                'is_featured' => 1,
            ],
            [
                'id'=>3,
                'link' => 'https://www.instagram.com/',
                'icon' => 'fab fa-instagram',
                'is_featured' => 1,
            ],
            [
                'id'=>4,
                'link' => 'https://www.linkedin.com/',
                'icon' => 'fab fa-linkedin-in',
                'is_featured' => 1,
            ]
        ]);
        DB::table('social_trans')->insert([
            [
                'id'=>1,
                'language_id' => 2,
                'social_id' => 1,
                'title' => 'فيس بوك',
            ],
            [
                'id'=>2,
                'language_id' => 2,
                'social_id' => 2,
                'title' => 'تويتر',
            ],
            [
                'id'=>3,
                'language_id' => 2,
                'social_id' => 3,
                'title' => 'إنستا',
            ],
            [
                'id'=>4,
                'language_id' => 2,
                'social_id' => 4,
                'title' => 'لينكدإن',
            ]
        ]);
    }
}
