<?php

namespace Modules\Inventory\Http\Controllers\Actions\Search;

use Illuminate\Http\Request;
use Modules\Inventory\IUnit;
use Carbon\Carbon;
use Exception;

class UnitSearchAction
{
    public function execute($data)
    {
        // Search units
        $units = new IUnit();
        if (isset($data['region_id']) && !empty($data['region_id']) && is_array($data['region_id'])) {
            $units = $units->where(function ($query) use ($data) {
                $query->whereIn('region_id', $data['region_id']);
            });
        }
        if (isset($data['city_id']) && !empty($data['city_id']) && is_array($data['city_id'])) {
            $units = $units->where(function ($query) use ($data) {
                $query->whereIn('city_id', $data['city_id']);
            });
        }
        if (isset($data['keyword']) && !empty($data['keyword'])) {
            $units = $units->whereHas('city', function ($query) use ($data) {
                $query->whereHas('translations', function ($translations) use ($data) {
                    $translations->where('name', $data['keyword']);
                });
            });
        }
        if (isset($data['q']) && !empty($data['q'])) {

            $units = $units->where(function ($query) use ($data) {
                $query->whereHas('project', function ($query) use ($data) {
                    $query->whereHas('translations', function ($translations) use ($data) {
                        $translations->where('project', 'like', '%' . $data['q'] . '%');
                    })->orwhereHas('developer', function ($developer) use ($data) {
                        $developer->whereHas('translations', function ($translations) use ($data) {
                            $translations->where('developer', 'like', '%' . $data['q'] . '%');
                        });
                    });
                })->orWhereHas('city', function ($query) use ($data) {
                    $query->whereHas('translations', function ($translations) use ($data) {
                        $translations->where('name', 'like', '%' . $data['q'] . '%');
                    });
                });
            });
        }
        if (isset($data['project_id'])) {
            $units = $units->where('i_project_id', $data['project_id']);
        }
        if (isset($data['unit_type_id'])) {
            $units = $units->where('i_unit_type_id', $data['unit_type_id']);
        }
        if (isset($data['bedrooms'])) {
            $units = $units->whereIn('i_bedroom_id', $data['bedrooms']);
        }
        if (isset($data['bathrooms'])) {
            $units = $units->whereIn('i_bedroom_id', $data['bathrooms']);
        }
        if (isset($data['price_range']) && !empty($data['price_range'])) {
            $price = explode(';', $data['price_range']);
            // Default to total_unit_price
            if (isset($price[0])) {
                $units = $units->where('price', '>=', $price[0]);
            }
            if (isset($price[1])) {
                $units = $units->where('price', '<=', $price[1]);
            }
        }

        if (isset($data['facilities']) && !empty($data['facilities'])) {
            $units = $units->whereHas('facilities', function ($facility) use ($data) {
                $facility->whereIn('id', $data['facilities']);
            });
        }

        if (isset($data['amenities']) && !empty($data['amenities'])) {
            $units = $units->whereHas('amenities', function ($facility) use ($data) {
                $facility->whereIn('id', $data['amenities']);
            });
        }

        if (isset($data['area_range']) && !empty($data['area_range'])) {
            $area = explode(';', $data['area_range']);
            // Default to total_unit_area
            if (isset($area[0])) {
                $units = $units->where('area', '>=', $area[0]);
            }
            if (isset($area[1])) {
                $units = $units->where('area', '<=', $area[1]);
            }
        }

        if (isset($data['location_id']) && !empty($data['location_id'])) {
            $units = $units->where(function ($query) use ($data) {
                $query->where('city_id', $data['location_id']);
            });
        }
        // if (isset($data['build_up_area_from']) && !empty($data['build_up_area_from'])) {
        //     $units = $units->where('build_up_area', '>=', $data['build_up_area_from']);
        // }

        // if (isset($data['build_up_area_to']) && !empty($data['build_up_area_to'])) {
        //     $units = $units->where('build_up_area', '<=', $data['build_up_area_to']);
        // }

        // if (isset($data['plot_area_from']) && !empty($data['plot_area_from'])) {
        //     $units = $units->where('plot_area', '>=', $data['plot_area_from']);
        // }

        // if (isset($data['plot_area_to']) && !empty($data['plot_area_to'])) {
        //     $units = $units->where('plot_area', '<=', $data['plot_area_to']);
        // }

        // if (isset($data['garden_area_from']) && !empty($data['garden_area_from'])) {
        //     $units = $units->where('garden_area', '>=', $data['garden_area_from']);
        // }

        // if (isset($data['garden_area_to']) && !empty($data['garden_area_to'])) {
        //     $units = $units->where('garden_area', '<=', $data['garden_area_to']);
        // }

        if (isset($data['delivery_date_from'])) {
            try {
                $from = Carbon::createFromFormat('m/d/Y', $data['delivery_date_from'])->format('Y-m-d') . ' 00:00:00';
                $from = Carbon::createFromFormat('Y-m-d H:i:s', $from, auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->timezone('UTC')->toDateTimeString();
            } catch (Exception $e) {
                $from = null;
            }
            if ($from) {
                $units = $units->whereHas('project', function ($project) use ($from) {
                    $project->where('delivery_date', '>=', $from);
                });
            }
        }

        if (isset($data['delivery_date_to'])) {
            try {
                $to = Carbon::createFromFormat('m/d/Y', $data['delivery_date_to'])->format('Y-m-d') . ' 00:00:00';
                $to = Carbon::createFromFormat('Y-m-d H:i:s', $to, auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->timezone('UTC')->toDateTimeString();
            } catch (Exception $e) {
                $to = null;
            }
            if ($to) {
                $units = $units->whereHas('project', function ($project) use ($to) {
                    $project->where('delivery_date', '<=', $to);
                });
            }
        }


        if (isset($data['offering_types']) && !empty($data['offering_types'][0])) {
            $offering_types = $data['offering_types'];
            $units = $units->whereIn('i_offering_type_id', $offering_types);
        }

        if (isset($data['payment_methods']) && !empty($data['payment_methods'])) {
            $units = $units->whereIn('i_payment_method_id', $data['payment_methods']);
        }

        if (isset($data['purpose_ids']) && !empty($data['purpose_ids'][0])) {
            $units = $units->whereIn('i_purpose_id', $data['purpose_ids']);
        }

        if (isset($data['purpose_id']) && !empty($data['purpose_id'])) {
            $units = $units->whereHas('purpose', function ($purpose) use ($data) {
                $purpose->whereHas('translations', function ($translations) use ($data) {
                    $translations->where('purpose', 'like', '%' . $data['purpose_id'] . '%');
                });
            });
        }

        if (isset($data['purpose_type_ids']) && !empty($data['purpose_type_ids'])) {
            $units = $units->whereIn('i_purpose_type_id', $data['purpose_type_ids']);
        }

        if (isset($data['developers']) && !empty($data['developers'])) {
            $developers = $data['developers'];
            $units = $units->whereHas('project', function ($project) use ($developers) {
                $project->whereIn('developer_id', $developers);
            });
        }

        if (isset($data['finishing_types']) && !empty($data['finishing_types'])) {
            $units = $units->whereIn('i_finishing_type_id', $data['finishing_types']);
        }
        if (isset($data['furnishing_statuses']) && !empty($data['furnishing_statuses'])) {

            $units = $units->whereIn('i_furnishing_status_id', $data['furnishing_statuses']);
        }
        // if (isset($data['design_types']) && !empty($data['design_types'])) {
        //     $units = $units->whereIn('i_design_type_id', $data['design_types']);
        // }

        // if (isset($data['design_type']) && !empty($data['design_type'])) {
        //     $units = $units->whereHas('designType', function ($design_type) use ($data) {
        //         $design_type->whereHas('translations', function ($translation) use ($data) {
        //             $translation->where('type', $data['design_type']);
        //         });
        //     });
        // }
        if ((isset($data['ready_for_deliver']) && !empty($data['ready_for_deliver']))) {
            $units = $units->where('ready_to_move', 1);
        }
        if ((isset($data['not_ready_for_deliver']) && !empty($data['not_ready_for_deliver']))) {
            $units = $units->where('ready_to_move', 0);
        }

        if (isset($data['sort']) && !empty($data['sort'])) {
            switch ($data['sort']) {
                case 'featured':
                    $units = $units->where('is_featured', 1);
                    break;
                case 'asc_price':
                    $units = $units->orderBy('price', 'asc');
                    break;
                case 'desc_price':
                    $units = $units->orderBy('price', 'desc');
                    break;
                case 'asc_date':
                    $units = $units->orderBy('created_at', 'asc');
                    break;
                case 'desc_date':
                    $units = $units->orderBy('created_at', 'desc');
                    break;
                default:
                    # code...
                    break;
            }
        } else {
            $units = $units->orderBy('created_at', 'DESC');
        }

        return $units->active();
    }
}
