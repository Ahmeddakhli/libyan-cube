<?php

namespace Modules\Settings\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SettingsModulePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $module_id = DB::table('modules')->where('name', 'Settings Module')->first()->id;

        DB::table('permissions')->insert([
            // Manage Footer Links
            [
                'id' => 343,
                'parent_id' => null,
                'name' => 'Manage Settings Footer Links',
                'slug' => 'manage-settings-footer-links',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 344,
                'parent_id' => 343,
                'name' => 'Index Footer Links',
                'slug' => 'index-settings-footer-links',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 345,
                'parent_id' => 343,
                'name' => 'Create Footer Link',
                'slug' => 'create-settings-footer-link',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 346,
                'parent_id' => 343,
                'name' => 'Update Footer Link',
                'slug' => 'update-settings-footer-link',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 347,
                'parent_id' => 343,
                'name' => 'Delete Footer Link',
                'slug' => 'delete-settings-footer-link',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],

            // Manage Logos 
            [
                'id' => 348,
                'parent_id' => null,
                'name' => 'Manage Settings Logos',
                'slug' => 'manage-settings-logos',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 349,
                'parent_id' => 348,
                'name' => 'Index Settings Logos',
                'slug' => 'index-settings-logos',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 350,
                'parent_id' => 348,
                'name' => 'Create Settings Logo',
                'slug' => 'create-settings-logo',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 351,
                'parent_id' => 348,
                'name' => 'Update Settings Logo',
                'slug' => 'update-settings-logo',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 352,
                'parent_id' => 348,
                'name' => 'Delete Settings Logo',
                'slug' => 'delete-settings-logo',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],

            // Manage Contacts 
            [
                'id' => 353,
                'parent_id' => null,
                'name' => 'Manage Settings Contacts',
                'slug' => 'manage-settings-contacts',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 354,
                'parent_id' => 353,
                'name' => 'Index Settings Contacts',
                'slug' => 'index-settings-contacts',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 355,
                'parent_id' => 353,
                'name' => 'Create Settings Contact',
                'slug' => 'create-settings-contact',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 356,
                'parent_id' => 353,
                'name' => 'Update Settings Contact',
                'slug' => 'update-settings-contact',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 357,
                'parent_id' => 353,
                'name' => 'Delete Settings Contact',
                'slug' => 'delete-settings-contact',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],

            // Manage Main Sliders 
            [
                'id' => 358,
                'parent_id' => null,
                'name' => 'Manage Settings Main Sliders',
                'slug' => 'manage-settings-main-sliders',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 359,
                'parent_id' => 358,
                'name' => 'Index Settings Main Sliders',
                'slug' => 'index-settings-main-sliders',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 360,
                'parent_id' => 358,
                'name' => 'Create Settings Main Slider',
                'slug' => 'create-settings-main-slider',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 361,
                'parent_id' => 358,
                'name' => 'Update Settings Main Slider',
                'slug' => 'update-settings-main-slider',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 362,
                'parent_id' => 358,
                'name' => 'Delete Settings Main Slider',
                'slug' => 'delete-settings-main-slider',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],

            // Manage Teems 
            [
                'id' => 393,
                'parent_id' => null,
                'name' => 'Manage Settings Teems',
                'slug' => 'manage-settings-teems',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 394,
                'parent_id' => 393,
                'name' => 'Index Settings Teems',
                'slug' => 'index-settings-teems',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 395,
                'parent_id' => 393,
                'name' => 'Create Settings Teem',
                'slug' => 'create-settings-teem',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 396,
                'parent_id' => 393,
                'name' => 'Update Settings Teem',
                'slug' => 'update-settings-teem',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 397,
                'parent_id' => 393,
                'name' => 'Delete Settings Teem',
                'slug' => 'delete-settings-teem',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],

            // Manage Branches
            [
                'id' => 403,
                'parent_id' => null,
                'name' => 'Manage Settings Branches',
                'slug' => 'manage-settings-branches',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 404,
                'parent_id' => 403,
                'name' => 'Index Settings Branches',
                'slug' => 'index-settings-branches',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 405,
                'parent_id' => 403,
                'name' => 'Create Settings Branch',
                'slug' => 'create-settings-branch',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 406,
                'parent_id' => 403,
                'name' => 'Update Settings Branch',
                'slug' => 'update-settings-branch',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 407,
                'parent_id' => 403,
                'name' => 'Delete Settings Branch',
                'slug' => 'delete-settings-branch',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],

            // Manage How works
            [
                'id' => 546,
                'parent_id' => null,
                'name' => 'Manage Settings How Works',
                'slug' => 'manage-settings-how-works',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 547,
                'parent_id' => 546,
                'name' => 'Index Settings How Works',
                'slug' => 'index-settings-how-works',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 548,
                'parent_id' => 546,
                'name' => 'Create Settings How Work',
                'slug' => 'create-settings-how-work',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 549,
                'parent_id' => 546,
                'name' => 'Update Settings How Work',
                'slug' => 'update-settings-how-work',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 550,
                'parent_id' => 546,
                'name' => 'Delete Settings How Work',
                'slug' => 'delete-settings-how-work',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
        ]);
    }
}
