<?php

namespace Modules\Inventory\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class InventoryEventsServiceProvider extends ServiceProvider
{
    protected $listen = [
        // Developer Events
        'i_developer.created' => [
            'Modules\Inventory\Events\IDeveloperEvents@iDeveloperCreated',
        ],
        'i_developer.updated' => [
            'Modules\Inventory\Events\IDeveloperEvents@iDeveloperUpdated',
        ],
        'i_developer.saved' => [
            'Modules\Inventory\Events\IDeveloperEvents@iDeveloperSaved',
        ],
        'i_developer.deleted' => [
            'Modules\Inventory\Events\IDeveloperEvents@iDeveloperDeleted',
        ],
        'i_developer.restored' => [
            'Modules\Inventory\Events\IDeveloperEvents@iDeveloperRestored',
        ],

        // Developer Translation Events
        'i_developer_translation.created' => [
            'Modules\Inventory\Events\IDeveloperTranslationEvents@iDeveloperTranslationCreated',
        ],
        'i_developer_translation.updated' => [
            'Modules\Inventory\Events\IDeveloperTranslationEvents@iDeveloperTranslationUpdated',
        ],
        'i_developer_translation.saved' => [
            'Modules\Inventory\Events\IDeveloperTranslationEvents@iDeveloperTranslationSaved',
        ],
        'i_developer_translation.deleted' => [
            'Modules\Inventory\Events\IDeveloperTranslationEvents@iDeveloperTranslationDeleted',
        ],
        'i_developer_translation.restored' => [
            'Modules\Inventory\Events\IDeveloperTranslationEvents@iDeveloperTranslationRestored',
        ],

        // Area Unit Events
        'i_area_unit.created' => [
            'Modules\Inventory\Events\IAreaUnitEvents@iAreaUnitCreated',
        ],
        'i_area_unit.updated' => [
            'Modules\Inventory\Events\IAreaUnitEvents@iAreaUnitUpdated',
        ],
        'i_area_unit.saved' => [
            'Modules\Inventory\Events\IAreaUnitEvents@iAreaUnitSaved',
        ],
        'i_area_unit.deleted' => [
            'Modules\Inventory\Events\IAreaUnitEvents@iAreaUnitDeleted',
        ],
        'i_area_unit.restored' => [
            'Modules\Inventory\Events\IAreaUnitEvents@iAreaUnitRestored',
        ],

        // Area Unit Translation Events
        'i_area_unit_translation.created' => [
            'Modules\Inventory\Events\IAreaUnitTranslationEvents@iAreaUnitTranslationCreated',
        ],
        'i_area_unit_translation.updated' => [
            'Modules\Inventory\Events\IAreaUnitTranslationEvents@iAreaUnitTranslationUpdated',
        ],
        'i_area_unit_translation.saved' => [
            'Modules\Inventory\Events\IAreaUnitTranslationEvents@iAreaUnitTranslationSaved',
        ],
        'i_area_unit_translation.deleted' => [
            'Modules\Inventory\Events\IAreaUnitTranslationEvents@iAreaUnitTranslationDeleted',
        ],
        'i_area_unit_translation.restored' => [
            'Modules\Inventory\Events\IAreaUnitTranslationEvents@iAreaUnitTranslationRestored',
        ],

        // Bathroom Events
        'i_bathroom.created' => [
            'Modules\Inventory\Events\IBathroomEvents@iBathroomCreated',
        ],
        'i_bathroom.updated' => [
            'Modules\Inventory\Events\IBathroomEvents@iBathroomUpdated',
        ],
        'i_bathroom.saved' => [
            'Modules\Inventory\Events\IBathroomEvents@iBathroomSaved',
        ],
        'i_bathroom.deleted' => [
            'Modules\Inventory\Events\IBathroomEvents@iBathroomDeleted',
        ],
        'i_bathroom.restored' => [
            'Modules\Inventory\Events\IBathroomEvents@iBathroomRestored',
        ],

        // Bathroom Translation Events
        'i_bathroom_translation.created' => [
            'Modules\Inventory\Events\IBathroomTranslationEvents@iBathroomTranslationCreated',
        ],
        'i_bathroom_translation.updated' => [
            'Modules\Inventory\Events\IBathroomTranslationEvents@iBathroomTranslationUpdated',
        ],
        'i_bathroom_translation.saved' => [
            'Modules\Inventory\Events\IBathroomTranslationEvents@iBathroomTranslationSaved',
        ],
        'i_bathroom_translation.deleted' => [
            'Modules\Inventory\Events\IBathroomTranslationEvents@iBathroomTranslationDeleted',
        ],
        'i_bathroom_translation.restored' => [
            'Modules\Inventory\Events\IBathroomTranslationEvents@iBathroomTranslationRestored',
        ],

        // Bedroom Events
        'i_bedroom.created' => [
            'Modules\Inventory\Events\IBedroomEvents@iBedroomCreated',
        ],
        'i_bedroom.updated' => [
            'Modules\Inventory\Events\IBedroomEvents@iBedroomUpdated',
        ],
        'i_bedroom.saved' => [
            'Modules\Inventory\Events\IBedroomEvents@iBedroomSaved',
        ],
        'i_bedroom.deleted' => [
            'Modules\Inventory\Events\IBedroomEvents@iBedroomDeleted',
        ],
        'i_bedroom.restored' => [
            'Modules\Inventory\Events\IBedroomEvents@iBedroomRestored',
        ],

        // Bedroom Translation Events
        'i_bedroom_translation.created' => [
            'Modules\Inventory\Events\IBedroomTranslationEvents@iBedroomTranslationCreated',
        ],
        'i_bedroom_translation.updated' => [
            'Modules\Inventory\Events\IBedroomTranslationEvents@iBedroomTranslationUpdated',
        ],
        'i_bedroom_translation.saved' => [
            'Modules\Inventory\Events\IBedroomTranslationEvents@iBedroomTranslationSaved',
        ],
        'i_bedroom_translation.deleted' => [
            'Modules\Inventory\Events\IBedroomTranslationEvents@iBedroomTranslationDeleted',
        ],
        'i_bedroom_translation.restored' => [
            'Modules\Inventory\Events\IBedroomTranslationEvents@iBedroomTranslationRestored',
        ],

        // Finishing Type Events
        'i_finishing_type.created' => [
            'Modules\Inventory\Events\IFinishingTypeEvents@iFinishingTypeCreated',
        ],
        'i_finishing_type.updated' => [
            'Modules\Inventory\Events\IFinishingTypeEvents@iFinishingTypeUpdated',
        ],
        'i_finishing_type.saved' => [
            'Modules\Inventory\Events\IFinishingTypeEvents@iFinishingTypeSaved',
        ],
        'i_finishing_type.deleted' => [
            'Modules\Inventory\Events\IFinishingTypeEvents@iFinishingTypeDeleted',
        ],
        'i_finishing_type.restored' => [
            'Modules\Inventory\Events\IFinishingTypeEvents@iFinishingTypeRestored',
        ],

        // Finishing Type Translation Events
        'i_finishing_type_translation.created' => [
            'Modules\Inventory\Events\IFinishingTypeTranslationEvents@iFinishingTypeTranslationCreated',
        ],
        'i_finishing_type_translation.updated' => [
            'Modules\Inventory\Events\IFinishingTypeTranslationEvents@iFinishingTypeTranslationUpdated',
        ],
        'i_finishing_type_translation.saved' => [
            'Modules\Inventory\Events\IFinishingTypeTranslationEvents@iFinishingTypeTranslationSaved',
        ],
        'i_finishing_type_translation.deleted' => [
            'Modules\Inventory\Events\IFinishingTypeTranslationEvents@iFinishingTypeTranslationDeleted',
        ],
        'i_finishing_type_translation.restored' => [
            'Modules\Inventory\Events\IFinishingTypeTranslationEvents@iFinishingTypeTranslationRestored',
        ],

        // Furnishing Status Events
        'i_furnishing_status.created' => [
            'Modules\Inventory\Events\IFurnishingStatusEvents@iFurnishingStatusCreated',
        ],
        'i_furnishing_status.updated' => [
            'Modules\Inventory\Events\IFurnishingStatusEvents@iFurnishingStatusUpdated',
        ],
        'i_furnishing_status.saved' => [
            'Modules\Inventory\Events\IFurnishingStatusEvents@iFurnishingStatusSaved',
        ],
        'i_furnishing_status.deleted' => [
            'Modules\Inventory\Events\IFurnishingStatusEvents@iFurnishingStatusDeleted',
        ],
        'i_furnishing_status.restored' => [
            'Modules\Inventory\Events\IFurnishingStatusEvents@iFurnishingStatusRestored',
        ],

        // Furnishing Status Translation Events
        'i_furnishing_status_translation.created' => [
            'Modules\Inventory\Events\IFurnishingStatusTranslationEvents@iFurnishingStatusTranslationCreated',
        ],
        'i_furnishing_status_translation.updated' => [
            'Modules\Inventory\Events\IFurnishingStatusTranslationEvents@iFurnishingStatusTranslationUpdated',
        ],
        'i_furnishing_status_translation.saved' => [
            'Modules\Inventory\Events\IFurnishingStatusTranslationEvents@iFurnishingStatusTranslationSaved',
        ],
        'i_furnishing_status_translation.deleted' => [
            'Modules\Inventory\Events\IFurnishingStatusTranslationEvents@iFurnishingStatusTranslationDeleted',
        ],
        'i_furnishing_status_translation.restored' => [
            'Modules\Inventory\Events\IFurnishingStatusTranslationEvents@iFurnishingStatusTranslationRestored',
        ],

        // Offering Type Events
        'i_offering_type.created' => [
            'Modules\Inventory\Events\IOfferingTypeEvents@iOfferingTypeCreated',
        ],
        'i_offering_type.updated' => [
            'Modules\Inventory\Events\IOfferingTypeEvents@iOfferingTypeUpdated',
        ],
        'i_offering_type.saved' => [
            'Modules\Inventory\Events\IOfferingTypeEvents@iOfferingTypeSaved',
        ],
        'i_offering_type.deleted' => [
            'Modules\Inventory\Events\IOfferingTypeEvents@iOfferingTypeDeleted',
        ],
        'i_offering_type.restored' => [
            'Modules\Inventory\Events\IOfferingTypeEvents@iOfferingTypeRestored',
        ],

        // Offering Type Translation Events
        'i_offering_type_translation.created' => [
            'Modules\Inventory\Events\IOfferingTypeTranslationEvents@iOfferingTypeTranslationCreated',
        ],
        'i_offering_type_translation.updated' => [
            'Modules\Inventory\Events\IOfferingTypeTranslationEvents@iOfferingTypeTranslationUpdated',
        ],
        'i_offering_type_translation.saved' => [
            'Modules\Inventory\Events\IOfferingTypeTranslationEvents@iOfferingTypeTranslationSaved',
        ],
        'i_offering_type_translation.deleted' => [
            'Modules\Inventory\Events\IOfferingTypeTranslationEvents@iOfferingTypeTranslationDeleted',
        ],
        'i_offering_type_translation.restored' => [
            'Modules\Inventory\Events\IOfferingTypeTranslationEvents@iOfferingTypeTranslationRestored',
        ],

        // Payment Method Events
        'i_payment_method.created' => [
            'Modules\Inventory\Events\IPaymentMethodEvents@iPaymentMethodCreated',
        ],
        'i_payment_method.updated' => [
            'Modules\Inventory\Events\IPaymentMethodEvents@iPaymentMethodUpdated',
        ],
        'i_payment_method.saved' => [
            'Modules\Inventory\Events\IPaymentMethodEvents@iPaymentMethodSaved',
        ],
        'i_payment_method.deleted' => [
            'Modules\Inventory\Events\IPaymentMethodEvents@iPaymentMethodDeleted',
        ],
        'i_payment_method.restored' => [
            'Modules\Inventory\Events\IPaymentMethodEvents@iPaymentMethodRestored',
        ],

        // Payment Method Translation Events
        'i_payment_method_translation.created' => [
            'Modules\Inventory\Events\IPaymentMethodTranslationEvents@iPaymentMethodTranslationCreated',
        ],
        'i_payment_method_translation.updated' => [
            'Modules\Inventory\Events\IPaymentMethodTranslationEvents@iPaymentMethodTranslationUpdated',
        ],
        'i_payment_method_translation.saved' => [
            'Modules\Inventory\Events\IPaymentMethodTranslationEvents@iPaymentMethodTranslationSaved',
        ],
        'i_payment_method_translation.deleted' => [
            'Modules\Inventory\Events\IPaymentMethodTranslationEvents@iPaymentMethodTranslationDeleted',
        ],
        'i_payment_method_translation.restored' => [
            'Modules\Inventory\Events\IPaymentMethodTranslationEvents@iPaymentMethodTranslationRestored',
        ],

        // Position Events
        'i_position.created' => [
            'Modules\Inventory\Events\IPositionEvents@iPositionCreated',
        ],
        'i_position.updated' => [
            'Modules\Inventory\Events\IPositionEvents@iPositionUpdated',
        ],
        'i_position.saved' => [
            'Modules\Inventory\Events\IPositionEvents@iPositionSaved',
        ],
        'i_position.deleted' => [
            'Modules\Inventory\Events\IPositionEvents@iPositionDeleted',
        ],
        'i_position.restored' => [
            'Modules\Inventory\Events\IPositionEvents@iPositionRestored',
        ],

        // Position Translation Events
        'i_position_translation.created' => [
            'Modules\Inventory\Events\IPositionTranslationEvents@iPositionTranslationCreated',
        ],
        'i_position_translation.updated' => [
            'Modules\Inventory\Events\IPositionTranslationEvents@iPositionTranslationUpdated',
        ],
        'i_position_translation.saved' => [
            'Modules\Inventory\Events\IPositionTranslationEvents@iPositionTranslationSaved',
        ],
        'i_position_translation.deleted' => [
            'Modules\Inventory\Events\IPositionTranslationEvents@iPositionTranslationDeleted',
        ],
        'i_position_translation.restored' => [
            'Modules\Inventory\Events\IPositionTranslationEvents@iPositionTranslationRestored',
        ],

        // View Events
        'i_view.created' => [
            'Modules\Inventory\Events\IViewEvents@iViewCreated',
        ],
        'i_view.updated' => [
            'Modules\Inventory\Events\IViewEvents@iViewUpdated',
        ],
        'i_view.saved' => [
            'Modules\Inventory\Events\IViewEvents@iViewSaved',
        ],
        'i_view.deleted' => [
            'Modules\Inventory\Events\IViewEvents@iViewDeleted',
        ],
        'i_view.restored' => [
            'Modules\Inventory\Events\IViewEvents@iViewRestored',
        ],

        // View Translation Events
        'i_view_translation.created' => [
            'Modules\Inventory\Events\IViewTranslationEvents@iViewTranslationCreated',
        ],
        'i_view_translation.updated' => [
            'Modules\Inventory\Events\IViewTranslationEvents@iViewTranslationUpdated',
        ],
        'i_view_translation.saved' => [
            'Modules\Inventory\Events\IViewTranslationEvents@iViewTranslationSaved',
        ],
        'i_view_translation.deleted' => [
            'Modules\Inventory\Events\IViewTranslationEvents@iViewTranslationDeleted',
        ],
        'i_view_translation.restored' => [
            'Modules\Inventory\Events\IViewTranslationEvents@iViewTranslationRestored',
        ],

        // Facility Events
        'i_facility.created' => [
            'Modules\Inventory\Events\IFacilityEvents@iFacilityCreated',
        ],
        'i_facility.updated' => [
            'Modules\Inventory\Events\IFacilityEvents@iFacilityUpdated',
        ],
        'i_facility.saved' => [
            'Modules\Inventory\Events\IFacilityEvents@iFacilitySaved',
        ],
        'i_facility.deleted' => [
            'Modules\Inventory\Events\IFacilityEvents@iFacilityDeleted',
        ],
        'i_facility.restored' => [
            'Modules\Inventory\Events\IFacilityEvents@iFacilityRestored',
        ],

        // Facility Translation Events
        'i_facility_translation.created' => [
            'Modules\Inventory\Events\IFacilityTranslationEvents@iFacilityTranslationCreated',
        ],
        'i_facility_translation.updated' => [
            'Modules\Inventory\Events\IFacilityTranslationEvents@iFacilityTranslationUpdated',
        ],
        'i_facility_translation.saved' => [
            'Modules\Inventory\Events\IFacilityTranslationEvents@iFacilityTranslationSaved',
        ],
        'i_facility_translation.deleted' => [
            'Modules\Inventory\Events\IFacilityTranslationEvents@iFacilityTranslationDeleted',
        ],
        'i_facility_translation.restored' => [
            'Modules\Inventory\Events\IFacilityTranslationEvents@iFacilityTranslationRestored',
        ],

        // Amenity Events
        'i_amenity.created' => [
            'Modules\Inventory\Events\IAmenityEvents@iAmenityCreated',
        ],
        'i_amenity.updated' => [
            'Modules\Inventory\Events\IAmenityEvents@iAmenityUpdated',
        ],
        'i_amenity.saved' => [
            'Modules\Inventory\Events\IAmenityEvents@iAmenitySaved',
        ],
        'i_amenity.deleted' => [
            'Modules\Inventory\Events\IAmenityEvents@iAmenityDeleted',
        ],
        'i_amenity.restored' => [
            'Modules\Inventory\Events\IAmenityEvents@iAmenityRestored',
        ],

        // Amenity Translation Events
        'i_amenity_translation.created' => [
            'Modules\Inventory\Events\IAmenityTranslationEvents@iAmenityTranslationCreated',
        ],
        'i_amenity_translation.updated' => [
            'Modules\Inventory\Events\IAmenityTranslationEvents@iAmenityTranslationUpdated',
        ],
        'i_amenity_translation.saved' => [
            'Modules\Inventory\Events\IAmenityTranslationEvents@iAmenityTranslationSaved',
        ],
        'i_amenity_translation.deleted' => [
            'Modules\Inventory\Events\IAmenityTranslationEvents@iAmenityTranslationDeleted',
        ],
        'i_amenity_translation.restored' => [
            'Modules\Inventory\Events\IAmenityTranslationEvents@iAmenityTranslationRestored',
        ],

        // Purpose Events
        'i_purpose.created' => [
            'Modules\Inventory\Events\IPurposeEvents@iPurposeCreated',
        ],
        'i_purpose.updated' => [
            'Modules\Inventory\Events\IPurposeEvents@iPurposeUpdated',
        ],
        'i_purpose.saved' => [
            'Modules\Inventory\Events\IPurposeEvents@iPurposeSaved',
        ],
        'i_purpose.deleted' => [
            'Modules\Inventory\Events\IPurposeEvents@iPurposeDeleted',
        ],
        'i_purpose.restored' => [
            'Modules\Inventory\Events\IPurposeEvents@iPurposeRestored',
        ],

        // Purpose Translation Events
        'i_purpose_translation.created' => [
            'Modules\Inventory\Events\IPurposeTranslationEvents@iPurposeTranslationCreated',
        ],
        'i_purpose_translation.updated' => [
            'Modules\Inventory\Events\IPurposeTranslationEvents@iPurposeTranslationUpdated',
        ],
        'i_purpose_translation.saved' => [
            'Modules\Inventory\Events\IPurposeTranslationEvents@iPurposeTranslationSaved',
        ],
        'i_purpose_translation.deleted' => [
            'Modules\Inventory\Events\IPurposeTranslationEvents@iPurposeTranslationDeleted',
        ],
        'i_purpose_translation.restored' => [
            'Modules\Inventory\Events\IPurposeTranslationEvents@iPurposeTranslationRestored',
        ],

        // Purpose Type Events
        'i_purpose_type.created' => [
            'Modules\Inventory\Events\IPurposeTypeEvents@iPurposeTypeCreated',
        ],
        'i_purpose_type.updated' => [
            'Modules\Inventory\Events\IPurposeTypeEvents@iPurposeTypeUpdated',
        ],
        'i_purpose_type.saved' => [
            'Modules\Inventory\Events\IPurposeTypeEvents@iPurposeTypeSaved',
        ],
        'i_purpose_type.deleted' => [
            'Modules\Inventory\Events\IPurposeTypeEvents@iPurposeTypeDeleted',
        ],
        'i_purpose_type.restored' => [
            'Modules\Inventory\Events\IPurposeTypeEvents@iPurposeTypeRestored',
        ],

        // Purpose Type Translation Events
        'i_purpose_type_translation.created' => [
            'Modules\Inventory\Events\IPurposeTypeTranslationEvents@iPurposeTypeTranslationCreated',
        ],
        'i_purpose_type_translation.updated' => [
            'Modules\Inventory\Events\IPurposeTypeTranslationEvents@iPurposeTypeTranslationUpdated',
        ],
        'i_purpose_type_translation.saved' => [
            'Modules\Inventory\Events\IPurposeTypeTranslationEvents@iPurposeTypeTranslationSaved',
        ],
        'i_purpose_type_translation.deleted' => [
            'Modules\Inventory\Events\IPurposeTypeTranslationEvents@iPurposeTypeTranslationDeleted',
        ],
        'i_purpose_type_translation.restored' => [
            'Modules\Inventory\Events\IPurposeTypeTranslationEvents@iPurposeTypeTranslationRestored',
        ],

        // Project Events
        'i_project.created' => [
            'Modules\Inventory\Events\IProjectEvents@iProjectCreated',
        ],
        'i_project.updated' => [
            'Modules\Inventory\Events\IProjectEvents@iProjectUpdated',
        ],
        'i_project.saved' => [
            'Modules\Inventory\Events\IProjectEvents@iProjectSaved',
        ],
        'i_project.deleted' => [
            'Modules\Inventory\Events\IProjectEvents@iProjectDeleted',
        ],
        'i_project.restored' => [
            'Modules\Inventory\Events\IProjectEvents@iProjectRestored',
        ],

        // Project Translation Events
        'i_project_translation.created' => [
            'Modules\Inventory\Events\IProjectTranslationEvents@iProjectTranslationCreated',
        ],
        'i_project_translation.updated' => [
            'Modules\Inventory\Events\IProjectTranslationEvents@iProjectTranslationUpdated',
        ],
        'i_project_translation.saved' => [
            'Modules\Inventory\Events\IProjectTranslationEvents@iProjectTranslationSaved',
        ],
        'i_project_translation.deleted' => [
            'Modules\Inventory\Events\IProjectTranslationEvents@iProjectTranslationDeleted',
        ],
        'i_project_translation.restored' => [
            'Modules\Inventory\Events\IProjectTranslationEvents@iProjectTranslationRestored',
        ],

        // Unit Events
        'i_unit.created' => [
            'Modules\Inventory\Events\IUnitEvents@iUnitCreated',
        ],
        'i_unit.updated' => [
            'Modules\Inventory\Events\IUnitEvents@iUnitUpdated',
        ],
        'i_unit.saved' => [
            'Modules\Inventory\Events\IUnitEvents@iUnitSaved',
        ],
        'i_unit.deleted' => [
            'Modules\Inventory\Events\IUnitEvents@iUnitDeleted',
        ],
        'i_unit.restored' => [
            'Modules\Inventory\Events\IUnitEvents@iUnitRestored',
        ],

        // Floor Number Events
        'i_floor_number.created' => [
            'Modules\Inventory\Events\IFloorNumberEvents@iFloorNumberCreated',
        ],
        'i_floor_number.updated' => [
            'Modules\Inventory\Events\IFloorNumberEvents@iFloorNumberUpdated',
        ],
        'i_floor_number.saved' => [
            'Modules\Inventory\Events\IFloorNumberEvents@iFloorNumberSaved',
        ],
        'i_floor_number.deleted' => [
            'Modules\Inventory\Events\IFloorNumberEvents@iFloorNumberDeleted',
        ],
        'i_floor_number.restored' => [
            'Modules\Inventory\Events\IFloorNumberEvents@iFloorNumberRestored',
        ],

        // Floor Number Translation Events
        'i_floor_number_translation.created' => [
            'Modules\Inventory\Events\IFloorNumberTranslationEvents@iFloorNumberTranslationCreated',
        ],
        'i_floor_number_translation.updated' => [
            'Modules\Inventory\Events\IFloorNumberTranslationEvents@iFloorNumberTranslationUpdated',
        ],
        'i_floor_number_translation.saved' => [
            'Modules\Inventory\Events\IFloorNumberTranslationEvents@iFloorNumberTranslationSaved',
        ],
        'i_floor_number_translation.deleted' => [
            'Modules\Inventory\Events\IFloorNumberTranslationEvents@iFloorNumberTranslationDeleted',
        ],
        'i_floor_number_translation.restored' => [
            'Modules\Inventory\Events\IFloorNumberTranslationEvents@iFloorNumberTranslationRestored',
        ],

        // Design Type Events
        'i_design_type.created' => [
            'Modules\Inventory\Events\IDesignTypeEvents@IDesignTypeCreated',
        ],
        'i_design_type.updated' => [
            'Modules\Inventory\Events\IDesignTypeEvents@IDesignTypeUpdated',
        ],
        'i_design_type.saved' => [
            'Modules\Inventory\Events\IDesignTypeEvents@IDesignTypeSaved',
        ],
        'i_design_type.deleted' => [
            'Modules\Inventory\Events\IDesignTypeEvents@IDesignTypeDeleted',
        ],
        'i_design_type.restored' => [
            'Modules\Inventory\Events\IDesignTypeEvents@IDesignTypeRestored',
        ],

        // Design Type Translation Events
        'i_design_type_translation.created' => [
            'Modules\Inventory\Events\IDesignTypeTranslationEvents@iDesignTypeTranslationCreated',
        ],
        'i_design_type_translation.updated' => [
            'Modules\Inventory\Events\IDesignTypeTranslationEvents@iDesignTypeTranslationUpdated',
        ],
        'i_design_type_translation.saved' => [
            'Modules\Inventory\Events\IDesignTypeTranslationEvents@iDesignTypeTranslationSaved',
        ],
        'i_design_type_translation.deleted' => [
            'Modules\Inventory\Events\IDesignTypeTranslationEvents@iDesignTypeTranslationDeleted',
        ],
        'i_design_type_translation.restored' => [
            'Modules\Inventory\Events\IDesignTypeTranslationEvents@iDesignTypeTranslationRestored',
        ],

        // Phase Events
        'i_phase.created' => [
            'Modules\Inventory\Events\IPhaseEvents@iPhaseCreated',
        ],
        'i_phase.updated' => [
            'Modules\Inventory\Events\IPhaseEvents@iPhaseUpdated',
        ],
        'i_phase.saved' => [
            'Modules\Inventory\Events\IPhaseEvents@iPhaseSaved',
        ],
        'i_phase.deleted' => [
            'Modules\Inventory\Events\IPhaseEvents@iPhaseDeleted',
        ],
        'i_phase.restored' => [
            'Modules\Inventory\Events\IPhaseEvents@iPhaseRestored',
        ],

        // Phase Translation Events
        'i_phase_translation.created' => [
            'Modules\Inventory\Events\IPhaseTranslationEvents@iPhaseTranslationCreated',
        ],
        'i_phase_translation.updated' => [
            'Modules\Inventory\Events\IPhaseTranslationEvents@iPhaseTranslationUpdated',
        ],
        'i_phase_translation.saved' => [
            'Modules\Inventory\Events\IPhaseTranslationEvents@iPhaseTranslationSaved',
        ],
        'i_phase_translation.deleted' => [
            'Modules\Inventory\Events\IPhaseTranslationEvents@iPhaseTranslationDeleted',
        ],
        'i_phase_translation.restored' => [
            'Modules\Inventory\Events\IPhaseTranslationEvents@iPhaseTranslationRestored',
        ],

        // Publish Time Events
        'i_publish_time.created' => [
            'Modules\Inventory\Events\IPublishTimeEvents@iPublishTimeCreated',
        ],
        'i_publish_time.updated' => [
            'Modules\Inventory\Events\IPublishTimeEvents@iPublishTimeUpdated',
        ],
        'i_publish_time.saved' => [
            'Modules\Inventory\Events\IPublishTimeEvents@iPublishTimeSaved',
        ],
        'i_publish_time.deleted' => [
            'Modules\Inventory\Events\IPublishTimeEvents@iPublishTimeDeleted',
        ],
        'i_publish_time.restored' => [
            'Modules\Inventory\Events\IPublishTimeEvents@iPublishTimeRestored',
        ],

        // Rental Case Events
        'i_rental_case.created' => [
            'Modules\Inventory\Events\IRentalCaseEvents@iRentalCaseCreated',
        ],
        'i_rental_case.updated' => [
            'Modules\Inventory\Events\IRentalCaseEvents@iRentalCaseUpdated',
        ],
        'i_rental_case.saved' => [
            'Modules\Inventory\Events\IRentalCaseEvents@iRentalCaseSaved',
        ],
        'i_rental_case.deleted' => [
            'Modules\Inventory\Events\IRentalCaseEvents@iRentalCaseDeleted',
        ],
        'i_rental_case.restored' => [
            'Modules\Inventory\Events\IRentalCaseEvents@iRentalCaseRestored',
        ],

        // Unit Events
        'i_unit.created' => [
            'Modules\Inventory\Events\IUnitEvents@iUnitCreated',
        ],
        'i_unit.updated' => [
            'Modules\Inventory\Events\IUnitEvents@iUnitUpdated',
        ],
        'i_unit.saved' => [
            'Modules\Inventory\Events\IUnitEvents@iUnitSaved',
        ],
        'i_unit.deleted' => [
            'Modules\Inventory\Events\IUnitEvents@iUnitDeleted',
        ],
        'i_unit.restored' => [
            'Modules\Inventory\Events\IUnitEvents@iUnitRestored',
        ],

        // Unit Translation Events
        'i_unit_translation.created' => [
            'Modules\Inventory\Events\IUnitTranslationEvents@iUnitTranslationCreated',
        ],
        'i_unit_translation.updated' => [
            'Modules\Inventory\Events\IUnitTranslationEvents@iUnitTranslationUpdated',
        ],
        'i_unit_translation.saved' => [
            'Modules\Inventory\Events\IUnitTranslationEvents@iUnitTranslationSaved',
        ],
        'i_unit_translation.deleted' => [
            'Modules\Inventory\Events\IUnitTranslationEvents@iUnitTranslationDeleted',
        ],
        'i_unit_translation.restored' => [
            'Modules\Inventory\Events\IUnitTranslationEvents@iUnitTranslationRestored',
        ],

        // Sell Request Events
        'i_sell_request.created' => [
            'Modules\Inventory\Events\ISellRequestEvents@iSellRequestCreated',
        ],
        'i_sell_request.updated' => [
            'Modules\Inventory\Events\ISellRequestEvents@iSellRequestUpdated',
        ],
        'i_sell_request.saved' => [
            'Modules\Inventory\Events\ISellRequestEvents@iSellRequestSaved',
        ],
        'i_sell_request.deleted' => [
            'Modules\Inventory\Events\ISellRequestEvents@iSellRequestDeleted',
        ],
        'i_sell_request.restored' => [
            'Modules\Inventory\Events\ISellRequestEvents@iSellRequestRestored',
        ],

        // Unit Image Events
        'i_unit_image.created' => [
            'Modules\Inventory\Events\IUnitImageEvents@iUnitImageCreated',
        ],
        'i_unit_image.updated' => [
            'Modules\Inventory\Events\IUnitImageEvents@iUnitImageUpdated',
        ],
        'i_unit_image.saved' => [
            'Modules\Inventory\Events\IUnitImageEvents@iUnitImageSaved',
        ],
        'i_unit_image.deleted' => [
            'Modules\Inventory\Events\IUnitImageEvents@iUnitImageDeleted',
        ],
        'i_unit_image.restored' => [
            'Modules\Inventory\Events\IUnitImageEvents@iUnitImageRestored',
        ],

        // Unit Image Translation Events
        'i_unit_image_translation.created' => [
            'Modules\Inventory\Events\IUnitImageTranslationEvents@iUnitImageTranslationCreated',
        ],
        'i_unit_image_translation.updated' => [
            'Modules\Inventory\Events\IUnitImageTranslationEvents@iUnitImageTranslationUpdated',
        ],
        'i_unit_image_translation.saved' => [
            'Modules\Inventory\Events\IUnitImageTranslationEvents@iUnitImageTranslationSaved',
        ],
        'i_unit_image_translation.deleted' => [
            'Modules\Inventory\Events\IUnitImageTranslationEvents@iUnitImageTranslationDeleted',
        ],
        'i_unit_image_translation.restored' => [
            'Modules\Inventory\Events\IUnitImageTranslationEvents@iUnitImageTranslationRestored',
        ],
        // Unit Type Events
        'i_unit_type.created' => [
            'Modules\Inventory\Events\IUnitTypeEvents@iUnitTypeCreated',
        ],
        'i_unit_type.updated' => [
            'Modules\Inventory\Events\IUnitTypeEvents@iUnitTypeUpdated',
        ],
        'i_unit_type.saved' => [
            'Modules\Inventory\Events\IUnitTypeEvents@iUnitTypeSaved',
        ],
        'i_unit_type.deleted' => [
            'Modules\Inventory\Events\IUnitTypeEvents@iUnitTypeDeleted',
        ],
        'i_unit_type.restored' => [
            'Modules\Inventory\Events\IUnitTypeEvents@iUnitTypeRestored',
        ],

        // Unit Type Translation Events
        'i_unit_type_translation.created' => [
            'Modules\Inventory\Events\IUnitTypeTranslationEvents@iUnitTypeTranslationCreated',
        ],
        'i_unit_type_translation.updated' => [
            'Modules\Inventory\Events\IUnitTypeTranslationEvents@iUnitTypeTranslationUpdated',
        ],
        'i_unit_type_translation.saved' => [
            'Modules\Inventory\Events\IUnitTypeTranslationEvents@iUnitTypeTranslationSaved',
        ],
        'i_unit_type_translation.deleted' => [
            'Modules\Inventory\Events\IUnitTypeTranslationEvents@iUnitTypeTranslationDeleted',
        ],
        'i_unit_type_translation.restored' => [
            'Modules\Inventory\Events\IUnitTypeTranslationEvents@iUnitTypeTranslationRestored',
        ],


    ];
}
