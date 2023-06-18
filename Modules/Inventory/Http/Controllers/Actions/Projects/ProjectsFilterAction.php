<?php

namespace Modules\Inventory\Http\Controllers\Actions\Projects;

use Modules\Inventory\IProject;

class ProjectsFilterAction
{
    public function execute($data)
    {
        // Search project
        $projects = new IProject();

        if (isset($data['bedroom']) && !is_null($data['bedroom'])) {
            $bedrooms = $data['bedroom'];
            $projects = $projects->whereHas('units', function ($q) use ($bedrooms) {
                $q->whereIn('i_bedroom_id', $bedrooms);
            });
        }
        
        if (isset($data['purpose_ids']) && !is_null($data['purpose_ids'])) {
            $purpose_ids = $data['purpose_ids'];
            $projects = $projects->whereHas('units', function ($q) use ($purpose_ids) {
                $q->whereIn('i_purpose_id', $purpose_ids);
            });
        }

        if (isset($data['purpose_type']) && !is_null($data['purpose_type'])) {
            $purpose_types = $data['purpose_type'];
            $projects = $projects->whereHas('units', function ($q) use ($purpose_types) {
                $q->whereIn('i_purpose_type_id', $purpose_types);
            });
        }

        if (isset($data['developer']) && !is_null($data['developer'])) {
            $projects = $projects->whereIn('developer_id', $data['developer']);
        }

        if (isset($data['finishing_type']) && !is_null($data['finishing_type'])) {
            $finishing_types = $data['finishing_type'];
            $projects = $projects->whereHas('units', function ($q) use ($finishing_types) {
                $q->whereIn('i_finishing_type_id', $finishing_types);
            });
        }

        if (isset($data['search_type'])) {
            if (isset($data['search_type']) && $data['search_type'] == 'buy') {
                if (isset($data['offering_type']) && !is_null($data['offering_type'])) {
                    $offering_types = $data['offering_type'];
                    $projects = $projects->whereHas('units', function ($q) use ($offering_types) {
                        $q->whereIn('i_offering_type_id', $offering_types);
                    });
                }
            } else if (isset($data['search_type']) &&  $data['search_type'] == 'rent') {
                $projects = $projects->whereHas('units', function ($q) {
                    $q->whereHas('offeringType', function ($q) {
                        $q->whereHas('translations', function ($q) {
                            $q->where('offering_type', 'Rent');
                        });
                    });
                });
            }
        } else {
            if (isset($data['offering_type']) && !is_null($data['offering_type'])) {
                $offering_types = $data['offering_type'];
                $projects = $projects->whereHas('units', function ($q) use ($offering_types) {
                    $q->whereIn('i_offering_type_id', $offering_types);
                });
            }
        }


        if (isset($data['garden_area_from']) && !is_null($data['garden_area_from'])) {
            $garden_area_from = $data['garden_area_from'];
            $projects = $projects->whereHas('units', function ($q) use ($garden_area_from) {
                $q->where('garden_area', $garden_area_from);
            });
        }

        if (isset($data['garden_area_to']) && !is_null($data['garden_area_to'])) {
            $garden_area_to = $data['garden_area_to'];
            $projects = $projects->whereHas('units', function ($q) use ($garden_area_to) {
                $q->where('garden_area', $garden_area_to);
            });
        }

        if (isset($data['plot_area_from']) && !is_null($data['plot_area_from'])) {
            $plot_area_from = $data['plot_area_from'];
            $projects = $projects->whereHas('units', function ($q) use ($plot_area_from) {
                $q->where('plot_area', $plot_area_from);
            });
        }

        if (isset($data['plot_area_to']) && !is_null($data['plot_area_to'])) {
            $plot_area_to = $data['plot_area_to'];
            $projects = $projects->whereHas('units', function ($q) use ($plot_area_to) {
                $q->where('plot_area', $plot_area_to);
            });
        }

        if (isset($data['build_up_area_from']) && !is_null($data['build_up_area_from'])) {
            $build_up_area_from = $data['build_up_area_from'];
            $projects = $projects->whereHas('units', function ($q) use ($build_up_area_from) {
                $q->where('build_up_area', $build_up_area_from);
            });
        }

        if (isset($data['build_up_area_to']) && !is_null($data['build_up_area_to'])) {
            $build_up_area_to = $data['build_up_area_to'];
            $projects = $projects->whereHas('units', function ($q) use ($build_up_area_to) {
                $q->where('build_up_area', $build_up_area_to);
            });
        }

        if (isset($data['area_from']) && !is_null($data['area_from'])) {
            $projects = $projects->where('area_from', '>=', $data['area_from']);
        }

        if (isset($data['area_to']) && !is_null($data['area_to'])) {
            $projects = $projects->where('area_to', '<=', $data['area_to']);
        }

        if (isset($data['delivery_date_from']) && isset($data['delivery_date_from'])) {
            $delivery_date_from = $data['delivery_date_from'];
            $delivery_date_to = $data['delivery_date_to'];
            $projects = $projects->whereBetween('delivery_date', [$data['delivery_date_from'], $data['delivery_date_to']]);
        }

        if (isset($data['budget_type']) && $data['budget_type'] == 'total_unit_price') {
            if (isset($data['price_from']) && !is_null($data['price_from'])) {
                $projects = $projects->where('price_from', '>=', $data['price_from']);
            }
            if (isset($data['price_to']) && !is_null($data['price_to'])) {
                $projects = $projects->where('price_to', '<=', $data['price_to']);
            }
        } else {
            if (isset($data['price_from']) && !is_null($data['price_from'])) {
                $projects = $projects->where('down_payment_from', '>=', $data['price_from']);
            }
            if (isset($data['price_to']) && !is_null($data['price_to'])) {
                $projects = $projects->where('down_payment_to', '<=', $data['price_to']);
            }
        }

        if (isset($data['must_have']) && !is_null($data['must_have'])) {
            $must_have = $data['must_have'];
            $projects = $projects->where(function ($query) use ($must_have) {
                $query->whereHas('facilities', function ($q) use ($must_have) {
                    $q->whereIn('i_facility_id', $must_have);
                })->orWhereHas('amenities', function ($q) use ($must_have) {
                    $q->whereIn('i_amenity_id', $must_have);
                });
            });
        }

        if (isset($data['not_have']) && !is_null($data['not_have'])) {
            $not_have = $data['not_have'];
            $projects = $projects->where(function ($query) use ($not_have) {
                $query->whereHas('facilities', function ($q) use ($not_have) {
                    $q->whereNotIn('i_facility_id', $not_have);
                })->orWhereHas('amenities', function ($q) use ($not_have) {
                    $q->whereNotIn('i_amenity_id', $not_have);
                });
            });
        }

        if (isset($data['location']) && !is_null($data['location'])) {
            $projects = $projects->where(function ($query) use ($data) {
                $query->where('country_id', $data['location'])
                    ->orwhere('region_id', $data['location'])
                    ->orwhere('city_id', $data['location'])
                    ->orwhere('area_id', $data['location']);
            });
        }
        return $projects;
    }
}
