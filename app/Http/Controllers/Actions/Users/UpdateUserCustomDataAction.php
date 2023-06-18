<?php

namespace App\Http\Controllers\Actions\Users;

use App\User;
use App\Models\Group;
use File, Config;
use App\Http\Helpers\Utilities;
use App\Http\Resources\UserResource;

class UpdateUserCustomDataAction
{
    public function __construct()
    {
        //
    }

    public function execute($id, array $data) : UserResource
    {
        // Get the user
        $user = User::find($id);

        // Check the update type
        if ($data['update_type'] == 'image') {
            // Store the new image
            $data['update_value'] = Utilities::storeFile($data['update_value'], 'storage/profile_images', Config::get('constants.default_image'));

            // If the image uploaded successfully
            if ($data['update_value'] != Config::get('constants.default_image')) {
                // Delete the old image
                File::delete(url('/').'/'.$user->image);
            } else {
                $data['update_value'] = $user->image;
            }
            // Update the user custom data
            $user->{$data['update_type']} = $data['update_value'];
            $user->save();
        } elseif ($data['update_type'] == 'permissions_user_id') {
            // Update permissions from the permissions user
            $permissions_user = User::find($data['update_value']);
            $user->permissions()->sync([]);
            $user->permissions()->attach($permissions_user->permissions);
            $user->save();
        } else { 
            // Update the user custom data
            $user->{$data['update_type']} = $data['update_value'];
            $user->save();
        }


        // Transform the result
        $user = new UserResource($user);

        // Return the response
        return $user;
    }
}