<?php

namespace App\Http\Controllers\Actions\Users;

use App\Models\Group;
use Cache;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SearchUsersAction
{
    public function __construct()
    {
        //
    }

    public function execute(User $user, Request $request, $suspended = false)
    {
        // Get auth user users
        // $users = $user->getChildren();
        if ($suspended) {
            $users = new User;
        } else {
            $users = User::notSuspended();
        }

        if ($request->input('id')) {
            // $users = $users->filter(function($user) use ($request) {
            //     return $user->id == $request->input('id');
            // });
            // return $users;
            $users = $users->where('id', $request->input('id'));
            return $users;
        }

        if ($request->input('username')) {
            // $users = $users->filter(function($user) use ($request) {
            //     return strpos($user->username, $request->input('username')) !== false;
            // });
            $users = $users->where('username', 'like', '%'.$request->input('username').'%');
        }

        if ($request->input('full_name')) {
            // $users = $users->filter(function($user) use ($request) {
            //     return strpos($user->full_name, $request->input('full_name')) !== false;
            // });
            $users = $users->where('full_name', 'like', '%'.$request->input('full_name').'%');
        }

        if ($request->input('email')) {
            // $users = $users->filter(function($user) use ($request) {
            //     return strpos($user->email, $request->input('email')) !== false;
            // });
            $users = $users->where('email', 'like', '%'.$request->input('email').'%');
        }

        if ($request->input('mobile_number')) {
            // $users = $users->filter(function($user) use ($request) {
            //     return strpos($user->mobile_number, $request->input('mobile_number')) !== false;
            // });
            $users = $users->where('mobile_number', 'like', '%'.$request->input('mobile_number').'%');
        }

        if ($request->input('groups')) {
            // $users = $users->filter(function($user) use ($request) {
            //     return in_array($user->group_id, $request->input('groups'));
            // });
            $users = $users->whereIn('group_id', $request->input('groups'));
        }

        if ($request->input('users')) {
            // $users = $users->filter(function($user) use ($request) {
            //     return in_array($user->id, $request->input('users'));
            // });
            $users = $users->whereIn('id', $request->input('users'));
        }

        if ($request->input('connectivity_status')) {
            // $users = $users->filter(function($user) use ($request) {
            //     if ($request->input('connectivity_status') == 1) {
            //         return $user->connection_id;
            //     } elseif ($request->input('connectivity_status') == 2) {
            //         return !$user->connection_id;
            //     }
            // });
            if ($request->input('connectivity_status') == 1) {
                $users = $users->whereNotNull('connection_id');
            } elseif ($request->input('connectivity_status') == 2) {
                $users = $users->whereNull('connection_id');
            }
        }

        if ($request->input('connectivity_statuses')) {
            if (count($request->input('connectivity_statuses')) && count($request->input('connectivity_statuses')) == 1) {
                foreach ($request->input('connectivity_statuses') as $connectivity_status) {
                    if ($connectivity_status == 1) {
                        $users = $users->whereNotNull('connection_id');
                    } elseif ($connectivity_status == 2) {
                        $users = $users->whereNull('connection_id');
                    }
                }
            }
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
                    $users = $users->where('created_at', '>=', $from)->where('created_at', '<=', $to);
                } elseif ($from) {
                    $users = $users->where('created_at', '>=', $from);
                } elseif ($to) {
                    $users = $users->where('created_at', '<=', $to);
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
                    $users = $users->where('updated_at', '>=', $from)->where('updated_at', '<=', $to);
                } elseif ($from) {
                    $users = $users->where('updated_at', '>=', $from);
                } elseif ($to) {
                    $users = $users->where('updated_at', '<=', $to);
                }
            } catch (\Exception $e) {
                //
            }
        }

        $users = $users->with('group');

        // foreach ($users as $user) {
        //     $user->load('group');
        // }

        return $users;
    }
}
