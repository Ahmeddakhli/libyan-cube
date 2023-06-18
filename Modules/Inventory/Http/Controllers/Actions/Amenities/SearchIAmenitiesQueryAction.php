<?php

namespace Modules\Inventory\Http\Controllers\Actions\Amenities;

use App\User;
use Modules\Inventory\IAmenity;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SearchIAmenitiesQueryAction
{
    public function execute(User $auth_user, Request $request)
    {
        // Get the i_amenities
        $i_amenities = (new IAmenity)->newQuery();

        if ($request->input('id')) {
            $i_amenities = $i_amenities->where('id', $request->input('id'));
            return $i_amenities;
        }

        if ($request->input('amenity')) {
            $amenity = $request->input('amenity');
            $i_amenities = $i_amenities->whereHas('translations', function ($translation) use ($amenity) {
                $translation->where('amenity', 'LIKE', '%' . $amenity . '%');
            });
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
                    $i_amenities = $i_amenities->where('created_at', '>=', $from)->where('created_at', '<=', $to);
                } elseif ($from) {
                    $i_amenities = $i_amenities->where('created_at', '>=', $from);
                } elseif ($to) {
                    $i_amenities = $i_amenities->where('created_at', '<=', $to);
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
                    $i_amenities = $i_amenities->where('updated_at', '>=', $from)->where('updated_at', '<=', $to);
                } elseif ($from) {
                    $i_amenities = $i_amenities->where('updated_at', '>=', $from);
                } elseif ($to) {
                    $i_amenities = $i_amenities->where('updated_at', '<=', $to);
                }
            } catch (\Exception $e) {
                //
            }
        }

        return $i_amenities;
    }
}
