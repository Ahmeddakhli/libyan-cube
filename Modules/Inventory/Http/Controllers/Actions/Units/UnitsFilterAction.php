<?php

namespace Modules\Inventory\Http\Controllers\Actions\Units;

use Modules\Inventory\IUnit;

class UnitsFilterAction
{
    public function execute($data)
    {
        // Search units
        $units = new IUnit();
        if (isset($data['bedroom'])) {
            $units = $units->whereIn('i_bedroom_id', $data['bedroom']);
        }
        
        if (isset($data['search_type'])) {
            if (isset($data['search_type']) &&  $data['search_type'] == 'buy') {
                if (isset($data['offering_type']) && !is_null($data['offering_type'])) {
                    $offering_types = $data['offering_type'];
                    $units = $units->whereIn('i_offering_type_id', $offering_types);
                }
            } else if (isset($data['search_type']) &&  $data['search_type'] == 'rent') {
                    $units = $units->whereHas('offeringType', function ($q) {
                        $q->whereHas('translations', function ($q) {
                            $q->where('offering_type', 'Rent');
                        });
                    });
            }
        } else {
            if (isset($data['offering_type']) && !is_null($data['offering_type'])) {
                $offering_types = $data['offering_type'];
                $units = $units->whereIn('i_offering_type_id', $offering_types);
            }
        }

        if (isset($data['budget_type']) && $data['budget_type'] == 'total_unit_price') {
            if (isset($data['price_from'])) {
                $units = $units->where('price', '>=', $data['price_from']);
            }
            if (isset($data['price_to'])) {
                $units = $units->where('price', '<=', $data['price_to']);
            }
        } else if (isset($data['budget_type']) && $data['budget_type'] == 'down_payment') {

            if (isset($data['price_from'])) {
                $units = $units->where('down_payment', '>=', $data['price_from']);
            }

            if (isset($data['price_to'])) {
                $units = $units->where('down_payment', '<=', $data['price_to']);
            }
        }

        if (isset($data['finishing_type']) && !is_null($data['finishing_type'])) {

            $units = $units->whereIn('i_finishing_type_id', $data['finishing_type']);
        }
        if (isset($data['area_from']) && !is_null($data['area_from'])) {
            $units = $units->where('area', '>=', $data['area_from']);
        }

        if (isset($data['area_to'])  && !is_null($data['area_to'])) {
            $units = $units->where('area', '<=', $data['area_to']);
        }

        if (isset($data['garden_area_from']) && !is_null($data['garden_area_from'])) {
            $units = $units->where('garden_area', '>=', $data['garden_area_from']);
        }

        if (isset($data['garden_area_to']) && !is_null($data['garden_area_to'])) {
            $units = $units->where('garden_area', '<=', $data['garden_area_to']);
        }
        if (isset($data['design_type']) && !is_null($data['design_type'])) {
            $design_type = $data['design_type'];
            $units = $units->whereHas('designType', function ($q) use ($design_type) {
                $q->whereHas('translations', function ($q) use ($design_type) {
                    $q->where('type', $design_type);
                });
            });
        }
        if (isset($data['plot_area_from']) && !is_null($data['plot_area_from'])) {
            $units = $units->where('plot_area', '>=', $data['plot_area_from']);
        }


        if (isset($data['plot_area_to']) && !is_null($data['plot_area_to'])) {
            $units = $units->where('plot_area', '<=', $data['plot_area_to']);
        }

        if (isset($data['build_up_area_from']) && !is_null($data['build_up_area_from'])) {
            $units = $units->where('build_up_area', '>=', $data['build_up_area_from']);
        }

        if (isset($data['build_up_area_to']) && !is_null($data['build_up_area_to'])) {
            $units = $units->where('build_up_area', '<=', $data['build_up_area_to']);
        }

        if (isset($data['must_have']) && !is_null($data['must_have'])) {
            $must_have = $data['must_have'];
            $units = $units->where(function ($query) use ($must_have) {
                $query->whereHas('facilities', function ($q) use ($must_have) {
                    $q->whereIn('i_facility_id', $must_have);
                })->orWhereHas('amenities', function ($q) use ($must_have) {
                    $q->whereIn('i_amenity_id', $must_have);
                });
            });
        }

        if (isset($data['not_have']) && !is_null($data['not_have'])) {
            $not_have = $data['not_have'];
            $units = $units->where(function ($query) use ($not_have) {
                $query->whereHas('facilities', function ($q) use ($not_have) {
                    $q->whereNotIn('i_facility_id', $not_have);
                })->orWhereHas('amenities', function ($q) use ($not_have) {
                    $q->whereNotIn('i_amenity_id', $not_have);
                });
            });
        }

        if (isset($data['location']) && !is_null($data['location'])) {
            $units = $units->where(function ($query) use ($data) {
                $query->where('country_id', $data['location'])
                    ->orwhere('region_id', $data['location'])
                    ->orwhere('city_id', $data['location'])
                    ->orwhere('area_id', $data['location']);
            });
        }
        if (isset($data['purpose_ids']) && !is_null($data['purpose_ids'])) {
            $units = $units->whereIn('i_purpose_id', $data['purpose_ids']);
        }
        if (isset($data['purpose_type']) && !is_null($data['purpose_type'])) {
            $units = $units->whereIn('i_purpose_type_id', $data['purpose_type']);
        }

        if (isset($data['developer']) && !is_null($data['developer'])) {
            $developers = $data['developer'];
            $units = $units->whereHas('project', function ($q) use ($developers) {
                $q = $q->whereIn('developer_id', $developers);
            });
        }

        if (isset($data['delivery_date_from']) && isset($data['delivery_date_to'])) {
            $delivery_date_from = $data['delivery_date_from'];
            $delivery_date_to = $data['delivery_date_to'];
            $units = $units->whereHas('project', function ($q) use ($delivery_date_from, $delivery_date_to) {
                $q = $q->whereBetween('delivery_date', [$delivery_date_from, $delivery_date_to]);
            });
        }

        return $units;
    }
}
