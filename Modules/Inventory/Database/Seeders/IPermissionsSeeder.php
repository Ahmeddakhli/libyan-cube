<?php

namespace Modules\Inventory\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class IPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $module_id = DB::table('modules')->where('name', 'Inventory Module')->first()->id;

        DB::table('permissions')->insert([
            // Manage Developers
            [
                'id' => 188,
                'parent_id' => null,
                'name' => 'Manage Inventory Developers',
                'slug' => 'manage-inventory-developers',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 189,
                'parent_id' => 188,
                'name' => 'Index Inventory Developers',
                'slug' => 'index-inventory-developers',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 190,
                'parent_id' => 188,
                'name' => 'Create Inventory Developer',
                'slug' => 'create-inventory-developer',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 191,
                'parent_id' => 188,
                'name' => 'Update Inventory Developer',
                'slug' => 'update-inventory-developer',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 192,
                'parent_id' => 188,
                'name' => 'Delete Inventory Developer',
                'slug' => 'delete-inventory-developer',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],

            // Manage Area Units
            [
                'id' => 194,
                'parent_id' => null,
                'name' => 'Manage Inventory Area Units',
                'slug' => 'manage-inventory-area-units',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 195,
                'parent_id' => 194,
                'name' => 'Index Inventory Area Units',
                'slug' => 'index-inventory-area-units',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 196,
                'parent_id' => 194,
                'name' => 'Create Inventory Area Unit',
                'slug' => 'create-inventory-area-unit',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 197,
                'parent_id' => 194,
                'name' => 'Update Inventory Area Unit',
                'slug' => 'update-inventory-area-unit',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 198,
                'parent_id' => 194,
                'name' => 'Delete Inventory Area Unit',
                'slug' => 'delete-inventory-area-unit',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],

            // Manage Bathrooms
            [
                'id' => 199,
                'parent_id' => null,
                'name' => 'Manage Inventory Bathrooms',
                'slug' => 'manage-inventory-bathrooms',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 200,
                'parent_id' => 199,
                'name' => 'Index Inventory Bathrooms',
                'slug' => 'index-inventory-bathrooms',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 201,
                'parent_id' => 199,
                'name' => 'Create Inventory Bathroom',
                'slug' => 'create-inventory-bathroom',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 202,
                'parent_id' => 199,
                'name' => 'Update Inventory Bathroom',
                'slug' => 'update-inventory-bathroom',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 203,
                'parent_id' => 199,
                'name' => 'Delete Inventory Bathroom',
                'slug' => 'delete-inventory-bathroom',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],

            // Manage Bedrooms
            [
                'id' => 204,
                'parent_id' => null,
                'name' => 'Manage Inventory Bedrooms',
                'slug' => 'manage-inventory-bedrooms',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 205,
                'parent_id' => 204,
                'name' => 'Index Inventory Bedrooms',
                'slug' => 'index-inventory-bedrooms',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 206,
                'parent_id' => 204,
                'name' => 'Create Inventory Bedroom',
                'slug' => 'create-inventory-bedroom',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 207,
                'parent_id' => 204,
                'name' => 'Update Inventory Bedroom',
                'slug' => 'update-inventory-bedroom',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 208,
                'parent_id' => 204,
                'name' => 'Delete Inventory Bedroom',
                'slug' => 'delete-inventory-bedroom',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],

            // Manage Finishing Types
            [
                'id' => 209,
                'parent_id' => null,
                'name' => 'Manage Inventory Finishing Types',
                'slug' => 'manage-inventory-finishing-types',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 210,
                'parent_id' => 209,
                'name' => 'Index Inventory Finishing Types',
                'slug' => 'index-inventory-finishing-types',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 211,
                'parent_id' => 209,
                'name' => 'Create Inventory Finishing Type',
                'slug' => 'create-inventory-finishing-type',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 212,
                'parent_id' => 209,
                'name' => 'Update Inventory Finishing Type',
                'slug' => 'update-inventory-finishing-type',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 213,
                'parent_id' => 209,
                'name' => 'Delete Inventory Finishing Type',
                'slug' => 'delete-inventory-finishing-type',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],

            // Manage Furnishing Statuses
            [
                'id' => 214,
                'parent_id' => null,
                'name' => 'Manage Inventory Furnishing Statuses',
                'slug' => 'manage-inventory-furnishing-statuses',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 215,
                'parent_id' => 214,
                'name' => 'Index Inventory Furnishing Statuses',
                'slug' => 'index-inventory-furnishing-statuses',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 216,
                'parent_id' => 214,
                'name' => 'Create Inventory Furnishing Status',
                'slug' => 'create-inventory-furnishing-status',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 217,
                'parent_id' => 214,
                'name' => 'Update Inventory Furnishing Status',
                'slug' => 'update-inventory-furnishing-status',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 218,
                'parent_id' => 214,
                'name' => 'Delete Inventory Furnishing Status',
                'slug' => 'delete-inventory-furnishing-status',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],

            // Manage Offering Types
            [
                'id' => 219,
                'parent_id' => null,
                'name' => 'Manage Inventory Offering Types',
                'slug' => 'manage-inventory-offering-types',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 220,
                'parent_id' => 219,
                'name' => 'Index Inventory Offering Types',
                'slug' => 'index-inventory-offering-types',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 221,
                'parent_id' => 219,
                'name' => 'Create Inventory Offering Type',
                'slug' => 'create-inventory-offering-type',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 222,
                'parent_id' => 219,
                'name' => 'Update Inventory Offering Type',
                'slug' => 'update-inventory-offering-type',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 223,
                'parent_id' => 219,
                'name' => 'Delete Inventory Offering Type',
                'slug' => 'delete-inventory-offering-type',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],

            // Manage Payment Methods
            [
                'id' => 224,
                'parent_id' => null,
                'name' => 'Manage Inventory Payment Methods',
                'slug' => 'manage-inventory-payment-methods',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 225,
                'parent_id' => 224,
                'name' => 'Index Inventory Payment Methods',
                'slug' => 'index-inventory-payment-methods',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 226,
                'parent_id' => 224,
                'name' => 'Create Inventory Payment Method',
                'slug' => 'create-inventory-payment-method',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 227,
                'parent_id' => 224,
                'name' => 'Update Inventory Payment Method',
                'slug' => 'update-inventory-payment-method',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 228,
                'parent_id' => 224,
                'name' => 'Delete Inventory Payment Method',
                'slug' => 'delete-inventory-payment-method',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],

            // Manage Positions
            // [
            //     'id' => 229,
            //     'parent_id' => null,
            //     'name' => 'Manage Inventory Positions',
            //     'slug' => 'manage-inventory-positions',
            //     'is_hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 230,
            //     'parent_id' => 229,
            //     'name' => 'Index Inventory Positions',
            //     'slug' => 'index-inventory-positions',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 231,
            //     'parent_id' => 229,
            //     'name' => 'Create Inventory Position',
            //     'slug' => 'create-inventory-position',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 232,
            //     'parent_id' => 229,
            //     'name' => 'Update Inventory Position',
            //     'slug' => 'update-inventory-position',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 233,
            //     'parent_id' => 229,
            //     'name' => 'Delete Inventory Position',
            //     'slug' => 'delete-inventory-position',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],

            // Manage Views
            // [
            //     'id' => 234,
            //     'parent_id' => null,
            //     'name' => 'Manage Inventory Views',
            //     'slug' => 'manage-inventory-views',
            //     'is_hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 235,
            //     'parent_id' => 234,
            //     'name' => 'Index Inventory Views',
            //     'slug' => 'index-inventory-views',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 236,
            //     'parent_id' => 234,
            //     'name' => 'Create Inventory View',
            //     'slug' => 'create-inventory-view',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 237,
            //     'parent_id' => 234,
            //     'name' => 'Update Inventory View',
            //     'slug' => 'update-inventory-view',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 238,
            //     'parent_id' => 234,
            //     'name' => 'Delete Inventory View',
            //     'slug' => 'delete-inventory-view',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],

            // Manage Facilities
            [
                'id' => 239,
                'parent_id' => null,
                'name' => 'Manage Inventory Facilities',
                'slug' => 'manage-inventory-facilities',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 240,
                'parent_id' => 239,
                'name' => 'Index Inventory Facilities',
                'slug' => 'index-inventory-facilities',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 241,
                'parent_id' => 239,
                'name' => 'Create Inventory Facility',
                'slug' => 'create-inventory-facility',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 242,
                'parent_id' => 239,
                'name' => 'Update Inventory Facility',
                'slug' => 'update-inventory-facility',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 243,
                'parent_id' => 239,
                'name' => 'Delete Inventory Facility',
                'slug' => 'delete-inventory-facility',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],

            // Manage Amenities
            [
                'id' => 244,
                'parent_id' => null,
                'name' => 'Manage Inventory Amenities',
                'slug' => 'manage-inventory-amenities',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 245,
                'parent_id' => 244,
                'name' => 'Index Inventory Amenities',
                'slug' => 'index-inventory-amenities',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 246,
                'parent_id' => 244,
                'name' => 'Create Inventory Amenity',
                'slug' => 'create-inventory-amenity',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 247,
                'parent_id' => 244,
                'name' => 'Update Inventory Amenity',
                'slug' => 'update-inventory-amenity',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 248,
                'parent_id' => 244,
                'name' => 'Delete Inventory Amenity',
                'slug' => 'delete-inventory-amenity',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],

            // Manage Purposes
            [
                'id' => 249,
                'parent_id' => null,
                'name' => 'Manage Inventory Purposes',
                'slug' => 'manage-inventory-purposes',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 250,
                'parent_id' => 249,
                'name' => 'Index Inventory Purposes',
                'slug' => 'index-inventory-purposes',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 251,
                'parent_id' => 249,
                'name' => 'Create Inventory Purpose',
                'slug' => 'create-inventory-purpose',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 252,
                'parent_id' => 249,
                'name' => 'Update Inventory Purpose',
                'slug' => 'update-inventory-purpose',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 253,
                'parent_id' => 249,
                'name' => 'Delete Inventory Purpose',
                'slug' => 'delete-inventory-purpose',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],

            // Manage Purpose Types
            [
                'id' => 254,
                'parent_id' => null,
                'name' => 'Manage Inventory Purpose Types',
                'slug' => 'manage-inventory-purpose-types',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 255,
                'parent_id' => 254,
                'name' => 'Index Inventory Purpose Types',
                'slug' => 'index-inventory-purpose-types',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 256,
                'parent_id' => 254,
                'name' => 'Create Inventory Purpose Type',
                'slug' => 'create-inventory-purpose-type',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 257,
                'parent_id' => 254,
                'name' => 'Update Inventory Purpose Type',
                'slug' => 'update-inventory-purpose-type',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 258,
                'parent_id' => 254,
                'name' => 'Delete Inventory Purpose Type',
                'slug' => 'delete-inventory-purpose-type',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],

            // Manage Projects
            [
                'id' => 259,
                'parent_id' => null,
                'name' => 'Manage Inventory Projects',
                'slug' => 'manage-inventory-projects',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 260,
                'parent_id' => 259,
                'name' => 'Index Inventory Projects',
                'slug' => 'index-inventory-projects',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 261,
                'parent_id' => 259,
                'name' => 'Create Inventory Project',
                'slug' => 'create-inventory-project',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 262,
                'parent_id' => 259,
                'name' => 'Update Inventory Project',
                'slug' => 'update-inventory-project',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 263,
                'parent_id' => 259,
                'name' => 'Delete Inventory Project',
                'slug' => 'delete-inventory-project',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],

            // Manage Units
            [
                'id' => 264,
                'parent_id' => null,
                'name' => 'Manage Inventory Units',
                'slug' => 'manage-inventory-units',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 265,
                'parent_id' => 264,
                'name' => 'Index Inventory Units',
                'slug' => 'index-inventory-units',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 266,
                'parent_id' => 264,
                'name' => 'Create Inventory Unit',
                'slug' => 'create-inventory-unit',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 267,
                'parent_id' => 264,
                'name' => 'Update Inventory Unit',
                'slug' => 'update-inventory-unit',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 268,
                'parent_id' => 264,
                'name' => 'Delete Inventory Unit',
                'slug' => 'delete-inventory-unit',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 269,
                'parent_id' => 264,
                'name' => 'View Inventory Unit',
                'slug' => 'view-inventory-unit',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 270,
                'parent_id' => 264,
                'name' => 'Export Inventory Unit',
                'slug' => 'export-inventory-unit',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 273,
                'parent_id' => 264,
                'name' => 'Delete Inventory Unit Attachment',
                'slug' => 'delete-inventory-unit-attachment',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],

            // Manage Publish Times
            // [
            //     'id' => 274,
            //     'parent_id' => null,
            //     'name' => 'Manage Inventory Publish Times',
            //     'slug' => 'manage-inventory-publish-times',
            //     'is_hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 275,
            //     'parent_id' => 274,
            //     'name' => 'Index Inventory Publish Times',
            //     'slug' => 'index-inventory-publish-times',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 276,
            //     'parent_id' => 274,
            //     'name' => 'Create Inventory Publish Time',
            //     'slug' => 'create-inventory-publish-time',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 277,
            //     'parent_id' => 274,
            //     'name' => 'Update Inventory Publish Time',
            //     'slug' => 'update-inventory-publish-time',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 278,
            //     'parent_id' => 274,
            //     'name' => 'Delete Inventory Publish Time',
            //     'slug' => 'delete-inventory-publish-time',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],

            // Manage Rental Cases
            // [
            //     'id' => 279,
            //     'parent_id' => null,
            //     'name' => 'Manage Inventory Rental Cases',
            //     'slug' => 'manage-inventory-rental-cases',
            //     'is_hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 280,
            //     'parent_id' => 279,
            //     'name' => 'Index Inventory Rental Cases',
            //     'slug' => 'index-inventory-rental-cases',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 281,
            //     'parent_id' => 279,
            //     'name' => 'Create Inventory Rental Case',
            //     'slug' => 'create-inventory-rental-case',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 282,
            //     'parent_id' => 279,
            //     'name' => 'Update Inventory Rental Case',
            //     'slug' => 'update-inventory-rental-case',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 283,
            //     'parent_id' => 279,
            //     'name' => 'Delete Inventory Rental Case',
            //     'slug' => 'delete-inventory-rental-case',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],

            // Manage Floor Numbers
            // [
            //     'id' => 292,
            //     'parent_id' => null,
            //     'name' => 'Manage Inventory Floor Numbers',
            //     'slug' => 'manage-inventory-floor-numbers',
            //     'is_hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 293,
            //     'parent_id' => 292,
            //     'name' => 'Index Inventory Floor numbers',
            //     'slug' => 'index-inventory-floor-numbers',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 294,
            //     'parent_id' => 292,
            //     'name' => 'Create Inventory Floor Number',
            //     'slug' => 'create-inventory-floor-number',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 295,
            //     'parent_id' => 292,
            //     'name' => 'Update Inventory Floor Number',
            //     'slug' => 'update-inventory-floor-number',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 296,
            //     'parent_id' => 292,
            //     'name' => 'Delete Inventory Floor Number',
            //     'slug' => 'delete-inventory-floor-number',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 297,
            //     'parent_id' => 259,
            //     'name' => 'Export Inventory Projects',
            //     'slug' => 'export-inventory-projects',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],

            // Manage Phases
            // [
            //     'id' => 298,
            //     'parent_id' => null,
            //     'name' => 'Manage Inventory phases',
            //     'slug' => 'manage-inventory-phases',
            //     'is_hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 299,
            //     'parent_id' => 298,
            //     'name' => 'Index Inventory phases',
            //     'slug' => 'index-inventory-phases',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 300,
            //     'parent_id' => 298,
            //     'name' => 'Create Inventory phase',
            //     'slug' => 'create-inventory-phase',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 301,
            //     'parent_id' => 298,
            //     'name' => 'Update Inventory phase',
            //     'slug' => 'update-inventory-phase',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 302,
            //     'parent_id' => 298,
            //     'name' => 'Delete Inventory phase',
            //     'slug' => 'delete-inventory-phase',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],

            // Manage Design Types
            // [
            //     'id' => 368,
            //     'parent_id' => null,
            //     'name' => 'Manage Inventory Design Types',
            //     'slug' => 'manage-inventory-design-types',
            //     'is_hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 369,
            //     'parent_id' => 368,
            //     'name' => 'Index Inventory Design Types',
            //     'slug' => 'index-inventory-design-types',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 370,
            //     'parent_id' => 368,
            //     'name' => 'Create Inventory Design Type',
            //     'slug' => 'create-inventory-design-type',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 371,
            //     'parent_id' => 368,
            //     'name' => 'Update Inventory Design Type',
            //     'slug' => 'update-inventory-design-type',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],
            // [
            //     'id' => 372,
            //     'parent_id' => 368,
            //     'name' => 'Delete Inventory Design Type',
            //     'slug' => 'delete-inventory-design-type',
            //     'is_Hidden' => 0,
            //     'created_at' => Carbon::now(),
            //     'module_id' => $module_id
            // ],

            // Manage Sell Requests
            [
                'id' => 378,
                'parent_id' => null,
                'name' => 'Manage Inventory Sell Requests',
                'slug' => 'manage-inventory-sell-requests',
                'is_hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 379,
                'parent_id' => 378,
                'name' => 'Index Inventory Sell Requests',
                'slug' => 'index-inventory-sell-requests',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 380,
                'parent_id' => 378,
                'name' => 'Create Inventory Sell Request',
                'slug' => 'create-inventory-sell-request',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 381,
                'parent_id' => 378,
                'name' => 'Update Inventory Sell Request',
                'slug' => 'update-inventory-sell-request',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
            [
                'id' => 382,
                'parent_id' => 378,
                'name' => 'Delete Inventory Sell Request',
                'slug' => 'delete-inventory-sell-request',
                'is_Hidden' => 0,
                'created_at' => Carbon::now(),
                'module_id' => $module_id
            ],
        ]);
    }
}
