<?php

namespace Modules\ContactUS\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ContactUSModulePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $module_id = DB::table('modules')->where('name','ContactUS Module')->first()->id;

        DB::table('permissions')->insert([
            // Manage Contact US Messages
            [
                'id' => 313,
                'parent_id' => null,
                'name' => 'Manage Contact US Messages',
                'slug' => 'manage-contact-us',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 314,
                'parent_id' => 313,
                'name' => 'Index Contact US Messages',
                'slug' => 'index-contact-us',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 315,
                'parent_id' => 313,
                'name' => 'Create Contact Us Message',
                'slug' => 'create-contact-us',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 316,
                'parent_id' => 313,
                'name' => 'Update Contact Us Message',
                'slug' => 'update-contact-us',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 317,
                'parent_id' => 313,
                'name' => 'Delete Contact Us Message',
                'slug' => 'delete-contact-us',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 408,
                'parent_id' => 313,
                'name' => 'Export Contact Us Messages',
                'slug' => 'export-contact-us-messages',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],

              // Manage Subscribe mails
              [
                'id' => 398,
                'parent_id' => null,
                'name' => 'Manage Subscribe Mails',
                'slug' => 'manage-subscribe-mails',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 399,
                'parent_id' => 398,
                'name' => 'Index Subscribe mails',
                'slug' => 'index-subscribe-mails',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 400,
                'parent_id' => 398,
                'name' => 'Create Subscribe mail',
                'slug' => 'create-subscribe-mail',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 401,
                'parent_id' => 398,
                'name' => 'Update Subscribe mail',
                'slug' => 'update-subscribe-mail',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 402,
                'parent_id' => 398,
                'name' => 'Delete Subscribe mail',
                'slug' => 'delete-subscribe-mail',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
        ]);
    }
}
