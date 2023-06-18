<?php

namespace Modules\Inventory\Http\Controllers\Actions\Projects;

use App\User;
use Modules\Inventory\IProject;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SearchIProjectsQueryAction
{
    public function execute(User $auth_user, Request $request)
    {
        // Get the  Projects
        $i_projects = (new IProject)->newQuery();

        if ($request->input('project')) {
            $project = $request->input('project');
            $i_projects = $i_projects->whereHas('translations', function($translation) use ($project) {
                $translation->where('project', 'like', '%'.$project.'%');
            });
        }

        if ($request->input('developer_ids')) {
            $i_projects = $i_projects->whereIn('developer_id', explode(',', $request->input('developer_ids')));
        }

        if ($request->input('area_from')) {
            $i_projects = $i_projects->where('area_from', '>=', $request->input('area_from'));
        }

        if ($request->input('area_to')) {
            $i_projects = $i_projects->where('area_to', '<=', $request->input('area_to'));
        }

        if ($request->input('country_ids')) {
            $i_projects = $i_projects->whereIn('country_id', $request->input('country_ids'));
        }

        if ($request->input('region_ids')) {
            $iuints = $i_projects->whereIn('region_id', $request->input('region_ids'));
        }

        if ($request->input('city_ids')) {
            $i_projects = $i_projects->whereIn('city_id', $request->input('city_ids'));
        }

        if ($request->input('area_ids')) {
            $i_projects = $i_projects->whereIn('area_id', $request->input('area_ids'));
        }

        if ($request->input('price_from')) {
            $i_projects = $i_projects->where('price_from', '>=', $request->input('price_from'));
        }

        if ($request->input('price_to')) {
            $i_projects = $i_projects->where('price_to', '<=', $request->input('price_to'));
        }

        if ($request->input('down_payment_from')) {
            $i_projects = $i_projects->where('down_payment_from', '>=', $request->input('down_payment_from'));
        }

        if ($request->input('down_payment_to')) {
            $i_projects = $i_projects->where('down_payment_to', '<=', $request->input('down_payment_to'));
        }

        if ($request->input('number_of_installments_from')) {
            $i_projects = $i_projects->where('number_of_installments_from', '>=', $request->input('number_of_installments_from'));
        }

        if ($request->input('number_of_installments_to')) {
            $i_projects = $i_projects->where('number_of_installments_to', '<=', $request->input('number_of_installments_to'));
        }

        if ($request->input('currency_codes')) {
            $i_projects = $i_projects->whereIn('currency_code', $request->input('currency_codes'));
        }

        if ($request->input('i_area_unit_ids')) {
            $i_projects = $i_projects->whereIn('i_area_unit_id', $request->input('i_area_unit_ids'));
        }

        if ($request->input('delivery_date_range')) {
            try {
                $dates = explode(' / ', $request->input('delivery_date_range'));
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
                    $i_projects = $i_projects->where('delivery_date', '>=', $from)->where('delivery_date', '<=', $to);
                } elseif ($from) {
                    $i_projects = $i_projects->where('delivery_date', '>=', $from);
                } elseif ($to) {
                    $i_projects = $i_projects->where('delivery_date', '<=', $to);
                }
            } catch (\Exception $e) {
                //
            }
        }

        if($request->input('is_featured') && $request->input('is_featured') === 'on') {
            $i_projects = $i_projects->where('is_featured', 1);
        }
        
        if($request->input('in_discover_by') && $request->input('in_discover_by') === 'on') {
            $i_projects = $i_projects->where('in_discover_by', 1);
        }

        if($request->input('is_published') && $request->input('is_published') === 'on') {
            $i_projects = $i_projects->where('is_published', 1);
        }

        if($request->input('is_finished') && $request->input('is_finished') === 'on') {
            $i_projects = $i_projects->where('finished_status', 1);
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
                    $i_projects = $i_projects->where('created_at', '>=', $from)->where('created_at', '<=', $to);
                } elseif ($from) {
                    $i_projects = $i_projects->where('created_at', '>=', $from);
                } elseif ($to) {
                    $i_projects = $i_projects->where('created_at', '<=', $to);
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
                    $i_projects = $i_projects->where('updated_at', '>=', $from)->where('updated_at', '<=', $to);
                } elseif ($from) {
                    $i_projects = $i_projects->where('updated_at', '>=', $from);
                } elseif ($to) {
                    $i_projects = $i_projects->where('updated_at', '<=', $to);
                }
            } catch (\Exception $e) {
                //
            }
        }
        return $i_projects;
    }
}
