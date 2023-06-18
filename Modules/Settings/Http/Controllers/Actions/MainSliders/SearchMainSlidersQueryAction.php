<?php

namespace Modules\Settings\Http\Controllers\Actions\MainSliders;

use App\User;
use Modules\Settings\MainSlider;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;

class SearchMainSlidersQueryAction
{
    public function execute(User $auth_user, Request $request)
    {
        // Search main slider
        $main_sliders = (new MainSlider)->newQuery();

        if ($request->input('created_at_range')) {
            try {
                $dates = explode(' / ', $request->input('created_at_range'));
                if (isset($dates[0]) && $dates[0]) {
                    try {
                        $from = Carbon::createFromFormat('Y-m-d', $dates[0])->format('Y-m-d').' 00:00:00';
                        $from = Carbon::createFromFormat('Y-m-d H:i:s', $from, auth()->user()?auth()->user()->timezone:'Africa/Cairo')->timezone('UTC')->toDateTimeString();
                    } catch (Exception $e) {
                        $from = null;
                    }
                } else {
                    $from = null;
                }
                if (isset($dates[1]) && $dates[1]) {
                    try {
                        $to = Carbon::createFromFormat('Y-m-d', $dates[1])->format('Y-m-d').' 23:59:59';
                        $to = Carbon::createFromFormat('Y-m-d H:i:s', $to, auth()->user()?auth()->user()->timezone:'Africa/Cairo')->timezone('UTC')->toDateTimeString();
                    } catch (Exception $e) {
                        $to = null;
                    }
                } else {
                    $to = null;
                }

                if ($from && $to) {
                    $main_sliders = $main_sliders->where('created_at', '>=', $from)->where('created_at', '<=', $to);
                } elseif ($from) {
                    $main_sliders = $main_sliders->where('created_at', '>=', $from);
                } elseif ($to) {
                    $main_sliders = $main_sliders->where('created_at', '<=', $to);
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
                        $from = Carbon::createFromFormat('Y-m-d', $dates[0])->format('Y-m-d').' 00:00:00';
                        $from = Carbon::createFromFormat('Y-m-d H:i:s', $from, auth()->user()?auth()->user()->timezone:'Africa/Cairo')->timezone('UTC')->toDateTimeString();
                    } catch (Exception $e) {
                        $from = null;
                    }
                } else {
                    $from = null;
                }
                if (isset($dates[1]) && $dates[1]) {
                    try {
                        $to = Carbon::createFromFormat('Y-m-d', $dates[1])->format('Y-m-d').' 23:59:59';
                        $to = Carbon::createFromFormat('Y-m-d H:i:s', $to, auth()->user()?auth()->user()->timezone:'Africa/Cairo')->timezone('UTC')->toDateTimeString();
                    } catch (Exception $e) {
                        $to = null;
                    }
                } else {
                    $to = null;
                }

                if ($from && $to) {
                    $main_sliders = $main_sliders->where('updated_at', '>=', $from)->where('updated_at', '<=', $to);
                } elseif ($from) {
                    $main_sliders = $main_sliders->where('updated_at', '>=', $from);
                } elseif ($to) {
                    $main_sliders = $main_sliders->where('updated_at', '<=', $to);
                }
            } catch (\Exception $e) {
                //
            }
        }
        return $main_sliders;
    }
}