<?php

namespace App\Http\Controllers\Actions\Groups;

use App\Models\Group;
use App\User;

class CreateGroupAction
{
    public function __construct()
    {
        //
    }

    public function execute(array $data, $permissions_group_id = null, $users = []) : Group
    {
        $data['slug'] = str_slug($data['name']);

        // Create the group
        $group = Group::create($data);

        // Copying the permissions
        if ($permissions_group_id) {
            $permissions_group = Group::find($permissions_group_id);
            if ($permissions_group) {
                // Copying group permissions
                $group->permissions()->attach($permissions_group->permissions);
            }
        }

        // Update users group_id
        if (!$users)  {
            $users = array();
        }
        $users = User::whereIn('id', $users)->get();
        foreach ($users as $user) {
            $user->group_id = $group->id;
            $user->save();

            // Update user permissions
            $user->permissions()->sync([]);
            $user->permissions()->attach($group->permissions);
            $user->save();
        }

        $group = Group::find($group->id); // To unload the permissions relation

        return $group;
    }
}
