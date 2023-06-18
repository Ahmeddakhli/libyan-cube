<?php

namespace Modules\Inventory\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB, Carbon\Carbon;

class IConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('i_config')->insert([
            ['id' => 1, 'field' => 'i_project_id', 'is_full_creation_hidden' => 0, 'is_fast_creation_hidden' => 0, 'is_full_edit_hidden' => 0, 'is_fast_edit_hidden' => 0, 'is_full_view_hidden' => 0, 'is_fast_view_hidden' => 0, 'is_required' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['id' => 2, 'field' => 'i_position_id', 'is_full_creation_hidden' => 0, 'is_fast_creation_hidden' => 0, 'is_full_edit_hidden' => 0, 'is_fast_edit_hidden' => 0, 'is_full_view_hidden' => 0, 'is_fast_view_hidden' => 0, 'is_required' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['id' => 3, 'field' => 'i_view_id', 'is_full_creation_hidden' => 0, 'is_fast_creation_hidden' => 0, 'is_full_edit_hidden' => 0, 'is_fast_edit_hidden' => 0, 'is_full_view_hidden' => 0, 'is_fast_view_hidden' => 0, 'is_required' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['id' => 4, 'field' => 'area', 'is_full_creation_hidden' => 0, 'is_fast_creation_hidden' => 0, 'is_full_edit_hidden' => 0, 'is_fast_edit_hidden' => 0, 'is_full_view_hidden' => 0, 'is_fast_view_hidden' => 0, 'is_required' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['id' => 5, 'field' => 'plot_area', 'is_full_creation_hidden' => 0, 'is_fast_creation_hidden' => 0, 'is_full_edit_hidden' => 0, 'is_fast_edit_hidden' => 0, 'is_full_view_hidden' => 0, 'is_fast_view_hidden' => 0, 'is_required' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['id' => 6, 'field' => 'build_up_area', 'is_full_creation_hidden' => 0, 'is_fast_creation_hidden' => 0, 'is_full_edit_hidden' => 0, 'is_fast_edit_hidden' => 0, 'is_full_view_hidden' => 0, 'is_fast_view_hidden' => 0, 'is_required' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['id' => 7, 'field' => 'i_bedroom_id', 'is_full_creation_hidden' => 0, 'is_fast_creation_hidden' => 0, 'is_full_edit_hidden' => 0, 'is_fast_edit_hidden' => 0, 'is_full_view_hidden' => 0, 'is_fast_view_hidden' => 0, 'is_required' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['id' => 8, 'field' => 'i_bathroom_id', 'is_full_creation_hidden' => 0, 'is_fast_creation_hidden' => 0, 'is_full_edit_hidden' => 0, 'is_fast_edit_hidden' => 0, 'is_full_view_hidden' => 0, 'is_fast_view_hidden' => 0, 'is_required' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['id' => 9, 'field' => 'i_purpose_id', 'is_full_creation_hidden' => 0, 'is_fast_creation_hidden' => 0, 'is_full_edit_hidden' => 0, 'is_fast_edit_hidden' => 0, 'is_full_view_hidden' => 0, 'is_fast_view_hidden' => 0, 'is_required' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['id' => 10, 'field' => 'i_purpose_type_id', 'is_full_creation_hidden' => 0, 'is_fast_creation_hidden' => 0, 'is_full_edit_hidden' => 0, 'is_fast_edit_hidden' => 0, 'is_full_view_hidden' => 0, 'is_fast_view_hidden' => 0, 'is_required' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['id' => 11, 'field' => 'country_id', 'is_full_creation_hidden' => 0, 'is_fast_creation_hidden' => 0, 'is_full_edit_hidden' => 0, 'is_fast_edit_hidden' => 0, 'is_full_view_hidden' => 0, 'is_fast_view_hidden' => 0, 'is_required' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['id' => 12, 'field' => 'region_id', 'is_full_creation_hidden' => 0, 'is_fast_creation_hidden' => 0, 'is_full_edit_hidden' => 0, 'is_fast_edit_hidden' => 0, 'is_full_view_hidden' => 0, 'is_fast_view_hidden' => 0, 'is_required' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['id' => 13, 'field' => 'city_id', 'is_full_creation_hidden' => 0, 'is_fast_creation_hidden' => 0, 'is_full_edit_hidden' => 0, 'is_fast_edit_hidden' => 0, 'is_full_view_hidden' => 0, 'is_fast_view_hidden' => 0, 'is_required' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['id' => 14, 'field' => 'latitude', 'is_full_creation_hidden' => 0, 'is_fast_creation_hidden' => 0, 'is_full_edit_hidden' => 0, 'is_fast_edit_hidden' => 0, 'is_full_view_hidden' => 0, 'is_fast_view_hidden' => 0, 'is_required' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['id' => 15, 'field' => 'longitude', 'is_full_creation_hidden' => 0, 'is_fast_creation_hidden' => 0, 'is_full_edit_hidden' => 0, 'is_fast_edit_hidden' => 0, 'is_full_view_hidden' => 0, 'is_fast_view_hidden' => 0, 'is_required' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['id' => 16, 'field' => 'address', 'is_full_creation_hidden' => 0, 'is_fast_creation_hidden' => 0, 'is_full_edit_hidden' => 0, 'is_fast_edit_hidden' => 0, 'is_full_view_hidden' => 0, 'is_fast_view_hidden' => 0, 'is_required' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['id' => 17, 'field' => 'i_offering_type_id', 'is_full_creation_hidden' => 0, 'is_fast_creation_hidden' => 0, 'is_full_edit_hidden' => 0, 'is_fast_edit_hidden' => 0, 'is_full_view_hidden' => 0, 'is_fast_view_hidden' => 0, 'is_required' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['id' => 18, 'field' => 'price', 'is_full_creation_hidden' => 0, 'is_fast_creation_hidden' => 0, 'is_full_edit_hidden' => 0, 'is_fast_edit_hidden' => 0, 'is_full_view_hidden' => 0, 'is_fast_view_hidden' => 0, 'is_required' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['id' => 19, 'field' => 'description', 'is_full_creation_hidden' => 0, 'is_fast_creation_hidden' => 0, 'is_full_edit_hidden' => 0, 'is_fast_edit_hidden' => 0, 'is_full_view_hidden' => 0, 'is_fast_view_hidden' => 0, 'is_required' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['id' => 20, 'field' => 'i_payment_method_id', 'is_full_creation_hidden' => 0, 'is_fast_creation_hidden' => 0, 'is_full_edit_hidden' => 0, 'is_fast_edit_hidden' => 0, 'is_full_view_hidden' => 0, 'is_fast_view_hidden' => 0, 'is_required' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['id' => 21, 'field' => 'buyer_id', 'is_full_creation_hidden' => 0, 'is_fast_creation_hidden' => 0, 'is_full_edit_hidden' => 0, 'is_fast_edit_hidden' => 0, 'is_full_view_hidden' => 0, 'is_fast_view_hidden' => 0, 'is_required' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['id' => 22, 'field' => 'down_payment', 'is_full_creation_hidden' => 0, 'is_fast_creation_hidden' => 0, 'is_full_edit_hidden' => 0, 'is_fast_edit_hidden' => 0, 'is_full_view_hidden' => 0, 'is_fast_view_hidden' => 0, 'is_required' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['id' => 23, 'field' => 'number_of_installments', 'is_full_creation_hidden' => 0, 'is_fast_creation_hidden' => 0, 'is_full_edit_hidden' => 0, 'is_fast_edit_hidden' => 0, 'is_full_view_hidden' => 0, 'is_fast_view_hidden' => 0, 'is_required' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['id' => 24, 'field' => 'i_area_unit_id', 'is_full_creation_hidden' => 0, 'is_fast_creation_hidden' => 0, 'is_full_edit_hidden' => 0, 'is_fast_edit_hidden' => 0, 'is_full_view_hidden' => 0, 'is_fast_view_hidden' => 0, 'is_required' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['id' => 25, 'field' => 'i_furnishing_status_id', 'is_full_creation_hidden' => 0, 'is_fast_creation_hidden' => 0, 'is_full_edit_hidden' => 0, 'is_fast_edit_hidden' => 0, 'is_full_view_hidden' => 0, 'is_fast_view_hidden' => 0, 'is_required' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['id' => 26, 'field' => 'i_finishing_type_id', 'is_full_creation_hidden' => 0, 'is_fast_creation_hidden' => 0, 'is_full_edit_hidden' => 0, 'is_fast_edit_hidden' => 0, 'is_full_view_hidden' => 0, 'is_fast_view_hidden' => 0, 'is_required' => 0, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
        ]);
    }
}
