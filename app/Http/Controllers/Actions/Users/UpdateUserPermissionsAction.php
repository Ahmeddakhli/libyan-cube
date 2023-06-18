<?php

namespace App\Http\Controllers\Actions\Users;

use App\User;
use App\Models\Group;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Models\Permission;
use App\Models\UserPermission;

class UpdateUserPermissionsAction
{
    public function __construct()
    {
        //
    }

    public function execute(User $auth_user, $id, array $permissions) : User
    {
        // Get the user
        $user = User::find($id);

        // Check that permissions exist in the user group permissions
        $user_group_permissions = $user->group->permissions->pluck('id')->toArray();
        $errors = array();
        foreach ($permissions as $permission) {
            if (!in_array($permission, $user_group_permissions)) {
                array_push($errors, ['field' => 'permissions', 'message' => 'Permission '.$permission.' does not exist in the user group']);
            }
        }
        if (count($errors)) {
             throw new HttpResponseException(response()->json(['errors' => $errors
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
        }

        $user->permissions()->sync([]);
        $user->permissions()->attach($permissions);
        $user->save();

        // Append permissions parents
        foreach ($permissions as $permission) {
            $permission = Permission::find($permission)->parent_id;
            $user_permissions = $user->permissions->pluck('id')->toArray();
            if ($permission && !UserPermission::where('user_id', $user->id)->where('permission_id', $permission)->first()) {
                $user->permissions()->attach($permission);
            }
        }

        $user = User::find($id); // To unload the permissions relation

        // Log instance
        $activity = activity('user_permissions_log')
            ->performedOn($user)
            ->causedBy($auth_user)
            ->log(':causer.username updated the permissions of :subject.username');

        return $user;
    }
}