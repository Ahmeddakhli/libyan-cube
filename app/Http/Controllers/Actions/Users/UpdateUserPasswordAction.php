<?php

namespace App\Http\Controllers\Actions\Users;

use Hash;

class UpdateUserPasswordAction
{
    public function __construct()
    {
        //
    }

    public function execute(array $data)
    {
        // Get the user
        $user = auth()->user();

        // Check the old password is correct
        if (!Hash::check($data['old_password'], $user->password)) {
            return null;
        }

        // Encrypt the password
        $data['password'] = bcrypt($data['password']);

        // Update the user
        $user->update(['password' => $data['password']]);
        $user->save();

        return $user;
    }
}