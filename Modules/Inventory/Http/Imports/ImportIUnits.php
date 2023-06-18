<?php

namespace Modules\Inventory\Http\Imports;

use App\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Modules\Attachments\Http\Controllers\Actions\StoreAttachmentAction;
use Modules\Inventory\Http\Controllers\Actions\Amenities\CreateIAmenityAction;
use Modules\Inventory\Http\Controllers\Actions\AreaUnits\CreateIAreaUnitAction;
use Modules\Inventory\Http\Controllers\Actions\Bathrooms\CreateIBathroomAction;
use Modules\Inventory\Http\Controllers\Actions\Bedrooms\CreateIBedroomAction;
use Modules\Inventory\Http\Controllers\Actions\DesignTypes\CreateIDesignTypeAction;
use Modules\Inventory\Http\Controllers\Actions\Facilities\CreateIFacilityAction;
use Modules\Inventory\Http\Controllers\Actions\FinishingTypes\CreateIFinishingTypeAction;
use Modules\Inventory\Http\Controllers\Actions\FloorNumbers\CreateIFloorNumberAction;
use Modules\Inventory\Http\Controllers\Actions\FurnishingStatuses\CreateIFurnishingStatusAction;
use Modules\Inventory\Http\Controllers\Actions\OfferingTypes\CreateIOfferingTypeAction;
use Modules\Inventory\Http\Controllers\Actions\PaymentMethods\CreateIPaymentMethodAction;
use Modules\Inventory\Http\Controllers\Actions\Positions\CreateIPositionAction;
use Modules\Inventory\Http\Controllers\Actions\Projects\CreateIProjectAction;
use Modules\Inventory\Http\Controllers\Actions\Purposes\CreateIPurposeAction;
use Modules\Inventory\Http\Controllers\Actions\PurposeTypes\CreateIPurposeTypeAction;
use Modules\Inventory\Http\Controllers\Actions\Units\CreateIUnitAction;
use Modules\Inventory\Http\Controllers\Actions\Views\CreateIViewAction;
use Modules\Inventory\IAmenity;
use Modules\Inventory\IAreaUnit;
use Modules\Inventory\IBathroom;
use Modules\Inventory\IBedroom;
use Modules\Inventory\IDesignType;
use Modules\Inventory\IFacility;
use Modules\Inventory\IFinishingType;
use Modules\Inventory\IFloorNumber;
use Modules\Inventory\IFurnishingStatus;
use Modules\Inventory\IOfferingType;
use Modules\Inventory\IPaymentMethod;
use Modules\Inventory\IPosition;
use Modules\Inventory\IProject;
use Modules\Inventory\IPurpose;
use Modules\Inventory\IPurposeType;
use Modules\Inventory\IUnit;
use Modules\Inventory\IView;
use Modules\Locations\Http\Controllers\Actions\CreateLocationAction;
use Modules\Locations\Location;
use Modules\Tags\Http\Controllers\Actions\CreateTagAction;
use Modules\Tags\Tag;
use Illuminate\Validation\Rule;
use Modules\Inventory\Http\Controllers\Actions\Developers\CreateIDeveloperAction;
use Modules\Inventory\Http\Controllers\Actions\Units\DeleteIUnitAction;
use Modules\Inventory\Http\Controllers\Actions\Units\UpdateIUnitAction;
use Modules\Inventory\IDeveloper;

class ImportIUnits implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {
        $array_not_to_delete = array();
        $validate_headers = $this->validateHeaders($collection->first()->toArray());

