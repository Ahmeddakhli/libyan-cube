<?php

namespace App\Http\Controllers\Actions\Users;

use App\Models\Group;
use Cache;
use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;

class GetUserByIdAction
{
    public function __construct()
    {
        //
    }

    public function execute(User $user, $id)
    {
        // Get auth user users
        // $users = $user->getChildren();
        $users = new User;

        // $user = $users->filter(function($user) use ($id) {
        //     return $user->id == $id;
        // })->first();

        $user = $users->where('id', $id)->first();

        return $user ? new UserResource($user) : null;
    }
}
