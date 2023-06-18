<?php

namespace Modules\Inventory\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class InventoryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(IPurposesTableSeeder::class);
        $this->call(IPurposeTranslationsTableSeeder::class);
        $this->call(IPurposeTypesTableSeeder::class);
        $this->call(IPurposeTypeTranslationsTableSeeder::class);
        $this->call(IOfferingTypesTableSeeder::class);
        $this->call(IOfferingTypeTranslationsTableSeeder::class);
        $this->call(IFurnishingStatusesTableSeeder::class);
        $this->call(IFurnishingStatusTranslationsTableSeeder::class);
        $this->call(IFinishingTypesTableSeeder::class);
        $this->call(IFinishingTypeTranslationsTableSeeder::class);
        $this->call(IFacilitiesTableSeeder::class);
        $this->call(IFacilityTranslationsTableSeeder::class);
        $this->call(IAmenitiesTableSeeder::class);
        $this->call(IAmenityTranslationsTableSeeder::class);
        $this->call(IBathroomsTableSeeder::class);
        $this->call(IBathroomTranslationsTableSeeder::class);
        $this->call(IBedroomsTableSeeder::class);
        $this->call(IBedroomTranslationsTableSeeder::class);
        $this->call(IFloorNumbersTableSeeder::class);
        $this->call(IFloorNumberTranslationsTableSeeder::class);
        $this->call(IAreaUnitsTableSeeder::class);
        $this->call(IAreaUnitTranslationsTableSeeder::class);
        $this->call(IPaymentMethodsTableSeeder::class);
        $this->call(IPaymentMethodTranslationsTableSeeder::class);
        $this->call(IConfigTableSeeder::class);
        $this->call(ModuleInventorySeederTableSeeder::class);
        $this->call(IDesignTypesTableSeeder::class);
        $this->call(IDesignTypeTranslationsTableSeeder::class);

        $this->call(IPermissionsSeeder::class);
        $this->call(IGroupPermissionsSeeder::class);
        $this->call(IUserPermissionsSeeder::class);
    }
}
