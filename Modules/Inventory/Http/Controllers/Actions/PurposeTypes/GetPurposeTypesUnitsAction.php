<?php

namespace Modules\Inventory\Http\Controllers\Actions\PurposeTypes;

use Carbon\Carbon;
use Exception;
use Modules\Inventory\IPurposeType;

class GetPurposeTypesUnitsAction
{
    public function execute($data)
    {
        $purpose_types = IPurposeType::whereHas('units', function ($units) use ($data) {
            if (isset($data['location_id']) && !is_null($data['location_id'])) {
                $units = $units->where(function ($query) use ($data) {
                    $query->where('country_id', $data['location_id'])
                        ->orwhere('region_id', $data['location_id'])
                        ->orwhere('city_id', $data['location_id'])
                        ->orwhere('area_id', $data['location_id']);
                });
            }

            if (isset($data['bedrooms'])) {
                $units = $units->whereIn('i_bedroom_id', $data['bedrooms']);
            }

            // Default to total_unit_price
            if (isset($data['min_price'])) {
                $units = $units->where('price', '>=', $data['min_price']);
            }
            if (isset($data['max_price'])) {
                $units = $units->where('price', '<=', $data['max_price']);
            }

            if (isset($data['must_have']) && !is_null($data['must_have'])) {
                $must_have = $data['must_have'];
                $units = $units->where(function ($query) use ($must_have) {
                    $query->whereHas('facilities', function ($facility) use ($must_have) {
                        $facility->whereIn('id', $must_have);
                    })->orWhereHas('amenities', function ($amenity) use ($must_have) {
                        $amenity->whereIn('id', $must_have);
                    });
                });
            }

            if (isset($data['not_have']) && !is_null($data['not_have'])) {
                $not_have = $data['not_have'];
                $units = $units->where(function ($query) use ($not_have) {
                    $query->whereDoesntHave('facilities', function ($facility) use ($not_have) {
                        $facility->whereIn('id', $not_have);
                    })->whereDoesntHave('amenities', function ($amenity) use ($not_have) {
                        $amenity->whereIn('id', $not_have);
                    });
                });
            }

            if (isset($data['area_from']) && !is_null($data['area_from'])) {
                $units = $units->where('area', '>=', $data['area_from']);
            }

            if (isset($data['area_to'])  && !is_null($data['area_to'])) {
                $units = $units->where('area', '<=', $data['area_to']);
            }

            if (isset($data['build_up_area_from']) && !is_null($data['build_up_area_from'])) {
                $units = $units->where('build_up_area', '>=', $data['build_up_area_from']);
            }

            if (isset($data['build_up_area_to']) && !is_null($data['build_up_area_to'])) {
                $units = $units->where('build_up_area', '<=', $data['build_up_area_to']);
            }

            if (isset($data['plot_area_from']) && !is_null($data['plot_area_from'])) {
                $units = $units->where('plot_area', '>=', $data['plot_area_from']);
            }

            if (isset($data['plot_area_to']) && !is_null($data['plot_area_to'])) {
                $units = $units->where('plot_area', '<=', $data['plot_area_to']);
            }

            if (isset($data['garden_area_from']) && !is_null($data['garden_area_from'])) {
                $units = $units->where('garden_area', '>=', $data['garden_area_from']);
            }

            if (isset($data['garden_area_to']) && !is_null($data['garden_area_to'])) {
                $units = $units->where('garden_area', '<=', $data['garden_area_to']);
            }

            if (isset($data['delivery_date'])) {
                try {
                    $from = Carbon::createFromFormat('Y-m', $data['delivery_date'], auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->timezone('UTC')->toDateTimeString();
                } catch (Exception $e) {
                    $from = null;
                }
                if ($from) {
                    $units = $units->whereHas('project', function ($project) use ($from) {
                        $project->where('delivery_date', '>=', $from);
                    });
                }
            }

            if (isset($data['finished_status'])) {
                $units = $units->whereHas('project', function ($project) use ($data) {
                    $project->where('finished_status', $data['finished_status']);
                });
            }

            if (isset($data['project_id']) && $data['project_id']) {
                $units = $units->where('i_project_id', $data['project_id']);
            }
            
            
            if (isset($data['autocompleteValues']) && $data['autocompleteValues'][0]) {

                $units = $units->where(function ($query) use ($data) {
                    $query = $query->where(function ($locations) use ($data) {
                        $locations->whereIn('country_id', $data['autocompleteValues'])
                            ->orwhere('region_id', $data['autocompleteValues'])
                            ->orwhere('city_id', $data['autocompleteValues'])
                            ->orwhere('area_id', $data['autocompleteValues']);
                    })
                        ->orwhereHas('project', function ($project) use ($data) {
                            $project->whereIn('id', $data['autocompleteValues']);
                        })->orwhereHas('project', function ($project) use ($data) {
                            $project->whereIn('developer_id', $data['autocompleteValues']);
                        });
                });
            }

            // if (isset($data['delivery_date_to'])) {
            //     try {
            //         $to = Carbon::createFromFormat('m/d/Y', $data['delivery_date_to'])->format('Y-m-d').' 00:00:00';
            //         $to = Carbon::createFromFormat('Y-m-d H:i:s', $to, auth()->user()?auth()->user()->timezone:'Africa/Cairo')->timezone('UTC')->toDateTimeString();
            //     } catch (Exception $e) {
            //         $to = null;
            //     }
            //     if ($to) {            
            //         $units = $units->whereHas('project', function ($project) use ($to) {
            //             $project->where('delivery_date', '<=', $to);
            //         });
            //     }
            // }

            $search_type = isset($data['search_type']) ? $data['search_type'] : null;
            switch ($search_type) {
                case 'buy':
                    // Rental already excluded in front-end, get resale/primary only
                    if (isset($data['offering_types']) && !is_null($data['offering_types'])) {
                        $offering_types = $data['offering_types'];
                        $units = $units->whereIn('i_offering_type_id', $offering_types);
                    } else {
                        // Get resale and primary only
                        $units = $units->whereHas('offeringType', function ($offering_type) {
                            $offering_type->whereHas('translations', function ($translation) {
                                $translation->where('offering_type', 'Resale')->orWhere('offering_type', 'Primary');
                            });
                        });
                    }
                    break;
                case 'resale':
                    // Get resale units only
                    $units = $units->whereHas('offeringType', function ($offering_type) {
                        $offering_type->whereHas('translations', function ($translation) {
                            $translation->where('offering_type', 'Resale');
                        });
                    });
                    break;
                case 'rent':
                    // Get rental units only
                    $units = $units->whereHas('offeringType', function ($offering_type) {
                        $offering_type->whereHas('translations', function ($translation) {
                            $translation->where('offering_type', 'Rent');
                        });
                    });
                    break;
                default:
                    if (isset($data['offering_types']) && !is_null($data['offering_types'])) {
                        $offering_types = $data['offering_types'];
                        $units = $units->whereIn('i_offering_type_id', $offering_types);
                    }
                    break;
            }

            if (isset($data['payment_methods']) && !is_null($data['payment_methods'])) {
                $units = $units->whereIn('i_payment_method_id', $data['payment_methods']);
            }

            if (isset($data['purpose_ids']) && !is_null($data['purpose_ids'])) {
                $units = $units->whereIn('i_purpose_id', $data['purpose_ids']);
            }

            // if (isset($data['purpose_type_ids']) && !is_null($data['purpose_type_ids'])) {
            //     $units = $units->whereIn('i_purpose_type_id', $data['purpose_type_ids']);
            // }

            if (isset($data['developers']) && !is_null($data['developers'])) {
                $developers = $data['developers'];
                $units = $units->whereHas('project', function ($project) use ($developers) {
                    $project->whereIn('developer_id', $developers);
                });
            }

            if (isset($data['developer_id']) && !is_null($data['developer_id'])) {
                $developer_id = $data['developer_id'];
                $units = $units->whereHas('project', function ($project) use ($developer_id) {
                    $project->where('developer_id', $developer_id);
                });
            }
            if (isset($data['finishing_types']) && !is_null($data['finishing_types'])) {
                $units = $units->whereIn('i_finishing_type_id', $data['finishing_types']);
            }

            if (isset($data['design_types']) && !is_null($data['design_types'])) {
                $units = $units->whereIn('i_design_type_id', $data['design_types']);
            }

            if (isset($data['design_type']) && !is_null($data['design_type'])) {
                $units = $units->whereHas('designType', function ($design_type) use ($data) {
                    $design_type->whereHas('translations', function ($translation) use ($data) {
                        $translation->where('type', $data['design_type']);
                    });
                });
            }
        })->select('id')->withCount('units')->get();

        return $purpose_types;
    }
}