        if (!count($validate_headers)) {
            $is_valid = false;
            $unit_data = array();
            $counter = 0;
            foreach ($collection as $row) {
                $counter += 1;
                $validated = $this->validated($row->toArray());
                if (!$validated->fails()) {
                    $unit_data['unit_number'] = $row['unit_number'];

                    // Seller
                    $seller = User::Where('email', $row['seller'])->first();
                    if ($seller) {
                        $unit_data['seller_id'] = $seller->id;
                        $is_valid = true;
                    } else {
                        continue; // Skip record if seller not found
                    }

                    // Offering Type
                    $offering_type = IOfferingType::whereHas('translations', function ($translations) use ($row) {
                        $translations->where('offering_type', $row['offering_type']);
                    })->first();
                    if ($offering_type) {
                        $unit_data['i_offering_type_id'] = $offering_type->id;
                    } else {
                        // Create I offering_type
                        $offering_type_data['translations'][0]['language_id'] = 2;
                        $offering_type_data['translations'][0]['offering_type'] = $row['offering_type'];
                        $offering_type_data['order'] = 0;

                        $action = new CreateIOfferingTypeAction;
                        $offering_type = $action->execute($offering_type_data);
                        $unit_data['i_offering_type_id'] = $offering_type->id;
                    }

                    // Design Type
                    // if (isset($row['design_type']) && !is_null($row['design_type'])) {
                    //     $validate = Validator::make(['design_type' => $row['design_type']], [
                    //         'design_type' => 'required|string|max:191',
                    //     ]);
                    //     if (!$validate->fails()) {
                    //         $design_type = IDesignType::whereHas('translations', function ($translations) use ($row) {
                    //             $translations->where('type', $row['design_type']);
                    //         })->first();
                    //         if ($design_type) {
                    //             $unit_data['i_design_type_id'] = $design_type->id;
                    //         } else {
                    //             // Create I design_type
                    //             $design_type_data['translations'][0]['language_id'] = 2;
                    //             $design_type_data['translations'][0]['type'] = $row['design_type'];
                    //             $design_type_data['order'] = 0;

                    //             $action = new CreateIDesignTypeAction;
                    //             $design_type = $action->execute($design_type_data);
                    //             $unit_data['i_design_type_id'] = $design_type->id;
                    //         }
                    //     }
                    // }

                    // Postion
                    // if (isset($row['position']) && !is_null($row['position'])) {
                    //     $validate = Validator::make(['position' => $row['position']], [
                    //         'position' => 'required|string|max:191',
                    //     ]);
                    //     if (!$validate->fails()) {
                    //         $position = IPosition::whereHas('translations', function ($translations) use ($row) {
                    //             $translations->where('position', $row['position']);
                    //         })->first();
                    //         if ($position) {
                    //             $unit_data['i_position_id'] = $position->id;
                    //         } else {
                    //             // Create I Position
                    //             $position_data['translations'][0]['language_id'] = 2;
                    //             $position_data['translations'][0]['position'] = $row['position'];
                    //             $position_data['order'] = 0;

                    //             $action = new CreateIPositionAction;
                    //             $position = $action->execute($position_data);
                    //             $unit_data['i_position_id'] = $position->id;
                    //         }
                    //     }
                    // }

                    // Project
                    if (isset($row['project']) && !is_null($row['project'])) {
                        $validate = Validator::make(['project' => $row['project']], [
                            'project' => 'required|string|max:191',
                        ]);
                        if (!$validate->fails()) {
                            $project = IProject::whereHas('translations', function ($translations) use ($row) {
                                $translations->where('project', $row['project']);
                            })->first();

                            $developer_id = null;
                            if (isset($row['developer']) && !is_null($row['developer'])) {
                                $validate = Validator::make(['developer' => $row['developer']], [
                                    'developer' => 'required|string|max:191',
                                ]);
                                if (!$validate->fails()) {
                                    $developer = IDeveloper::whereHas('translations', function ($translations) use ($row) {
                                        $translations->where('developer', $row['developer']);
                                    })->first();
                                    if ($developer) {
                                        $developer_id = $developer->id;
                                    } else {
                                        // Create I developer
                                        $developer_data['translations'][0]['language_id'] = 2;
                                        $developer_data['translations'][0]['developer'] = $row['developer'];
                                        $developer_data['translations'][0]['description'] = $row['developer'];
                                        $action = new CreateIDeveloperAction;
                                        $developer = $action->execute($developer_data);
                                        $developer_id = $developer->id;
                                    }
                                }
                            }
                            if ($project) {

                                // if ($project->developer_id != $developer_id) {
                                //     $i_project = IProject::find($project->id)->update([
                                //         'developer_id' => $developer_id
                                //     ]);
                                // }

                                $unit_data['i_project_id'] = $project->id;
                            } else {
                                // Create I project
                                $project_data['translations'][0]['language_id'] = 2;
                                $project_data['translations'][0]['project'] = $row['project'];
                                $project_data['developer_id'] = $developer_id;

                                $action = new CreateIProjectAction;
                                $project = $action->execute($project_data);
                                $unit_data['i_project_id'] = $project->id;
                            }
                        }
                    }

                    // View
                    // if (isset($row['view']) && !is_null($row['view'])) {
                    //     $validate = Validator::make(['view' => $row['view']], [
                    //         'view' => 'required|string|max:191',

                    //     ]);
                    //     if (!$validate->fails()) {

                    //         $view = IView::whereHas('translations', function ($translations) use ($row) {
                    //             $translations->where('view', $row['view']);
                    //         })->first();
                    //         if ($view) {
                    //             $unit_data['i_view_id'] = $view->id;
                    //         } else {
                    //             // Create I view
                    //             $view_data['translations'][0]['language_id'] = 2;
                    //             $view_data['translations'][0]['view'] = $row['view'];
                    //             $view_data['order'] = 0;

                    //             $action = new CreateIViewAction;
                    //             $view = $action->execute($view_data);
                    //             $unit_data['i_view_id'] = $view->id;
                    //         }
                    //     }
                    // }

                    // Bedroom
                    if (isset($row['bedroom']) && !is_null($row['bedroom'])) {
                        $validate = Validator::make(['bedroom' => $row['bedroom']], [
                            'bedroom' => 'required|integer|max:2147483647',
                        ]);
                        if (!$validate->fails()) {

                            $bedroom = IBedroom::where('count', $row['bedroom'])->first();
                            if ($bedroom) {
                                $unit_data['i_bedroom_id'] = $bedroom->id;
                            } else {
                                // Create I bedroom
                                $bedroom_data['count'] = $row['bedroom'];
                                $bedroom_data['translations'][0]['language_id'] = 2;
                                $bedroom_data['translations'][0]['displayed_text'] = $row['bedroom'];
                                $bedroom_data['order'] = 0;

                                $action = new CreateIBedroomAction;
                                $bedroom = $action->execute($bedroom_data);
                                $unit_data['i_bedroom_id'] = $bedroom->id;
                            }
                        }
                    }

                    // Bathroom
                    if (isset($row['bathroom']) && !is_null($row['bathroom'])) {
                        $validate = Validator::make(['bathroom' => $row['bathroom']], [
                            'bathroom' => 'required|integer|max:2147483647',
                        ]);
                        if (!$validate->fails()) {

                            $bathroom = IBathroom::where('count', $row['bathroom'])->first();
                            if ($bathroom) {
                                $unit_data['i_bathroom_id'] = $bathroom->id;
                            } else {
                                // Create I bathroom
                                $bedroom_data['count'] = $row['bathroom'];
                                $bathroom_data['translations'][0]['language_id'] = 2;
                                $bathroom_data['translations'][0]['displayed_text'] = $row['bathroom'];
                                $bathroom_data['order'] = 0;

                                $action = new CreateIBathroomAction;
                                $bathroom = $action->execute($bathroom_data);
                                $unit_data['i_bathroom_id'] = $bathroom->id;
                            }
                        }
                    }

                    // Floor Number
                    // if (isset($row['floor_number']) && !is_null($row['floor_number'])) {
                    //     $validate = Validator::make(['floor_number' => $row['floor_number']], [
                    //         'floor_number' => 'required|string|max:191',
                    //     ]);
                    //     if (!$validate->fails()) {

                    //         $floor_number = IFloorNumber::whereHas('translations', function ($translations) use ($row) {
                    //             $translations->where('displayed_text', $row['floor_number']);
                    //         })->first();

                    //         if ($floor_number) {
                    //             $unit_data['i_floor_number_id'] = $floor_number->id;
                    //         } else {
                    //             // Create I floor_number
                    //             $floor_number_data['count'] = $row['floor_number'];
                    //             $floor_number_data['translations'][0]['language_id'] = 2;
                    //             $floor_number_data['translations'][0]['displayed_text'] = $row['floor_number'];
                    //             $floor_number_data['order'] = 0;

                    //             $action = new CreateIFloorNumberAction;
                    //             $floor_number = $action->execute($floor_number_data);
                    //             $unit_data['i_floor_number_id'] = $floor_number->id;
                    //         }
                    //     }
                    // }

                    // Check Purpose
                    if (isset($row['property_use']) && !is_null($row['property_use'])) {
                        $validate = Validator::make(['property_use' => $row['property_use']], [
                            'property_use' => 'required|string|max:191',
                        ]);
                        if (!$validate->fails()) {

                            $purpose = IPurpose::whereHas('translations', function ($translations) use ($row) {
                                $translations->where('purpose', $row['property_use']);
                            })->first();
                            if ($purpose) {
                                $unit_data['i_purpose_id'] = $purpose->id;
                            } else {
                                // Create I purpose
                                $purpose_data['translations'][0]['language_id'] = 2;
                                $purpose_data['translations'][0]['purpose'] = $row['property_use'];
                                $purpose_data['order'] = 0;

                                $action = new CreateIPurposeAction;
                                $purpose = $action->execute($purpose_data);
                                $unit_data['i_purpose_id'] = $purpose->id;
                            }
                        }

                        // Purpose Type
                        if (isset($row['type']) && !is_null($row['type'])) {
                            $validate = Validator::make(['type' => $row['type']], [
                                'type' => 'required|string|max:191',
                            ]);
                            if (!$validate->fails()) {

                                $purpose_type = IPurposeType::whereHas('translations', function ($translations) use ($row) {
                                    $translations->where('purpose_type', $row['type']);
                                })->where('i_purpose_id', $unit_data['i_purpose_id'])->first();
                                if ($purpose_type) {
                                    $unit_data['i_purpose_type_id'] = $purpose_type->id;
                                } else {
                                    // Create I purpose_type
                                    $purpose_type_data['translations'][0]['language_id'] = 2;
                                    $purpose_type_data['translations'][0]['purpose_type'] = $row['type'];
                                    $purpose_type_data['order'] = 0;
                                    $purpose_type_data['i_purpose_id'] = $unit_data['i_purpose_id'];
                                    $action = new CreateIPurposeTypeAction;
                                    $purpose_type = $action->execute($purpose_type_data);
                                    $unit_data['i_purpose_type_id'] = $purpose_type->id;
                                }
                            }
                        }
                    }

                    // Country
                    $country_id = null;
                    if (isset($row['country']) && !is_null($row['country'])) {
                        $validate = Validator::make(['country' => $row['country']], [
                            'country' => 'required|string|max:191',
                        ]);
                        if (!$validate->fails()) {
                            $country = Location::whereHas('translations', function ($translations) use ($row) {
                                $translations->where('name', $row['country']);
                            })->first();
                            if ($country) {
                                $unit_data['country_id'] = $country->id;
                                $country_id = $country->id;
                            } else {
                                // Create I country
                                $country_translations[0]['language_id'] = 2;
                                $country_translations[0]['name'] = $row['country'];
                                $country_data['order'] = 0;
                                $country_data['is_active'] = 1;
                                $country_data['parent_id'] = Location::where('parent_id', null)->first()->id;
                                $action = new CreateLocationAction;
                                $country = $action->execute($country_data, $country_translations);
                                $unit_data['country_id'] = $country->id;
                                $country_id = $country->id;
                            }
                        }

                        // Region
                        $region_id = null;
                        if (isset($row['region']) && !is_null($row['region'])) {
                            $validate = Validator::make(['region' => $row['region']], [
                                'region' => 'required|string|max:191',
                            ]);
                            if (!$validate->fails()) {

                                $region = Location::whereHas('translations', function ($translations) use ($row) {
                                    $translations->where('name', $row['region']);
                                })->where('parent_id', $country_id)->first();
                                if ($region) {
                                    $unit_data['region_id'] = $region->id;
                                    $region_id = $region->id;
                                } else {
                                    // Create I region
                                    $region_translations[0]['language_id'] = 2;
                                    $region_translations[0]['name'] = $row['region'];
                                    $region_data['order'] = 0;
                                    $region_data['is_active'] = 1;
                                    $region_data['parent_id'] = $country_id;
                                    $action = new CreateLocationAction;
                                    $region = $action->execute($region_data, $region_translations);
                                    $unit_data['region_id'] = $region->id;
                                    $region_id = $region->id;
                                }
                            }

                            // City
                            $city_id = null;
                            if (isset($row['city']) && !is_null($row['city'])) {
                                $validate = Validator::make(['city' => $row['city']], [
                                    'city' => 'required|string|max:191',
                                ]);
                                if (!$validate->fails()) {
                                    $city = Location::whereHas('translations', function ($translations) use ($row) {
                                        $translations->where('name', $row['city']);
                                    })->where('parent_id', $region_id)->first();
                                    if ($city) {
                                        $unit_data['city_id'] = $city->id;
                                        $city_id = $city->id;
                                    } else {
                                        // Create I city
                                        $city_translations[0]['language_id'] = 2;
                                        $city_translations[0]['name'] = $row['city'];
                                        $city_data['order'] = 0;
                                        $city_data['is_active'] = 1;
                                        $city_data['parent_id'] = $region_id;
                                        $action = new CreateLocationAction;
                                        $city = $action->execute($city_data, $city_translations);
                                        $unit_data['city_id'] = $city->id;
                                        $city_id = $city->id;
                                    }
                                }

                                // Area
                                if (isset($row['area_place']) && !is_null($row['area_place'])) {
                                    $validate = Validator::make(['area_place' => $row['area_place']], [
                                        'area_place' => 'required|string|max:191',
                                    ]);
                                    if (!$validate->fails()) {

                                        $area = Location::whereHas('translations', function ($translations) use ($row) {
                                            $translations->where('name', $row['area_place']);
                                        })->where('parent_id', $city_id)->first();
                                        if ($area) {
                                            $unit_data['area_id'] = $area->id;
                                        } else {
                                            // Create I area
                                            $area_translations[0]['language_id'] = 2;
                                            $area_translations[0]['name'] = $row['area_place'];
                                            $area_data['order'] = 0;
                                            $area_data['is_active'] = 1;
                                            $area_data['parent_id'] = $city_id;
                                            $action = new CreateLocationAction;
                                            $area = $action->execute($area_data, $area_translations);
                                            $unit_data['area_id'] = $area->id;
                                        }
                                    }
                                }
                            }
                        }
                    }

                    // Payment Method
                    // if (isset($row['payment_method']) && !is_null($row['payment_method'])) {
                    //     $validate = Validator::make(['payment_method' => $row['payment_method']], [
                    //         'payment_method' => 'required|string|max:191',
                    //     ]);
                    //     if (!$validate->fails()) {

                    //         $payment_method = IPaymentMethod::whereHas('translations', function ($translations) use ($row) {
                    //             $translations->where('payment_method', $row['payment_method']);
                    //         })->first();
                    //         if ($payment_method) {
                    //             $unit_data['i_payment_method_id'] = $payment_method->id;
                    //         } else {
                    //             // Create I payment_method
                    //             $payment_method_data['translations'][0]['language_id'] = 2;
                    //             $payment_method_data['translations'][0]['payment_method'] = $row['payment_method'];
                    //             $payment_method_data['order'] = 0;
                    //             $action = new CreateIPaymentMethodAction;
                    //             $payment_method = $action->execute($payment_method_data);
                    //             $unit_data['i_payment_method_id'] = $payment_method->id;
                    //         }
                    //     }
                    // }

                    // Garden Area Unit
                    // if (isset($row['garden_area_unit']) && !is_null($row['garden_area_unit'])) {
                    //     $validate = Validator::make(['garden_area_unit' => $row['garden_area_unit']], [
                    //         'garden_area_unit' => 'required|string|max:191',
                    //     ]);
                    //     if (!$validate->fails()) {

                    //         $garden_area_unit = IAreaUnit::whereHas('translations', function ($translations) use ($row) {
                    //             $translations->where('area_unit', $row['garden_area_unit']);
                    //         })->first();
                    //         if ($garden_area_unit) {
                    //             $unit_data['i_garden_area_unit_id'] = $garden_area_unit->id;
                    //         } else {
                    //             // Create I garden_area_unit
                    //             $garden_area_unit_data['translations'][0]['language_id'] = 2;
                    //             $garden_area_unit_data['translations'][0]['area_unit'] = $row['garden_area_unit'];
                    //             $garden_area_unit_data['order'] = 0;
                    //             $action = new CreateIAreaUnitAction;
                    //             $garden_area_unit = $action->execute($garden_area_unit_data);
                    //             $unit_data['i_garden_area_unit_id'] = $garden_area_unit->id;
                    //         }
                    //     }
                    // }

                    // Area Unit
                    if (isset($row['area_unit']) && !is_null($row['area_unit'])) {
                        $validate = Validator::make(['area_unit' => $row['area_unit']], [
                            'area_unit' => 'required|string|max:191',
                        ]);
                        if (!$validate->fails()) {

                            $area_unit = IAreaUnit::whereHas('translations', function ($translations) use ($row) {
                                $translations->where('area_unit', $row['area_unit']);
                            })->first();
                            if ($area_unit) {
                                $unit_data['i_area_unit_id'] = $area_unit->id;
                            } else {
                                // Create I area_unit
                                $area_unit_data['translations'][0]['language_id'] = 2;
                                $area_unit_data['translations'][0]['area_unit'] = $row['area_unit'];
                                $area_unit_data['order'] = 0;
                                $action = new CreateIAreaUnitAction;
                                $area_unit = $action->execute($area_unit_data);
                                $unit_data['i_area_unit_id'] = $area_unit->id;
                            }
                        }
                    }

                    // Finishing Type
                    if (isset($row['finishing_type']) && !is_null($row['finishing_type'])) {
                        $validate = Validator::make(['finishing_type' => $row['finishing_type']], [
                            'finishing_type' => 'required|string|max:191',
                        ]);
                        if (!$validate->fails()) {

                            $finishing_type = IFinishingType::whereHas('translations', function ($translations) use ($row) {
                                $translations->where('finishing_type', $row['finishing_type']);
                            })->first();
                            if ($finishing_type) {
                                $unit_data['i_finishing_type_id'] = $finishing_type->id;
                            } else {
                                // Create I finishing_type
                                $finishing_type_data['translations'][0]['language_id'] = 2;
                                $finishing_type_data['translations'][0]['finishing_type'] = $row['finishing_type'];
                                $finishing_type_data['order'] = 0;
                                $action = new CreateIFinishingTypeAction;
                                $finishing_type = $action->execute($finishing_type_data);
                                $unit_data['i_finishing_type_id'] = $finishing_type->id;
                            }
                        }
                    }

                    // Furnishing Status
                    if (isset($row['furnishing_status']) && !is_null($row['furnishing_status'])) {
                        $validate = Validator::make(['furnishing_status' => $row['furnishing_status']], [
                            'furnishing_status' => 'required|string|max:191',
                        ]);
                        if (!$validate->fails()) {

                            $furnishing_status = IFurnishingStatus::whereHas('translations', function ($translations) use ($row) {
                                $translations->where('furnishing_status', $row['furnishing_status']);
                            })->first();
                            if ($furnishing_status) {
                                $unit_data['i_furnishing_status_id'] = $furnishing_status->id;
                            } else {
                                // Create I furnishing_status
                                $furnishing_status_data['translations'][0]['language_id'] = 2;
                                $furnishing_status_data['translations'][0]['furnishing_status'] = $row['furnishing_status'];
                                $furnishing_status_data['order'] = 0;
                                $action = new CreateIFurnishingStatusAction;
                                $furnishing_status = $action->execute($furnishing_status_data);
                                $unit_data['i_furnishing_status_id'] = $furnishing_status->id;
                            }
                        }
                    }

                    // Facilities
                    $facilities_array = array();
                    if (isset($row['facilities'])) {
                        $validate = Validator::make(['facilities' => $row['facilities']], [
                            'facilities' => 'required|string|min:2',
                        ]);
                        if (!$validate->fails()) {
                            $facilities = explode(',', $row['facilities']);
                            foreach ($facilities as $facility_text) {
                                $validate = Validator::make(['facility_text' => $facility_text], [
                                    'facility_text' => 'required|string|min:2|max:191',
                                ]);
                                if (!$validate->fails()) {
                                    $facility = IFacility::whereHas('translations', function ($translations) use ($facility_text) {
                                        $translations->where('facility', $facility_text);
                                    })->first();
                                    if ($facility) {
                                        array_push($facilities_array, $facility->id);
                                    } else {
                                        // Create I facility
                                        $facility_data['translations'][0]['language_id'] = 2;
                                        $facility_data['translations'][0]['facility'] = $facility_text;
                                        $facility_data['translations'][0]['description'] = null;
                                        $facility_data['order'] = 0;
                                        $action = new CreateIFacilityAction;
                                        $facility = $action->execute($facility_data);
                                        array_push($facilities_array, $facility->id);
                                    }
                                }
                            }
                        }
                    }

                    // Check AMENITIES
                    $amenities_array = array();
                    if (isset($row['amenities'])) {
                        $validate = Validator::make(['amenities' => $row['amenities']], [
                            'amenities' => 'required|string|min:2',
                        ]);
                        if (!$validate->fails()) {
                            $amenities = explode(',', $row['amenities']);
                            foreach ($amenities as $amenity_text) {
                                $validate = Validator::make(['amenity_text' => $amenity_text], [
                                    'amenity_text' => 'required|string|min:2|max:191',
                                ]);
                                if (!$validate->fails()) {
                                    $amenity = IAmenity::whereHas('translations', function ($translations) use ($amenity_text) {
                                        $translations->where('amenity', $amenity_text);
                                    })->first();
                                    if ($amenity) {
                                        array_push($amenities_array, $amenity->id);
                                    } else {
                                        try {
                                            // Create I amenity
                                            $amenity_data['translations'][0]['language_id'] = 2;
                                            $amenity_data['translations'][0]['amenity'] = $amenity_text;
                                            $amenity_data['translations'][0]['description'] = null;
                                            $amenity_data['order'] = 0;
                                            $action = new CreateIAmenityAction;
                                            $amenity = $action->execute($amenity_data);
                                            array_push($amenities_array, $amenity->id);
                                        } catch (\Throwable $th) {
                                        }
                                    }
                                }
                            }
                        }
                    }

                    // Check TAGS
                    $tags_array = array();
                    if (isset($row['tags'])) {
                        if (isset($row['tags'])) {
                            $validate = Validator::make(['tags' => $row['tags']], [
                                'tags' => 'required|string|min:2|max:191',
                            ]);
                            if (!$validate->fails()) {
                                $tags = explode(',', $row['tags']);
                                foreach ($tags as $tag_text) {
                                    $validate = Validator::make(['tag_text' => $tag_text], [
                                        'tag_text' => 'required|string|min:1|max:191',
                                    ]);
                                    if (!$validate->fails()) {
                                        $tag = Tag::where('tag', $tag_text)->first();
                                        if ($tag) {
                                            array_push($tags_array, $tag->id);
                                        } else {
                                            // Create I tag
                                            $tag_data['tag'] = $tag_text;
                                            $tag_data['order'] = 0;
                                            $action = new CreateTagAction;
                                            $tag = $action->execute($tag_data);
                                            array_push($tags_array, $tag->id);
                                        }
                                    }
                                }
                            }
                        }
                    }
                    // Check buyer
                    // if (isset($row['buyer']) && !is_null($row['buyer'])) {
                    //     $validate = Validator::make(['buyer' => $row['buyer']], [
                    //         'buyer' => 'required|string|max:191',
                    //     ]);
                    //     if (!$validate->fails()) {
                    //         $buyer = User::Where('email', $row['buyer'])->first();
                    //         if ($buyer) {
                    //             $unit_data['buyer_id'] = $buyer->id;
                    //         }
                    //     }
                    // }

                    // if (isset($row['building_number']) && !is_null($row['building_number'])) {
                    //     $validate = Validator::make(['building_number' => $row['building_number']], [
                    //         'building_number' => "required|string|max:191",
                    //     ]);
                    //     if (!$validate->fails()) {
                    //         $unit_data['building_number'] = $row['building_number'];
                    //     }
                    // }
                    if (isset($row['area']) && !is_null($row['area'])) {
                        $validate = Validator::make(['area' => $row['area']], [
                            'area' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|max:2147483647',
                        ]);
                        if (!$validate->fails()) {
                            $unit_data['area'] = $row['area'];
                        }
                    }
                    // if (isset($row['garden_area']) && !is_null($row['garden_area'])) {
                    //     $validate = Validator::make(['garden_area' => $row['garden_area']], [
                    //         'garden_area' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|max:2147483647',
                    //     ]);
                    //     if (!$validate->fails()) {
                    //         $unit_data['garden_area'] = $row['garden_area'];
                    //     }
                    // }
                    // if (isset($row['plot_area']) && !is_null($row['plot_area'])) {
                    //     $validate = Validator::make(['plot_area' => $row['plot_area']], [
                    //         'plot_area' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|max:2147483647',
                    //     ]);
                    //     if (!$validate->fails()) {
                    //         $unit_data['plot_area'] = $row['plot_area'];
                    //     }
                    // }
                    // if (isset($row['build_up_area']) && !is_null($row['build_up_area'])) {
                    //     $validate = Validator::make(['build_up_area' => $row['build_up_area']], [
                    //         'build_up_area' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|max:2147483647',
                    //     ]);
                    //     if (!$validate->fails()) {
                    //         $unit_data['build_up_area'] = $row['build_up_area'];
                    //     }
                    // }
                    if (isset($row['price']) && !is_null($row['price'])) {
                        $validate = Validator::make(['price' => $row['price']], [
                            'price' => 'required|integer|max:2147483647',
                        ]);
                        if (!$validate->fails()) {
                            $unit_data['price'] = $row['price'];
                        }
                    }

                    // if (isset($row['terrace_area']) && !is_null($row['terrace_area'])) {
                    //     $validate = Validator::make(['terrace_area' => $row['terrace_area']], [
                    //         'terrace_area' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|max:2147483647',
                    //     ]);
                    //     if (!$validate->fails()) {
                    //         $unit_data['terrace_area'] = $row['terrace_area'];
                    //     }
                    // }
                    // if (isset($row['roof_area']) && !is_null($row['roof_area'])) {
                    //     $validate = Validator::make(['roof_area' => $row['roof_area']], [
                    //         'roof_area' => 'required|regex:/^[0-9]+(\.[0-9][0-9]?)?$/|max:2147483647',
                    //     ]);
                    //     if (!$validate->fails()) {
                    //         $unit_data['roof_area'] = $row['roof_area'];
                    //     }
                    // }
                    if (isset($row['latitude']) && !is_null($row['latitude'])) {
                        $validate = Validator::make(['latitude' => $row['latitude']], [
                            'latitude' => ['required', 'regex:/^-?([1-8]?[1-9]|[1-9]0)\.{1}\d{1,100}$/', 'max:191'],
                        ]);
                        if (!$validate->fails()) {
                            $unit_data['latitude'] = $row['latitude'];
                        }
                    }
                    if (isset($row['longitude']) && !is_null($row['longitude'])) {
                        $validate = Validator::make(['longitude' => $row['longitude']], [
                            'longitude' => ['required', 'regex:/^-?([1]?[1-7][1-9]|[1]?[1-8][0]|[1-9]?[0-9])\.{1}\d{1,100}$/', 'max:191'],
                        ]);
                        if (!$validate->fails()) {
                            $unit_data['longitude'] = $row['longitude'];
                        }
                    }
                    if (isset($row['address_ar']) && !is_null($row['address_ar'])) {
                        $validate = Validator::make(['address_ar' => $row['address_ar']], [
                            'address_ar' => 'required|string|max:2147483647',
                        ]);
                        if (!$validate->fails()) {
                            $unit_data['translations'][0]['language_id'] = 2;
                            $unit_data['translations'][0]['address'] = $row['address_ar'];
                        }

                        // if (isset($row['address_aen']) && !is_null($row['address_aen'])) {
                        //     $validate = Validator::make(['address_aen' => $row['address_aen']], [
                        //         'address_aen' => 'required|string|max:2147483647',
                        //     ]);
                        //     if (!$validate->fails()) {
                        //         $unit_data['translations'][1]['language_id'] = 2;
                        //         $unit_data['translations'][1]['address'] = $row['address_aen'];
                        //     }
                        // }
                    }
                    if (isset($row['description_ar']) && !is_null($row['description_ar'])) {
                        $validate = Validator::make(['description_ar' => $row['description_ar']], [
                            'description_ar' => 'required|string|max:2147483647',
                        ]);
                        if (!$validate->fails()) {
                            $unit_data['translations'][0]['language_id'] = 2;
                            $unit_data['translations'][0]['description'] = $row['description_ar'];
                        }

                        // if (isset($row['description_en']) && !is_null($row['description_en'])) {
                        //     $validate = Validator::make(['description_en' => $row['description_en']], [
                        //         'description_en' => 'required|string|max:2147483647',
                        //     ]);
                        //     if (!$validate->fails()) {
                        //         $unit_data['translations'][1]['language_id'] = 2;
                        //         $unit_data['translations'][1]['description'] = $row['description_en'];
                        //     }
                        // }
                    }

                    if (isset($row['down_payment']) && !is_null($row['down_payment'])) {
                        $validate = Validator::make(['down_payment' => $row['down_payment']], [
                            'down_payment' => 'required|integer|max:2147483647',
                        ]);
                        if (!$validate->fails()) {
                            $unit_data['down_payment'] = $row['down_payment'];
                        }
                    }
                    if (isset($row['installments']) && !is_null($row['installments'])) {
                        $validate = Validator::make(['installments' => $row['installments']], [
                            'installments' => 'required|integer|max:2147483647',
                        ]);
                        if (!$validate->fails()) {
                            $unit_data['installments'] = $row['installments'];
                        }
                    }
                    if (isset($row['currency_code']) && !is_null($row['currency_code'])) {
                        $validate = Validator::make(['currency_code' => $row['currency_code']], [
                            'currency_code' => 'required|string|max:191',
                        ]);
                        if (!$validate->fails()) {
                            $unit_data['currency_code'] = $row['currency_code'];
                        }
                    }

                    if (isset($row['is_featured']) && !is_null($row['is_featured'])) {
                        $validate = Validator::make(['is_featured' => $row['is_featured']], [
                            'is_featured' => ['required', Rule::in(['on'])],
                        ]);
                        if (!$validate->fails()) {
                            $unit_data['is_featured'] = $row['is_featured'];
                        }
                    }
                    if (isset($row['is_active']) && !is_null($row['is_active'])) {
                        $validate = Validator::make(['is_active' => $row['is_active']], [
                            'is_active' => ['required', Rule::in(['on'])],
                        ]);
                        if (!$validate->fails()) {
                            $unit_data['is_active'] = $row['is_active'];
                        }
                    }

                    // Attachments Handle
                    $attachments_array = array();
                    if (isset($row['attachments']) && !is_null($row['attachments'])) {
                        $validate = Validator::make(['attachments' => $row['attachments']], [
                            'attachments' => 'required|string',
                        ]);
                        if (!$validate->fails()) {
                            $attachments = explode(',', $row['attachments']);
                            foreach ($attachments as $key => $attachment) {
                                $validate = Validator::make(['attachment' => $attachment], [
                                    'attachment' => 'required|url',
                                ]);
                                if (!$validate->fails()) {
                                    if ($this->fetchImage($attachment)) {
                                        $file_attachment = $this->imageCreateAttachment($attachment);
                                        $attachments_array[$key]['order'] = 0;
                                        $attachments_array[$key]['file'] = $file_attachment;
                                    }
                                }
                            }
                        }
                    }

                    // Floor plan Handle
                    $floor_plans_array = array();
                    if (isset($row['floor_plans']) && !is_null($row['floor_plans'])) {
                        $validate = Validator::make(['floor_plans' => $row['floor_plans']], [
                            'floor_plans' => 'required|string',
                        ]);
                        if (!$validate->fails()) {
                            $floor_plans = explode(',', $row['floor_plans']);
                            foreach ($floor_plans as $key => $floor_plan) {
                                $validate = Validator::make(['floor_plan' => $floor_plan], [
                                    'floor_plan' => 'required|url',
                                ]);
                                if (!$validate->fails()) {
                                    if ($this->fetchImage($floor_plan)) {
                                        $file_floor = $this->imageCreateFloor($floor_plan);
                                        $floor_plans_array[$key]['order'] = 0;
                                        $floor_plans_array[$key]['file'] = $file_floor;
                                    }
                                }
                            }
                        }
                    }

                    // Master plan Handle
                    // $master_plans_array = array();
                    // if (isset($row['master_plans']) && !is_null($row['master_plans'])) {
                    //     $validate = Validator::make(['master_plans' => $row['master_plans']], [
                    //         'master_plans' => 'required|string',
                    //     ]);
                    //     if (!$validate->fails()) {
                    //         $master_plans = explode(',', $row['master_plans']);
                    //         foreach ($master_plans as $key => $master_plan) {
                    //             $validate = Validator::make(['master_plan' => $master_plan], [
                    //                 'master_plan' => 'required|url',
                    //             ]);
                    //             if (!$validate->fails()) {
                    //                 if ($this->fetchImage($master_plan)) {
                    //                     $file_master = $this->imageCreateMaster($master_plan);
                    //                     $master_plans_array[$key]['order'] = 0;
                    //                     $master_plans_array[$key]['file'] = $file_master;
                    //                 }
                    //             }
                    //         }
                    //     }
                    // }

                    // Image 360
                    $image_data = array();
                    if (isset($row['image_360']) && !is_null($row['image_360'])) {
                        $validate = Validator::make(['image_360' => $row['image_360']], [
                            'image_360' => 'required|string',
                        ]);
                        if (!$validate->fails()) {
                            $images = explode(',', $row['image_360']);
                            foreach ($images as $key => $value) {
                                $validate = Validator::make(['value' => $value], [
                                    'value' => 'required|url',
                                ]);
                                if (!$validate->fails()) {
                                    $image_data[$key]['translations'][0]['language_id'] = 2;
                                    $image_data[$key]['translations'][0]['title'] = 'image';
                                    $image_data[$key]['link'] = $value;
                                }
                            }
                        }
                    }

                    if ($is_valid) {
                        $action = new CreateIUnitAction;
                        $i_unit = $action->execute($unit_data, $facilities_array, $amenities_array, $attachments_array, $floor_plans_array, null, $image_data, $tags_array);
                        array_push($array_not_to_delete, $i_unit->id);
                    }
                    unset($unit_data);
                    unset($facilities_array);
                    unset($amenities_array);
                    unset($attachments_array);
                    unset($floor_plans_array);
                    unset($master_plans_array);
                    unset($image_data);
                    unset($images);
                    unset($tags_array);

                    $unit_data = array();
                    $facilities_array = array();
                    $amenities_array = array();
                    $attachments_array = array();
                    $floor_plans_array = array();
                    $master_plans_array = array();
                    $image_data = array();
                    $images = array();
                    $tags_array = array();
                } else {
                }
            }
            $units = IUnit::whereNotIn('id', $array_not_to_delete)->get();
            foreach ($units as $unit) {
                $action = new DeleteIUnitAction;
                $action->execute($unit->id);
            }

        } else {
            $errors = $validate_headers;

            throw new HttpResponseException(response()->json([
                'errors' => $errors
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
        }
    }

    public function validated($row)
    {
        $validate = Validator::make($row, [
            'unit_number' => 'required',
            'offering_type' => ['required', Rule::in(['Rent', 'Resale', 'Primary', 'للإيجار', 'لإعادة البيع', 'ابتدائي'])],
            'seller' => 'required|email',
        ]);
        return $validate;
    }
    public function validateHeaders($row)
    {
        $errors = array();
        if (!array_key_exists('unit_number', $row)) {
            $errors[] = [
                'field' => 'unit_number',
                'message' => 'Sheet must contain Unit Number'
            ];
        }

        if (!array_key_exists('offering_type', $row)) {
            $errors[] = [
                'field' => 'offering_type',
                'message' => 'Sheet must contain Offering Type'
            ];
        }

        if (!array_key_exists('seller', $row)) {
            $errors[] = [
                'field' => 'seller',
                'message' => 'Sheet must contain Seller'
            ];
        }

        return $errors;
    }
    public function fetchImage($file_url)
    {
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $file_url);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 60);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_handle, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($curl_handle, CURLOPT_USERAGENT, 'advisors');
        $query = curl_exec($curl_handle);
        $info = curl_getinfo($curl_handle, CURLINFO_HTTP_CODE);
        $mime = curl_getinfo($curl_handle, CURLINFO_CONTENT_TYPE);
        $error = curl_error($curl_handle);
        curl_close($curl_handle);
        if ($info == 200) {
            if (in_array($mime, ['tiff', 'image/tiff', 'jpeg', 'image/jpeg', 'gif', 'image/gif', 'png', 'image/png'])) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function imageCreateAttachment($url)
    {
        $info = pathinfo($url);

        // New file
        $new = "/bk/" . 'Attachment' . $info['basename'];

        // Write the contents back to a new file
        $file_content = file_get_contents($url);

        $store_file =  Storage::disk('public')->put($new, $file_content);

        $uploaded_file = new UploadedFile(public_path('storage' . $new), $info['basename'], null, null, true);
        return $uploaded_file;
    }
    public function imageCreateFloor($url)
    {
        $info = pathinfo($url);
        // New file
        $new = "/bk/" . 'Floor' . $info['basename'];

        // Write the contents back to a new file
        $file_content = file_get_contents($url);

        $store_file =  Storage::disk('public')->put($new, $file_content);

        $uploaded_file = new UploadedFile(public_path('storage' . $new), $info['basename'], null, null, true);
        return $uploaded_file;
    }
    public function imageCreateMaster($url)
    {
        $info = pathinfo($url);
        // New file
        $new = "/bk/" . 'Master' . $info['basename'];

        // Write the contents back to a new file
        $file_content = file_get_contents($url);

        $store_file =  Storage::disk('public')->put($new, $file_content);

        $uploaded_file = new UploadedFile(public_path('storage' . $new), $info['basename'], null, null, true);
        return $uploaded_file;
    }
}
