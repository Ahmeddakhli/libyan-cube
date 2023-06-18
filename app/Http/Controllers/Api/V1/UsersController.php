<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Http\Requests\Users\UpdateUserPermissionsRequest;
use App\Http\Requests\Users\DeleteUserRequest;
use App\Http\Requests\Users\GetUserByIdRequest;
use App\Http\Requests\Users\UpdateUserCustomDataRequest;
use App\Http\Requests\Users\UpdateUserPasswordRequest;
use App\Http\Controllers\Actions\Users\UpdateUserAction;
use App\Http\Controllers\Actions\Users\UpdateUserCustomDataAction;
use App\Http\Controllers\Actions\Users\UpdateUserPermissionsAction;
use App\Http\Controllers\Actions\Users\DeleteUserAction;
use App\Http\Controllers\Actions\Users\AllUsersAction;
use App\Http\Controllers\Actions\Users\GetUserByIdAction;
use App\Http\Controllers\Actions\Users\UpdateUserPasswordAction;
use App\Http\Resources\UserResource;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth;
use App\User;

class UsersController extends Controller
{
    /**
     * Update user
     *
     * @param  [integer] id
     * @param  [integer] group_id
     * @param  [string] full_name
     * @param  [file] image
     * @param  [string] username
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @param  [string] mobile_number
     * @param  [integer] permissions_user_id
     * @return [json] ServiceResponse object
     */
    public function update(UpdateUserRequest $request, UpdateUserAction $action)
    {
        // Update the user
        $user = $action->execute($request->input('id'), $request->except(['id', 'permissions_user_id']), $request->input('permissions_user_id'));

        // Transform the user
        $user = json_decode(json_encode(new UserResource($user)));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'User updated successfully';
        $resp->status = true;
        $resp->data = $user;
        return response()->json($resp, 200);
    }

    /**
     * Delete user
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function delete(DeleteUserRequest $request, DeleteUserAction $action)
    {
        // Delete the user
        $action->execute($request->input('id'));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'User delete successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }

    /**
     * Update user permissions
     *
     * @param  [integer] id
     * @param  [array] permissions
     * @return [json] ServiceResponse object
     */
    public function updateUserPermissions(UpdateUserPermissionsRequest $request, UpdateUserPermissionsAction $action)
    {
        // Auth user
        $user = $request->user();

        // Update the user permissions
        $user = $action->execute($user, $request->input('id'), $request->input('permissions'));

        // Transform the user
        $user = json_decode(json_encode(new UserResource($user)));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'User permissions updated successfully';
        $resp->status = true;
        $resp->data = $user;
        return response()->json($resp, 200);
    }

    /**
     * Get users
     *
     * @return [json] ServiceResponse object
     */
    public function all(Request $request, AllUsersAction $action)
    {
        // Get the users
        // $users = $action->execute($request->user());
        $users = $action->execute($request->user())->get();

        // Transform the users
        $users = json_decode(json_encode(UserResource::collection($users)));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Users retrieved successfully';
        $resp->status = true;
        $resp->data = $users;
        return response()->json($resp, 200);
    }

    /**
     * Get user by id
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function getUserById(GetUserByIdRequest $request, GetUserByIdAction $action)
    {
        // Auth user
        $auth_user = $request->user();

        // Get the user
        $user = $action->execute($auth_user, $request->input('id'));

        if ($user) {        
            // Return the response
            $resp = new ServiceResponse;
            $resp->message = 'User retrieved successfully';
            $resp->status = true;
            $resp->data = $user;
            return response()->json($resp, 200);
        } else {
            // Return the response
            $resp = new ServiceResponse;
            $resp->message = 'ACCESS VIOLATION';
            $resp->status = false;
            $resp->data = null;
            return response()->json($resp, 200);
        }
    }

    /**
     * Update user custom data
     *
     * @param  [integer] id
     * @param  [integer] update_type
     * @param  [integer] update_value
     * @return [json] ServiceResponse object
     */
    public function updateCustomData(UpdateUserCustomDataRequest $request, UpdateUserCustomDataAction $action)
    {
        // Update the user custom data
        $user = $action->execute($request->input('id'), $request->except(['id']));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'User custom data updated successfully';
        $resp->status = true;
        $resp->data = $user;
        return response()->json($resp, 200);
    }

    /**
     * Update user password
     *
     * @param  [integer] id
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [json] ServiceResponse object
     */
    public function updatePassword(UpdateUserPasswordRequest $request, UpdateUserPasswordAction $action)
    {
        // Update the user
        $user = $action->execute($request->all());

        // Old password is not correct
        if (!$user) {
            // Return the response
            $resp = new ServiceResponse;
            $resp->message = 'Old password is not correct';
            $resp->status = false;
            $resp->data = null;
            return response()->json($resp, 200);
        }

        // Transform the user
        $user = json_decode(json_encode(new UserResource($user)));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Password updated successfully';
        $resp->status = true;
        $resp->data = $user;
        return response()->json($resp, 200);
    }
}
