<?php

namespace Modules\Inventory\Http\Controllers\Actions\RentalCases;

use App\User;
use Modules\Inventory\IRentalCase;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SearchIRentalCasesQueryAction
{
    public function execute(User $auth_user, Request $request)
    {
        // Get the i_rental_cases
        $i_rental_cases = (new IRentalCase)->newQuery();

        if ($request->input('i_unit_ids')) {
            $i_rental_cases = $i_rental_cases->whereIn('i_unit_id', $request->input('i_unit_ids'));
        }

        if ($request->input('renter_ids')) {
            $i_rental_cases = $i_rental_cases->whereIn('renter_id', explode(', ', $request->input('renter_ids')));
        }

        if ($request->input('rented_from')) {
            $i_rental_cases = $i_rental_cases->where('from', '>=', $request->input('rented_from'));
        }

        if ($request->input('rented_to')) {
            $i_rental_cases = $i_rental_cases->where('to', '<=', $request->input('rented_to'));
        }

        if ($request->input('price_from')) {
            $i_rental_cases = $i_rental_cases->where('price', '>=', $request->input('price_from'));
        }

        if ($request->input('price_to')) {
            $i_rental_cases = $i_rental_cases->where('price', '<=', $request->input('price_to'));
        }

        if ($request->input('creators')) {
            $i_rental_cases = $i_rental_cases->whereIn('created_by', $request->input('creators'));
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
                    $i_rental_cases = $i_rental_cases->where('created_at', '>=', $from)->where('created_at', '<=', $to);
                } elseif ($from) {
                    $i_rental_cases = $i_rental_cases->where('created_at', '>=', $from);
                } elseif ($to) {
                    $i_rental_cases = $i_rental_cases->where('created_at', '<=', $to);
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
                    $i_rental_cases = $i_rental_cases->where('updated_at', '>=', $from)->where('updated_at', '<=', $to);
                } elseif ($from) {
                    $i_rental_cases = $i_rental_cases->where('updated_at', '>=', $from);
                } elseif ($to) {
                    $i_rental_cases = $i_rental_cases->where('updated_at', '<=', $to);
                }
            } catch (\Exception $e) {
                //
            }
        }

        return $i_rental_cases;
    }
}
