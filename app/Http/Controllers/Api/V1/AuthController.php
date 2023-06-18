<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Http\Requests\Auth\LoginUserRequest;
use App\Http\Controllers\Actions\Auth\RegisterUserAction;
use App\Http\Resources\UserResource;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth;
use App\User;
use Modules\Compares\Compare;

class AuthController extends Controller
{
    /**
     * Register user and create token
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
    public function register(RegisterUserRequest $request, RegisterUserAction $action)
    {
        // Create the user
        $user = $action->execute($request->all());

        // Generate access token
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
        $token->save();

        // Transform the user
        $user = json_decode(json_encode(new UserResource($user)));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Account created successfully';
        $resp->status = true;
        $resp->data = [
            'token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
            'user' => $user
        ];
        return response()->json($resp, 200);
    }

    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [json] ServiceResponse object
     */
    public function login(LoginUserRequest $request)
    {
        // Get login credentials
        $credentials = request(['email', 'password']);

        // If not authorized
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => trans('auth.incorrect_username_or_password_please_try_again')
            ], 401);
        }

        $user = $request->user();
        $user->last_login_at = Carbon::now();
        $user->last_login_ip = request()->ip();
        $user->save();

        // Generate access token
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
        $token->save();
                // Check Compares of user 
        $session = $request->session()->get('_token');
        Compare::where('session', $session)->update([
            'user_id' => $user->id,
            'session' => null
        ]);
        // Transform the user
        $user = json_decode(json_encode(new UserResource($user)));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = trans('auth.logged_in_successfully');
        $resp->status = true;
        $resp->data = [
            'token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($tokenResult->token->expires_at)->toDateTimeString(),
            'user' => $user
        ];
        return response()->json($resp, 200);
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [json] ServiceResponse object
     */
    public function logout(Request $request)
    {
        auth('web')->logout();
        $request->user()->token()->revoke();
        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Logged-out successfully';
        $resp->status = true;
        $resp->data = [];
        return response()->json($resp, 200);
    }

    /**
     * Get the authenticated User
     *
     * @return [json] ServiceResponse object
     */
    public function user(Request $request)
    {
        $user = json_decode(json_encode(new UserResource($request->user())));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = 'Retrieved successfully';
        $resp->status = true;
        $resp->data = $user;
        return response()->json($resp, 200);
    }
}
