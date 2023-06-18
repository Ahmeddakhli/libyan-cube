<?php

namespace Modules\Inventory\Http\Controllers\Actions\Units;

use App\User;
use Modules\Inventory\IUnit;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SearchIUnitsQueryAction
{
    public function execute(User $auth_user, Request $request)
    {
        // Get the units
        $i_units = (new IUnit)->newQuery();

        if ($request->input('i_project_ids')) {
            $i_units = $i_units->whereIn('i_project_id', explode(',', $request->input('i_project_ids')));
        }

        if ($request->input('seller_ids')) {
            $i_units = $i_units->whereIn('seller_id', explode(',', $request->input('seller_ids')));
        }

        if ($request->input('i_position_ids')) {
            $i_units = $i_units->whereIn('i_position_id', $request->input('i_position_ids'));
        }

        if ($request->input('i_view_ids')) {
            $i_units = $i_units->whereIn('i_view_id', $request->input('i_view_ids'));
        }

        if ($request->input('area_from')) {
            $i_units = $i_units->where('area', '>=', $request->input('area_from'));
        }

        if ($request->input('area_to')) {
            $i_units = $i_units->where('area', '<=', $request->input('area_to'));
        }

        if ($request->input('garden_area_from')) {
            $i_units = $i_units->where('garden_area', '>=', $request->input('garden_area_from'));
        }

        if ($request->input('garden_area_to')) {
            $i_units = $i_units->where('garden_area', '<=', $request->input('garden_area_to'));
        }

        if ($request->input('plot_area_from')) {
            $i_units = $i_units->where('plot_area', '>=', $request->input('plot_area_from'));
        }

        if ($request->input('plot_area_to')) {
            $i_units = $i_units->where('plot_area', '<=', $request->input('plot_area_to'));
        }

        if ($request->input('build_up_area_from')) {
            $i_units = $i_units->where('build_up_area', '>=', $request->input('build_up_area_from'));
        }

        if ($request->input('build_up_area_to')) {
            $i_units = $i_units->where('build_up_area', '<=', $request->input('build_up_area_to'));
        }

        if ($request->input('i_bedroom_ids')) {
            $i_units = $i_units->whereIn('i_bedroom_id', $request->input('i_bedroom_ids'));
        }

        if ($request->input('i_bathroom_ids')) {
            $i_units = $i_units->whereIn('i_bathroom_id', $request->input('i_bathroom_ids'));
        }

        if ($request->input('i_floor_number_ids')) {
            $i_units = $i_units->whereIn('i_floor_number_id', $request->input('i_floor_number_ids'));
        }

        if ($request->input('i_purpose_ids')) {
            $i_units = $i_units->whereIn('i_purpose_id', $request->input('i_purpose_ids'));
        }

        if ($request->input('i_purpose_type_ids')) {
            $i_units = $i_units->whereIn('i_purpose_type_id', $request->input('i_purpose_type_ids'));
        }

        if ($request->input('country_ids')) {
            $i_units = $i_units->whereIn('country_id', $request->input('country_ids'));
        }

        if ($request->input('region_ids')) {
            $iuints = $i_units->whereIn('region_id', $request->input('region_ids'));
        }

        if ($request->input('city_ids')) {
            $i_units = $i_units->whereIn('city_id', $request->input('city_ids'));
        }

        if ($request->input('area_ids')) {
            $i_units = $i_units->whereIn('area_id', $request->input('area_ids'));
        }

        if ($request->input('i_offering_type_ids')) {
            $i_units = $i_units->whereIn('i_offering_type_id', $request->input('i_offering_type_ids'));
        }

        if ($request->input('i_design_type_ids')) {
            $i_units = $i_units->whereIn('i_design_type_id', $request->input('i_design_type_ids'));
        }

        if ($request->input('price_from')) {
            $i_units = $i_units->where('price', '>=', $request->input('price_from'));
        }

        if ($request->input('price_to')) {
            $i_units = $i_units->where('price', '<=', $request->input('price_to'));
        }

        if ($request->input('i_payment_method_ids')) {
            $i_units = $i_units->whereIn('i_payment_method_id', $request->input('i_payment_method_ids'));
        }

        if ($request->input('buyer_ids')) {
            $i_units = $i_units->whereIn('buyer_id', explode(',', $request->input('buyer_ids')));
        }

        if ($request->input('down_payment_from')) {
            $i_units = $i_units->where('down_payment', '>=', $request->input('down_payment_from'));
        }

        if ($request->input('down_payment_to')) {
            $i_units = $i_units->where('down_payment', '<=', $request->input('down_payment_to'));
        }

        if ($request->input('number_of_installments_from')) {
            $i_units = $i_units->where('number_of_installments', '>=', $request->input('number_of_installments_from'));
        }

        if ($request->input('number_of_installments_to')) {
            $i_units = $i_units->where('number_of_installments', '<=', $request->input('number_of_installments_to'));
        }

        if ($request->input('currency_codes')) {
            $i_units = $i_units->whereIn('currency_code', $request->input('currency_codes'));
        }

        if ($request->input('i_area_unit_ids')) {
            $i_units = $i_units->whereIn('i_area_unit_id', $request->input('i_area_unit_ids'));
        }

        if ($request->input('i_garden_area_unit_ids')) {
            $i_units = $i_units->whereIn('i_garden_area_unit_id', $request->input('i_garden_area_unit_ids'));
        }

        if ($request->input('i_furnishing_status_ids')) {
            $i_units = $i_units->whereIn('i_furnishing_status_id', $request->input('i_furnishing_status_ids'));
        }

        if ($request->input('i_finishing_type_ids')) {
            $i_units = $i_units->whereIn('i_finishing_type_id', $request->input('i_finishing_type_ids'));
        }

        if ($request->input('creators')) {
            $i_units = $i_units->whereIn('created_by', $request->input('creators'));
        }

        if ($request->input('building_numbers') && count(explode(',', $request->input('building_numbers')))) {
            $i_units = $i_units->whereIn('building_number', explode(',', $request->input('building_numbers')));
        }

        if($request->input('is_featured') && $request->input('is_featured') === 'on') {
            $i_units = $i_units->where('is_featured', 1);
        }

        if($request->input('is_active') && $request->input('is_active') === 'on') {
            $i_units = $i_units->where('is_active', 1);
        }

        if ($request->input('availability')) {
            switch ($request->input('availability')) {
                // Available
                case '1':
                    $i_units = $i_units->whereDoesntHave('buyer')->whereDoesntHave('rentalCases', function ($rental_case) {
                        $rental_case->whereDate('from', '>=', Carbon::now(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->timezone('UTC')->toDateString())->whereDate('to', '<=', Carbon::now(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->timezone('UTC')->toDateString());
                    })->whereDoesntHave('rentalCases', function ($rental_case) {
                        $rental_case->whereNull('to');
                    });
                    break;
                // Rented
                case '2':
                    $i_units = $i_units->whereDoesntHave('buyer')->where(function ($query) {
                        $query->whereHas('rentalCases', function ($rental_case) {
                            $rental_case->whereDate('from', '>=', Carbon::now(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->timezone('UTC')->toDateString())->orWhereDate('to', '<=', Carbon::now(auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->timezone('UTC')->toDateString());
                        })->orWhereHas('rentalCases', function ($rental_case) {
                            $rental_case->whereNull('to');
                        });
                    });
                    break;
                // Sold
                case '3':
                    $i_units = $i_units->whereHas('buyer');
                    break;
            }
        }

        if ($request->input('created_at_range')) {
            try {
                $dates = explode(' / ', $request->input('created_at_range'));
                if (isset($dates[0]) && $dates[0]) {
                    try {
                        $from = Carbon::createFromFormat('Y-m-d', $dates[0])->format('Y-m-d') . ' 00:00:00';
                        $from = Carbon::createFromFormat('Y-m-d H:i:s', $from, auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->timezone('UTC')->toDateTimeString();
                    } catch (Exception $e) {
                        $from = null;
                    }
                } else {
                    $from = null;
                }
                if (isset($dates[1]) && $dates[1]) {
                    try {
                        $to = Carbon::createFromFormat('Y-m-d', $dates[1])->format('Y-m-d') . ' 23:59:59';
                        $to = Carbon::createFromFormat('Y-m-d H:i:s', $to, auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->timezone('UTC')->toDateTimeString();
                    } catch (Exception $e) {
                        $to = null;
                    }
                } else {
                    $to = null;
                }

                if ($from && $to) {
                    $i_units = $i_units->where('created_at', '>=', $from)->where('created_at', '<=', $to);
                } elseif ($from) {
                    $i_units = $i_units->where('created_at', '>=', $from);
                } elseif ($to) {
                    $i_units = $i_units->where('created_at', '<=', $to);
                }
            } catch (\Exception $e) {
                //
            }
        }

        if ($request->input('last_updated_at_range')) {
            try {
                $dates = explode(' / ', $request->input('last_updated_at_range'));
                if (isset($dates[0]) && $dates[0]) {
                    try {
                        $from = Carbon::createFromFormat('Y-m-d', $dates[0])->format('Y-m-d') . ' 00:00:00';
                        $from = Carbon::createFromFormat('Y-m-d H:i:s', $from, auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->timezone('UTC')->toDateTimeString();
                    } catch (Exception $e) {
                        $from = null;
                    }
                } else {
                    $from = null;
                }
                if (isset($dates[1]) && $dates[1]) {
                    try {
                        $to = Carbon::createFromFormat('Y-m-d', $dates[1])->format('Y-m-d') . ' 23:59:59';
                        $to = Carbon::createFromFormat('Y-m-d H:i:s', $to, auth()->user() ? auth()->user()->timezone : 'Africa/Cairo')->timezone('UTC')->toDateTimeString();
                    } catch (Exception $e) {
                        $to = null;
                    }
                } else {
                    $to = null;
                }

                if ($from && $to) {
                    $i_units = $i_units->where('updated_at', '>=', $from)->where('updated_at', '<=', $to);
                } elseif ($from) {
                    $i_units = $i_units->where('updated_at', '>=', $from);
                } elseif ($to) {
                    $i_units = $i_units->where('updated_at', '<=', $to);
                }
            } catch (\Exception $e) {
                //
            }
        }
        
        return $i_units;
    }
}
