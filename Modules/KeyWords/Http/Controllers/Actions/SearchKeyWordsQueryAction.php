<?php

namespace Modules\KeyWords\Http\Controllers\Actions;

use App\User;
use Modules\KeyWords\KeyWord;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SearchKeyWordsQueryAction
{
    public function execute(User $auth_user, Request $request)
    {
        // Get the key words
        $key_words = (new KeyWord)->newQuery();
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
                    $key_words = $key_words->where('created_at', '>=', $from)->where('created_at', '<=', $to);
                } elseif ($from) {
                    $key_words = $key_words->where('created_at', '>=', $from);
                } elseif ($to) {
                    $key_words = $key_words->where('created_at', '<=', $to);
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
                    $key_words = $key_words->where('updated_at', '>=', $from)->where('updated_at', '<=', $to);
                } elseif ($from) {
                    $key_words = $key_words->where('updated_at', '>=', $from);
                } elseif ($to) {
                    $key_words = $key_words->where('updated_at', '<=', $to);
                }
            } catch (\Exception $e) {
                //
            }
        }

        return $key_words;
    }
}
