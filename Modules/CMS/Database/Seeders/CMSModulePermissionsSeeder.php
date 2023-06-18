<?php

namespace Modules\CMS\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CMSModulePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $module_id = DB::table('modules')->where('name', 'CMS Module')->first()->id;

        DB::table('permissions')->insert([
            // Manage CMS Managements
            [
                'id' => 536,
                'parent_id' => null,
                'name' => 'Manage Faqs',
                'slug' => 'manage-faqs',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 537,
                'parent_id' => 536,
                'name' => 'Index Faqs',
                'slug' => 'index-faqs',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 538,
                'parent_id' => 536,
                'name' => 'Create Faq',
                'slug' => 'create-faq',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 539,
                'parent_id' => 536,
                'name' => 'Update Faq',
                'slug' => 'update-faq',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 540,
                'parent_id' => 536,
                'name' => 'Delete Faq',
                'slug' => 'delete-faq',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],

            // Terms
            [
                'id' => 541,
                'parent_id' => null,
                'name' => 'Manage Terms & Conditions',
                'slug' => 'manage-terms-conditions',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 542,
                'parent_id' => 541,
                'name' => 'Index Terms & Conditions',
                'slug' => 'index-terms-conditions',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 543,
                'parent_id' => 541,
                'name' => 'Create Terms & Condition',
                'slug' => 'create-terms-condition',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 544,
                'parent_id' => 541,
                'name' => 'Update Terms & Condition',
                'slug' => 'update-terms-condition',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 545,
                'parent_id' => 541,
                'name' => 'Delete Terms & Condition',
                'slug' => 'delete-terms-condition',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],

            // // Rules
            // [
            //     'id' => 546,
            //     'parent_id' => null,
            //     'name' => 'Manage Rules & Regulations',
            //     'slug' => 'manage-rules-regulations',
            //     'is_hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 547,
            //     'parent_id' => 546,
            //     'name' => 'Index Rules & Regulations',
            //     'slug' => 'index-rules-regulations',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 548,
            //     'parent_id' => 546,
            //     'name' => 'Create Rules & Regulation',
            //     'slug' => 'create-rules-regulation',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 549,
            //     'parent_id' => 546,
            //     'name' => 'Update Rules & Regulation',
            //     'slug' => 'update-rules-regulation',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 550,
            //     'parent_id' => 546,
            //     'name' => 'Delete Rules & Regulation',
            //     'slug' => 'delete-rules-regulation',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],

            // // Privacy Policy
            // [
            //     'id' => 551,
            //     'parent_id' => null,
            //     'name' => 'Manage Privacy Policies',
            //     'slug' => 'manage-privacy-policies',
            //     'is_hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 552,
            //     'parent_id' => 551,
            //     'name' => 'Index Privacy Policies',
            //     'slug' => 'index-privacy-policies',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 553,
            //     'parent_id' => 551,
            //     'name' => 'Create Privacy Policy',
            //     'slug' => 'create-privacy-policy',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 554,
            //     'parent_id' => 551,
            //     'name' => 'Update Privacy Policy',
            //     'slug' => 'update-privacy-policy',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 555,
            //     'parent_id' => 551,
            //     'name' => 'Delete Privacy Policy',
            //     'slug' => 'delete-privacy-policy',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],

            // // Return Policy
            // [
            //     'id' => 556,
            //     'parent_id' => null,
            //     'name' => 'Manage Return Policies',
            //     'slug' => 'manage-return-policies',
            //     'is_hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 557,
            //     'parent_id' => 556,
            //     'name' => 'Index Return Policies',
            //     'slug' => 'index-return-policies',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 558,
            //     'parent_id' => 556,
            //     'name' => 'Create Return Policy',
            //     'slug' => 'create-return-policy',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 559,
            //     'parent_id' => 556,
            //     'name' => 'Update Return Policy',
            //     'slug' => 'update-return-policy',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 560,
            //     'parent_id' => 556,
            //     'name' => 'Delete Return Policy',
            //     'slug' => 'delete-return-policy',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],

            // // Delivery Detail
            // [
            //     'id' => 561,
            //     'parent_id' => null,
            //     'name' => 'Manage Delivery Details',
            //     'slug' => 'manage-delivery-details',
            //     'is_hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 562,
            //     'parent_id' => 561,
            //     'name' => 'Index Delivery Details',
            //     'slug' => 'index-delivery-details',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 563,
            //     'parent_id' => 561,
            //     'name' => 'Create Delivery Detail',
            //     'slug' => 'create-delivery-detail',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 564,
            //     'parent_id' => 561,
            //     'name' => 'Update Delivery Detail',
            //     'slug' => 'update-delivery-detail',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 565,
            //     'parent_id' => 561,
            //     'name' => 'Delete Delivery Detail',
            //     'slug' => 'delete-delivery-detail',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],

            // // Payment & Securities
            // [
            //     'id' => 566,
            //     'parent_id' => null,
            //     'name' => 'Manage Payment & Securities',
            //     'slug' => 'manage-payment-securities',
            //     'is_hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 567,
            //     'parent_id' => 566,
            //     'name' => 'Index Payment & Securities',
            //     'slug' => 'index-payment-securities',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 568,
            //     'parent_id' => 566,
            //     'name' => 'Create Payment & Security',
            //     'slug' => 'create-payment-security',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 569,
            //     'parent_id' => 566,
            //     'name' => 'Update Payment & Security',
            //     'slug' => 'update-payment-security',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 570,
            //     'parent_id' => 566,
            //     'name' => 'Delete Payment & Security',
            //     'slug' => 'delete-payment-security',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],

            // // Cookies
            // [
            //     'id' => 571,
            //     'parent_id' => null,
            //     'name' => 'Manage Cookies',
            //     'slug' => 'manage-cookies',
            //     'is_hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 572,
            //     'parent_id' => 571,
            //     'name' => 'Index Cookies',
            //     'slug' => 'index-cookies',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 573,
            //     'parent_id' => 571,
            //     'name' => 'Create Cooky',
            //     'slug' => 'create-cooky',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 574,
            //     'parent_id' => 571,
            //     'name' => 'Update Cooky',
            //     'slug' => 'update-cooky',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 575,
            //     'parent_id' => 571,
            //     'name' => 'Delete Cooky',
            //     'slug' => 'delete-cooky',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
        ]);
    }
}
