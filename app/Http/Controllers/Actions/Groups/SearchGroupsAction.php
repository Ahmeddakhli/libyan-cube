<?php

namespace App\Http\Controllers\Actions\Groups;

use App\Models\Group;
use Cache;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SearchGroupsAction
{
    public function __construct()
    {
        //
    }

    public function execute(User $user, Request $request)
    {
        // Get auth user groups
        $auth_user_group = Group::find($user->group_id);
        // $groups = $auth_user_group->getChildren();
        $groups = new  Group;

        if ($request->input('id')) {
            // $groups = $groups->filter(function($group) use ($request) {
            //     return $group->id == $request->input('id');
            // });
            // return $groups;
            $groups = $groups->where('id', $request->input('id'));
            return $groups;
        }

        if ($request->input('group_name')) {
            // $groups = $groups->filter(function($group) use ($request) {
            //     return $group->name == $request->input('group_name');
            // });
            $groups = $groups->where('name', 'like', '%'.$request->input('group_name').'%');
        }

        if ($request->input('parent_group_name')) {
            // $groups = $groups->filter(function($group) use ($request) {
            //     return $group->parent->name == $request->input('parent_group_name');
            // });
            $groups = $groups->whereHas('parent', function($parent) use ($request) {
                $parent->where('name', 'like', '%'.$request->input('parent_group_name').'%');
            });
        }

        if ($request->input('users')) {
            // $groups = $groups->filter(function($group) use ($request) {
            //     $group_users_ids = $group->users->pluck('id')->toArray();
            //     $search_users_ids = $request->input('users');
            //     foreach ($search_users_ids as $id) {
            //         if (in_array($id, $group_users_ids)) {
            //             return true;
            //         }
            //     }
            //     return false;
            // });
            $groups = $groups->whereHas('users', function($user) use ($request) {
                $user->whereIn('id', $request->input('users'));
            });
        }

        if ($request->input('parent_groups')) {
            $groups = $groups->whereIn('parent_id', $request->input('parent_groups'));
        }

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
                    $groups = $groups->where('created_at', '>=', $from)->where('created_at', '<=', $to);
                } elseif ($from) {
                    $groups = $groups->where('created_at', '>=', $from);
                } elseif ($to) {
                    $groups = $groups->where('created_at', '<=', $to);
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
                    $groups = $groups->where('updated_at', '>=', $from)->where('updated_at', '<=', $to);
                } elseif ($from) {
                    $groups = $groups->where('updated_at', '>=', $from);
                } elseif ($to) {
                    $groups = $groups->where('updated_at', '<=', $to);
                }
            } catch (\Exception $e) {
                //
            }
        }

        // foreach ($groups as $group) {
        //     $group->load('parent');
        // }
        $groups = $groups->with('parent');

        return $groups;
    }
}