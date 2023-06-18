<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Http\Requests\Users\SuspendUserRequest;
use App\Http\Requests\Users\UpdateUserPermissionsRequest;
use App\Http\Requests\Users\DeleteUserRequest;
use App\Http\Requests\Users\GetUserByIdRequest;
use App\Http\Requests\Users\UpdateUserCustomDataRequest;
use App\Http\Requests\Users\UpdateUserPasswordRequest;
use App\Http\Controllers\Actions\Users\UpdateUserAction;
use App\Http\Controllers\Actions\Users\UsersTagsInput;
use App\Http\Controllers\Actions\Users\SuspendUserAction;
use App\Http\Controllers\Actions\Users\UpdateUserPermissionsAction;
use App\Http\Controllers\Actions\Users\DeleteUserAction;
use App\Http\Controllers\Actions\Users\AllUsersAction;
use App\Http\Controllers\Actions\Users\SearchUsersAction;
use App\Http\Controllers\Actions\Groups\AllGroupsAction;
use App\Http\Controllers\Actions\Permissions\AllGroupPermissionsAction;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Http\Controllers\Actions\Auth\RegisterUserAction;
use App\Http\Controllers\Actions\Users\GetUserByIdAction;
use App\Http\Controllers\Actions\Users\UnSuspendUserAction;
use App\Http\Controllers\Actions\Users\UpdateUserCustomDataAction;
use App\Http\Controllers\Actions\Users\UpdateUserPasswordAction;
use App\Http\Resources\UserResource;
use App\Http\Helpers\ServiceResponse;
use App\Http\Requests\Users\UnSuspendUserRequest;
use Carbon\Carbon;
use Auth;
use App\User;
use Yajra\Datatables\Datatables;
use DateTimeZone;
use Modules\Imports\AssignmentRule;
use Lang;

class UsersController extends Controller
{
    /**
     * Store user
     *
     * @param  [integer] group_id
     * @param  [string] full_name
     * @param  [file] image
     * @param  [string] username
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @param  [string] mobile_number
     * @param  [boolean] remember_me
     * @return [json] ServiceResponse object
     */
    public function store(RegisterUserRequest $request, RegisterUserAction $action)
    {
        // Create the user
        $user = $action->execute($request->all());

        // Transform the user
        $user = json_decode(json_encode(new UserResource($user)));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Account created successfully';
        $resp->status = true;
        $resp->data = $user;
        return response()->json($resp, 200);
    }

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
     * Suspend user
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function suspend(SuspendUserRequest $request, SuspendUserAction $action)
    {
        $action->execute($request->input('id'), $request);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'User suspended successfully';
        $resp->status = true;
        $resp->data = null;
        return response()->json($resp, 200);
    }
           /**
     * Un Suspend user
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function unsuspend(UnSuspendUserRequest $request, UnSuspendUserAction $action)
    {
        //  Un suspend the user
        $action->execute($request->input('id'), $request);

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'User un suspended successfully';
        $resp->status = true;
        $resp->data = null;
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
        $user = Auth::user();

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
     * @return [json] Datatable object
     */
    public function all(Request $request, AllUsersAction $action)
    {
        // Get the users
        $users = $action->execute(Auth::user())->get();

        // Transform the users
        $users = json_decode(json_encode(UserResource::collection($users)));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Users retrieved successfully';
        $resp->status = true;
        $resp->data = $users;
        return response()->json($resp, 200);
    }

    public function index(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        if ($request->isMethod('POST')) {
            $suspended = true;
            // Search the users
            $action = new SearchUsersAction;
            $users = $action->execute($auth_user, $request, $suspended);

            return Datatables::of($users)->make(true);
        } else {        
            // Get the groups
            $action = new AllGroupsAction;
            // $groups = $action->execute($auth_user);
            $groups = $action->execute($auth_user)->get();

            if($request->ajax()):
                // Load Partial
                return view('dashboard.pages.users.index-partial', compact('groups'));
            else:
                // Load with Full Layout
                return view('dashboard.pages.users.index', compact('groups'));
            endif;
        }

    }

