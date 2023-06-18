<?php

namespace Modules\Inventory\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use DB, Carbon\Carbon;

class IAmenityTranslationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('i_amenity_trans')->insert([
            ['i_amenity_id' => 'a0f72602-bed0-11ea-b3de-0242ac130004', 'language_id' => 1, 'amenity' => 'Shared Pool', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f72602-bed0-11ea-b3de-0242ac130004', 'language_id' => 2, 'amenity' => 'حمام سباحة مشتركه', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f72990-bed0-11ea-b3de-0242ac130004', 'language_id' => 1, 'amenity' => 'Air Conditioner', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f72990-bed0-11ea-b3de-0242ac130004', 'language_id' => 2, 'amenity' => 'مكيف هواء', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f72ae4-bed0-11ea-b3de-0242ac130004', 'language_id' => 1, 'amenity' => 'Garages', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f72ae4-bed0-11ea-b3de-0242ac130004', 'language_id' => 2, 'amenity' => 'موقف سيارات', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f72bc0-bed0-11ea-b3de-0242ac130004', 'language_id' => 1, 'amenity' => 'Bathrooms', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f72bc0-bed0-11ea-b3de-0242ac130004', 'language_id' => 2, 'amenity' => 'حمامات', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f72c9c-bed0-11ea-b3de-0242ac130004', 'language_id' => 1, 'amenity' => 'Nanny Room', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f72c9c-bed0-11ea-b3de-0242ac130004', 'language_id' => 2, 'amenity' => 'غرفة مربية', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f72d64-bed0-11ea-b3de-0242ac130004', 'language_id' => 1, 'amenity' => 'Garden View', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f72d64-bed0-11ea-b3de-0242ac130004', 'language_id' => 2, 'amenity' => 'إطلالة على حديقة', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f72f3a-bed0-11ea-b3de-0242ac130004', 'language_id' => 1, 'amenity' => 'Balcony', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f72f3a-bed0-11ea-b3de-0242ac130004', 'language_id' => 2, 'amenity' => 'شرفة', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f73020-bed0-11ea-b3de-0242ac130004', 'language_id' => 1, 'amenity' => 'Shared Spa', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f73020-bed0-11ea-b3de-0242ac130004', 'language_id' => 2, 'amenity' => 'منتجع صحي مشترك', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f730e8-bed0-11ea-b3de-0242ac130004', 'language_id' => 1, 'amenity' => 'Shared Gym', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f730e8-bed0-11ea-b3de-0242ac130004', 'language_id' => 2, 'amenity' => 'صالة رياضية مشتركة', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f731ba-bed0-11ea-b3de-0242ac130004', 'language_id' => 1, 'amenity' => 'Water View', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f731ba-bed0-11ea-b3de-0242ac130004', 'language_id' => 2, 'amenity' => 'إطلالة على مياه', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f73282-bed0-11ea-b3de-0242ac130004', 'language_id' => 1, 'amenity' => 'Security', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f73282-bed0-11ea-b3de-0242ac130004', 'language_id' => 2, 'amenity' => 'امان', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f73728-bed0-11ea-b3de-0242ac130004', 'language_id' => 1, 'amenity' => 'Children\'s Play Area', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f73728-bed0-11ea-b3de-0242ac130004', 'language_id' => 2, 'amenity' => 'منطقه لعب للاطفال', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f73872-bed0-11ea-b3de-0242ac130004', 'language_id' => 1, 'amenity' => 'Landmark View', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f73872-bed0-11ea-b3de-0242ac130004', 'language_id' => 2, 'amenity' => 'إطلالة على معالم', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f73944-bed0-11ea-b3de-0242ac130004', 'language_id' => 1, 'amenity' => 'Private Garden', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f73944-bed0-11ea-b3de-0242ac130004', 'language_id' => 2, 'amenity' => 'حديقة خاصة', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f73a0c-bed0-11ea-b3de-0242ac130004', 'language_id' => 1, 'amenity' => 'Children\'s Pool', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f73a0c-bed0-11ea-b3de-0242ac130004', 'language_id' => 2, 'amenity' => 'حمام سباحة للأطفال', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f73aca-bed0-11ea-b3de-0242ac130004', 'language_id' => 1, 'amenity' => 'Concierge', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f73aca-bed0-11ea-b3de-0242ac130004', 'language_id' => 2, 'amenity' => 'خدمات الاستقبال والإرشاد', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f73b92-bed0-11ea-b3de-0242ac130004', 'language_id' => 1, 'amenity' => 'Maid Service', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f73b92-bed0-11ea-b3de-0242ac130004', 'language_id' => 2, 'amenity' => 'خدمة تدبير المنازل', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f73dea-bed0-11ea-b3de-0242ac130004', 'language_id' => 1, 'amenity' => 'Lobby in Building', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f73dea-bed0-11ea-b3de-0242ac130004', 'language_id' => 2, 'amenity' => 'ردهة داخل المبنى', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f73ebc-bed0-11ea-b3de-0242ac130004', 'language_id' => 1, 'amenity' => 'Walk-in Closet', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f73ebc-bed0-11ea-b3de-0242ac130004', 'language_id' => 2, 'amenity' => 'خزانة ملابس', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f73f84-bed0-11ea-b3de-0242ac130004', 'language_id' => 1, 'amenity' => 'Networked', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f73f84-bed0-11ea-b3de-0242ac130004', 'language_id' => 2, 'amenity' => 'يوجد بها شبكة', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f7404c-bed0-11ea-b3de-0242ac130004', 'language_id' => 1, 'amenity' => 'Pets Allowed', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f7404c-bed0-11ea-b3de-0242ac130004', 'language_id' => 2, 'amenity' => 'مسموح بدخول الحيوانات الأليفة', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f7416e-bed0-11ea-b3de-0242ac130004', 'language_id' => 1, 'amenity' => 'Barbecue Area', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f7416e-bed0-11ea-b3de-0242ac130004', 'language_id' => 2, 'amenity' => 'منطقة شواء', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f74272-bed0-11ea-b3de-0242ac130004', 'language_id' => 1, 'amenity' => 'Covered Parking', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f74272-bed0-11ea-b3de-0242ac130004', 'language_id' => 2, 'amenity' => 'مواقف مغطاة للسيارات', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f74344-bed0-11ea-b3de-0242ac130004', 'language_id' => 1, 'amenity' => 'Maids Room', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f74344-bed0-11ea-b3de-0242ac130004', 'language_id' => 2, 'amenity' => 'غرفة للخادمة', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f7456a-bed0-11ea-b3de-0242ac130004', 'language_id' => 1, 'amenity' => 'Study', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f7456a-bed0-11ea-b3de-0242ac130004', 'language_id' => 2, 'amenity' => 'دراسة', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f7463c-bed0-11ea-b3de-0242ac130004', 'language_id' => 1, 'amenity' => 'Private Pool', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f7463c-bed0-11ea-b3de-0242ac130004', 'language_id' => 2, 'amenity' => 'مسبح خاص', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f74704-bed0-11ea-b3de-0242ac130004', 'language_id' => 1, 'amenity' => 'Kitchen Appliances', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f74704-bed0-11ea-b3de-0242ac130004', 'language_id' => 2, 'amenity' => 'أدوات مطبخ', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f747c2-bed0-11ea-b3de-0242ac130004', 'language_id' => 1, 'amenity' => 'Central A/C', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f747c2-bed0-11ea-b3de-0242ac130004', 'language_id' => 2, 'amenity' => 'تكييف مركزي', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f7488a-bed0-11ea-b3de-0242ac130004', 'language_id' => 1, 'amenity' => 'Private Jacuzzi', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f7488a-bed0-11ea-b3de-0242ac130004', 'language_id' => 2, 'amenity' => 'جاكوزي خاص', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f74948-bed0-11ea-b3de-0242ac130004', 'language_id' => 1, 'amenity' => 'Shared Jacuzzi', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f74948-bed0-11ea-b3de-0242ac130004', 'language_id' => 2, 'amenity' => 'جاكوزي مشترك', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f74a06-bed0-11ea-b3de-0242ac130004', 'language_id' => 1, 'amenity' => 'Built-in Wardrobes', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f74a06-bed0-11ea-b3de-0242ac130004', 'language_id' => 2, 'amenity' => 'خزائن ملابس مدمجة', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f74ace-bed0-11ea-b3de-0242ac130004', 'language_id' => 1, 'amenity' => 'Private Spa', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f74ace-bed0-11ea-b3de-0242ac130004', 'language_id' => 2, 'amenity' => 'سبا خاص', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f74cf4-bed0-11ea-b3de-0242ac130004', 'language_id' => 1, 'amenity' => 'Private GYM', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f74cf4-bed0-11ea-b3de-0242ac130004', 'language_id' => 2, 'amenity' => 'صالة رياضية خاصة', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f74dbc-bed0-11ea-b3de-0242ac130004', 'language_id' => 1, 'amenity' => 'Shared Garden', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
            ['i_amenity_id' => 'a0f74dbc-bed0-11ea-b3de-0242ac130004', 'language_id' => 2, 'amenity' => 'حديقة مشتركة', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1],
        ]);
    }
}
