<?php

namespace Modules\Inventory\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB, Carbon\Carbon;

class IPurposeTypeTranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('i_purpose_type_trans')->insert([
            ['i_purpose_type_id' => 1, 'language_id' => 1, 'purpose_type' => 'Apartment', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 1, 'language_id' => 2, 'purpose_type' => 'شقة', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 2, 'language_id' => 1, 'purpose_type' => 'Villa', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 2, 'language_id' => 2, 'purpose_type' => 'فيلا', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 3, 'language_id' => 1, 'purpose_type' => 'Duplex', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 3, 'language_id' => 2, 'purpose_type' => 'دوبلكس', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 4, 'language_id' => 1, 'purpose_type' => 'Townhouse', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 4, 'language_id' => 2, 'purpose_type' => 'تاون هاوس', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 5, 'language_id' => 1, 'purpose_type' => 'Penthouse', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 5, 'language_id' => 2, 'purpose_type' => 'بنتهاوس', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 6, 'language_id' => 1, 'purpose_type' => 'Land', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 6, 'language_id' => 2, 'purpose_type' => 'أرض', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 7, 'language_id' => 1, 'purpose_type' => 'Twin House', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 7, 'language_id' => 2, 'purpose_type' => 'توين هاوس', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 8, 'language_id' => 1, 'purpose_type' => 'Standalone Villa', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 8, 'language_id' => 2, 'purpose_type' => 'فيلا مستقلة', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 9, 'language_id' => 1, 'purpose_type' => 'Rooftop', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 9, 'language_id' => 2, 'purpose_type' => 'على السطح', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 10, 'language_id' => 1, 'purpose_type' => 'Studio', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 10, 'language_id' => 2, 'purpose_type' => 'ستوديو', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 11, 'language_id' => 1, 'purpose_type' => 'Basement', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 11, 'language_id' => 2, 'purpose_type' => 'قبو', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],

            ['i_purpose_type_id' => 12, 'language_id' => 1, 'purpose_type' => 'Shop', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 12, 'language_id' => 2, 'purpose_type' => 'محل', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 13, 'language_id' => 1, 'purpose_type' => 'Store', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 13, 'language_id' => 2, 'purpose_type' => 'Store', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 14, 'language_id' => 1, 'purpose_type' => 'Villa', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 14, 'language_id' => 2, 'purpose_type' => 'فيلا', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 15, 'language_id' => 1, 'purpose_type' => 'Exhibition', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 15, 'language_id' => 2, 'purpose_type' => 'معرض', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 16, 'language_id' => 1, 'purpose_type' => 'Cafe/Restaurant', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 16, 'language_id' => 2, 'purpose_type' => 'مقهى / مطعم', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 17, 'language_id' => 1, 'purpose_type' => 'Retail', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 17, 'language_id' => 2, 'purpose_type' => 'قطاعي', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 18, 'language_id' => 1, 'purpose_type' => 'Retail (Showroom)', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 18, 'language_id' => 2, 'purpose_type' => 'البيع بالتجزئة (صالة العرض)', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 19, 'language_id' => 1, 'purpose_type' => 'Bank', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 19, 'language_id' => 2, 'purpose_type' => 'مصرف', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 20, 'language_id' => 1, 'purpose_type' => 'Factory', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 20, 'language_id' => 2, 'purpose_type' => 'مصنع', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 21, 'language_id' => 1, 'purpose_type' => 'Storage', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 21, 'language_id' => 2, 'purpose_type' => 'تخزين', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 22, 'language_id' => 1, 'purpose_type' => 'Land', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 22, 'language_id' => 2, 'purpose_type' => 'أرض', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],

            ['i_purpose_type_id' => 23, 'language_id' => 1, 'purpose_type' => 'Apartment', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 23, 'language_id' => 2, 'purpose_type' => 'شقة', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 24, 'language_id' => 1, 'purpose_type' => 'Villa', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 24, 'language_id' => 2, 'purpose_type' => 'فيلا', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 25, 'language_id' => 1, 'purpose_type' => 'Duplex', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 25, 'language_id' => 2, 'purpose_type' => 'دوبلكس', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 26, 'language_id' => 1, 'purpose_type' => 'Standalone Villa', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 26, 'language_id' => 2, 'purpose_type' => 'فيلا مستقلة', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 27, 'language_id' => 1, 'purpose_type' => 'Chalet', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_purpose_type_id' => 27, 'language_id' => 2, 'purpose_type' => 'شاليه', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
        ]);
    }
}
