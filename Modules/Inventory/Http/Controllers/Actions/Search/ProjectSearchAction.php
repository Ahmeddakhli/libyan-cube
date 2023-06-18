<?php

namespace Modules\Inventory\Http\Controllers\Actions\Search;

use Illuminate\Http\Request;
use Modules\Inventory\IProject;
use Modules\Inventory\IUnit;
use Carbon\Carbon;

class ProjectSearchAction
{
    public function execute($data)
    {
        // dd($data);
        // Search project
        $projects = new IProject();

        if (isset($data['region_id']) && !empty($data['region_id']) && is_array($data['region_id'])) {
            $projects = $projects->where(function ($query) use ($data) {
                $query->whereIn('region_id', $data['region_id']);
            });
        }
        if (isset($data['city_id']) && !empty($data['city_id']) && is_array($data['city_id'])) {
            $projects = $projects->where(function ($query) use ($data) {
                $query->whereIn('city_id', $data['city_id']);
            });
        }
        if (isset($data['keyword']) && !empty($data['keyword'])) {
            $projects = $projects->whereHas('developer', function ($query) use ($data) {
                $query->whereHas('translations', function ($translations) use ($data) {
                    $translations->where('developer', $data['keyword']);
                });
            });
        }
        if (isset($data['bedrooms']) && !empty($data['bedrooms'])) {
            $bedrooms = $data['bedrooms'];

            $projects = $projects->whereHas('units', function ($q) use ($bedrooms) {
                $q->whereIn('i_bedroom_id', $bedrooms);
            });
        }

        if (isset($data['price_range']) && !empty($data['price_range'])) {
            $price = explode(';', $data['price_range']);
            // Default to total_unit_price
            if (isset($price[0])) {
                $projects = $projects->where('price_from', '>=', $price[0]);
            }
            if (isset($price[1])) {
                $projects = $projects->where('price_from', '<=', $price[1]);
            }
        }

        if (isset($data['facilities']) && !empty($data['facilities'])) {
            $projects = $projects->whereHas('facilities', function ($facility) use ($data) {
                $facility->whereIn('id', $data['facilities']);
            });
        }

        if (isset($data['amenities']) && !empty($data['amenities'])) {
            $projects = $projects->whereHas('amenities', function ($facility) use ($data) {
                $facility->whereIn('id', $data['amenities']);
            });
        }

        if (isset($data['area_range']) && !empty($data['area_range'])) {
            $area = explode(';', $data['area_range']);
            // Default to total_unit_area
            if (isset($area[0])) {
                $projects = $projects->where('area_from', '>=', $area[0]);
            }
            if (isset($area[1])) {
                $projects = $projects->where('area_to', '<=', $area[1]);
            }
        }

        if (isset($data['delivery_date_from'])) {
            try {
                $from = Carbon::createFromFormat('m/d/Y', $data['delivery_date_from'])->format('Y-m-d') . ' 00:00:00';
                $from = Carbon::createFromFormat('Y-m-d H:i:s', $from, auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->timezone('UTC')->toDateTimeString();
            } catch (Exception $e) {
                $from = null;
            }
            if ($from) {
                $projects = $projects->where('delivery_date', '<=', $from);
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
                $projects = $projects->where('delivery_date', '>=', $to);
            }
        }
        if ((isset($data['ready_for_deliver']) && !empty($data['ready_for_deliver']))) {
            $projects = $projects->where('ready_to_move', 1);
        }
        if ((isset($data['not_ready_for_deliver']) && !empty($data['not_ready_for_deliver']))) {
            $projects = $projects->where('ready_to_move', 0);
        }
        if (isset($data['offering_types']) && !empty($data['offering_types'])) {
            $offering_types = $data['offering_types'];
            $projects = $projects->whereHas('units', function ($unit) use ($offering_types) {
                $unit->whereIn('i_offering_type_id', $offering_types);
            });
        }


        if (isset($data['payment_methods']) && !empty($data['payment_methods'])) {
            $payment_methods = $data['payment_methods'];
            $projects = $projects->whereHas('units', function ($unit) use ($payment_methods) {
                $unit->whereIn('i_payment_method_id', $payment_methods);
            });
        }

        if (isset($data['purpose_ids']) && !empty($data['purpose_ids'][0])) {
            $purpose_ids = $data['purpose_ids'];
            $projects = $projects->whereHas('units', function ($unit) use ($purpose_ids) {
                $unit->whereIn('i_purpose_id', $purpose_ids);
            });
        }

        if (isset($data['purpose_type_ids']) && !empty($data['purpose_type_ids'])) {
            $purpose_type_ids = $data['purpose_type_ids'];
            $projects = $projects->whereHas('units', function ($unit) use ($purpose_type_ids) {
                $unit->whereIn('i_purpose_type_id', $purpose_type_ids);
            });
        }

        if (isset($data['purpose_id']) && !empty($data['purpose_id'])) {
            $purpose_id = $data['purpose_id'];
            $projects = $projects->whereHas(
                'units',
                function ($unit) use ($purpose_id) {
                    $unit->whereHas('purpose', function ($purpose) use ($purpose_id) {
                        $purpose->whereHas('translations', function ($translations) use ($purpose_id) {
                            $translations->where('purpose', 'like', '%' . $purpose_id . '%');
                        });
                    });
                }
            );
        }

        if (isset($data['developers']) && !empty($data['developers'])) {
            $projects = $projects->whereIn('developer_id', $data['developers']);
        }
        if (isset($data['i_developer_id']) && !empty($data['i_developer_id'])) {
            $projects = $projects->where('developer_id', $data['i_developer_id']);
        }
        if (isset($data['finishing_types']) && !empty($data['finishing_types'])) {
            $finishing_types = $data['finishing_types'];
            $projects = $projects->whereHas('units', function ($unit) use ($finishing_types) {
                $unit->whereIn('i_finishing_type_id', $finishing_types);
            });
        }

        if (isset($data['i_developer_id']) && !empty($data['i_developer_id'])) {
            $projects = $projects->where('developer_id', $data['i_developer_id']);
        }

        // if (isset($data['location_id']) && !empty($data['location_id'])) {
        //     $projects = $projects->where(function ($query) use ($data) {
        //         $query->where('city_id', $data['location_id']);
        //     });
        // }

        if (isset($data['sort']) && !empty($data['sort'])) {
            switch ($data['sort']) {
                case 'featured':
                    $projects = $projects->where('is_featured', 1);
                    break;
                case 'asc_price':
                    $projects = $projects->orderBy('price_from', 'asc');
                    break;
                case 'desc_price':
                    $projects = $projects->orderBy('price_from', 'desc');
                    break;
                case 'asc_date':
                    $projects = $projects->orderBy('created_at', 'asc');
                    break;
                case 'desc_date':
                    $projects = $projects->orderBy('created_at', 'desc');
                    break;
                default:
                    # code...
                    break;
            }
        } else {
            $projects = $projects->orderBy('created_at', 'DESC');
        }

        return $projects;
    }
}