    public function create(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the groups
        $action = new AllGroupsAction;
        // $groups = $action->execute($auth_user);
        $groups = $action->execute($auth_user)->get();

        return view('dashboard.pages.users.create', compact('groups'));
    }

    public function createModal(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the groups
        $action = new AllGroupsAction;
        // $groups = $action->execute($auth_user);
        $groups = $action->execute($auth_user)->get();

        // Get timezones
        $timezones = DateTimeZone::listIdentifiers(DateTimeZone::ALL);

        return view('dashboard.pages.users.modals.create', compact('groups', 'timezones'))->render();
    }

    public function updateUserModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();
        
        $users = User::all();

        // Get the requested user
        $user = $users->filter(function($user) use ($id) {
            return $user->id == $id;
        })->first();

        // If user does not exist, return error div
        if (!$user) {
            $error = Lang::get('users.user_not_found_or_you_are_not_authorized_to_edit_the_user');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the groups
        $action = new AllGroupsAction;
        // $groups = $action->execute($auth_user);
        $groups = $action->execute($auth_user)->get();

        // Get timezones
        $timezones = DateTimeZone::listIdentifiers(DateTimeZone::ALL);

        return view('dashboard.pages.users.modals.update', compact('groups', 'user', 'timezones'))->render();
    }

    public function suspendUserModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the users
        $action = new AllUsersAction;
        // $users = $action->execute($auth_user);
        $users = $action->execute($auth_user)->get();

        // Get the requested user
        $user = $users->filter(function($user) use ($id) {
            return $user->id == $id;
        })->first();

        // If user does not exist, return error div
        if (!$user) {
            $error = Lang::get('users.user_not_found_or_you_are_not_authorized_to_edit_the_user');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get groups
        $action = new AllGroupsAction;
        $groups = $action->execute($auth_user)->get();

        // Get assignment rules
        // $assignment_rules = AssignmentRule::whereHas('users')->get();

        return view('dashboard.pages.users.modals.suspend', compact('user', 'users', 'groups'))->render();
    }

    public function updateUserPermissionsModal(Request $request, $id = null)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the users
        $action = new AllUsersAction;
        // $users = $action->execute($auth_user);
        $users = $action->execute($auth_user)->get();

        // Get the requested user
        $user = $users->filter(function($user) use ($id) {
            return $user->id == $id;
        })->first();

        // If user does not exist, return error div
        if (!$user) {
            $error = Lang::get('users.user_not_found_or_you_are_not_authorized_to_edit_the_user');
            return view('dashboard.components.error', compact('error'))->render();
        }

        // Get the user group permissions
        $action = new AllGroupPermissionsAction;
        $permissions = $action->execute($user->group);
        $permissions = $permissions->filter(function($permission) {
            return !$permission->parent_id;
        });

        return view('dashboard.pages.users.modals.update_permissions', compact('user', 'permissions'))->render();
    }

    public function userProfile(Request $request)
    {
        // Auth user
        $auth_user = Auth::user();

        // Get the users
        $action = new AllUsersAction;
        // $users = $action->execute($auth_user);
        $users = $action->execute($auth_user)->get();

        // Get the requested user
        $user = $users->filter(function($user) use ($auth_user) {
            return $user->id == $auth_user->id;
        })->first();

        // If user does not exist, return error div
        if (!$user) {
            $error = Lang::get('users.user_not_found_or_you_are_not_authorized_to_edit_the_user');
            return view('dashboard.components.error', compact('error'))->render();
        }

        $blade_name = ($request->ajax() ? 'my-profile-partial' : 'my-profile'); // Handle Partial Return

        // Get timezones
        $timezones = DateTimeZone::listIdentifiers(DateTimeZone::ALL);

        return view('8x.pages.users.'.$blade_name, compact('user', 'timezones'))->render();
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

    /**
     * Get user by id
     *
     * @param  [integer] id
     * @return [json] ServiceResponse object
     */
    public function userTagSearch(Request $request, UsersTagsInput $action)
    {

        // Get the users
        $users = $action->execute($request->all());

        if ($users) {        
            // Return the response
            $resp = $users;
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
}
