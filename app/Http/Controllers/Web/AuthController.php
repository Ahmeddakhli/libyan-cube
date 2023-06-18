<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\RegisterFrontUserRequest;
use App\Http\Requests\Auth\LoginUserRequest;
use App\Http\Controllers\Actions\Auth\RegisterUserAction;
use App\Http\Resources\UserResource;
use App\Http\Helpers\ServiceResponse;
use Carbon\Carbon;
use Auth, Session;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Modules\Compares\Compare;
use Redis;
use Lang;

class AuthController extends Controller
{
    use SendsPasswordResetEmails;

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
    public function register(RegisterFrontUserRequest $request, RegisterUserAction $action)
    {
        // Create the user
        if (!$request->password == $request->password_confirmation) {
            $errors = [];
            $errors[] = [
                'field' => 'password',
                'message' => 'password and password confirmation not match'
            ];

            throw new HttpResponseException(response()->json([
                'errors' => $errors
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
        }

        $user = $action->execute($request->all());

        try {
            $user->sendEmailVerificationNotification();
        } catch (\Throwable $th) {
            //throw $th;
        }

        // Transform the user
        $user = json_decode(json_encode(new UserResource($user)));

        // Return the response
        $resp = new ServiceResponse;
        $resp->message = trans('auth.success') . '. ' . trans('auth.verify');
        $resp->status = true;
        $resp->data = $user;

        return response()->json($resp, 200);
    }

    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [redirect]
     */
    public function login(LoginUserRequest $request)
    {
        // Get login credentials
        $credentials = request(['email', 'password']);
        $remember = $request->input('remember') ? true : false;

        // If not authorized
        if (!Auth::attempt($credentials, $remember)) {
            $resp = new ServiceResponse;
            $resp->message = Lang::get('auth.incorrect_username_or_password_please_try_again');
            $resp->status = true;
            $resp->errors = [
                [
                    'message' => Lang::get('auth.incorrect_username_or_password_please_try_again')
                ]
            ];
            return response()->json($resp, 401);
            // return response()->json(['error' => Lang::get('auth.incorrect_username_or_password_please_try_again')], 401);
        }

        // If email is not verified and user is not admin
        if (!Auth::user()->hasVerifiedEmail() && !auth()->user()->isAdmin()) {
            Auth::logout();

            $resp = new ServiceResponse;
            $resp->message = trans('auth.verify');
            $resp->status = false;
            $resp->errors = [
                [
                    'message' => trans('auth.verify')
                ]
            ];
            return response()->json($resp, 401);
        }

    
        // Update user last_login_at and last_login_ip && timezone
        $user = Auth::user();
        $user->last_login_at = Carbon::now();
        $user->last_login_ip = request()->ip();
        $user->timezone = $request->input('timezone') ? $request->input('timezone') : $user->timezone;
        $user->save();

        if (Auth::user()->group && !in_array(Auth::user()->group->slug, ['brokers', 'developers', 'owners', 'buyers'])) {
            $redirect_to = route('home');
        } elseif (Auth::user()->group && in_array(Auth::user()->group->slug, ['brokers', 'developers', 'owners', 'buyers'])) {
            $redirect_to = route('front.home');
        } else {
            Auth::logout();

            $resp = new ServiceResponse;
            $resp->message = trans('auth.error_has_occurred_please_contact_the_administrator');
            $resp->status = false;
            $resp->errors = [
                [
                    'message' => trans('auth.error_has_occurred_please_contact_the_administrator')
                ]
            ];
            return response()->json($resp, 401);
        }
        
        // Store compares in user account
        $session = $request->session()->get('_token');
        Compare::where('session', $session)->update([
            'user_id' => auth()->user()->id,
            'session' => null
        ]);

        $resp = new ServiceResponse;
        $resp->message = Lang::get('auth.logged_in_successfully');
        $resp->status = true;
        $resp->data = new UserResource($user);
        $resp->redirect_to = $redirect_to;
        return response()->json($resp, 200);
    }

    public function showLoginForm(Request $request)
    {
        // return view('auth.login');
        return view('dashboard.pages.auth.login');
    }

    /**
     * Logout user (Revoke the token)
     *
     * @return [redirect] login
     */
    public function logout(Request $request)
    {
        Auth::logout();

        return response()->json(['success' => 'Logged-out successfully'], 200);
    }

    public function logoutGetRequest(Request $request)
    {
        Auth::logout();

        return redirect()->route('login');
    }

    public function keepalive(Request $request)
    {
        /*
        $old_sid = Session::getId();
        $login = Auth::login(Auth::user());
        Session::setId($old_sid);
        Session::save();
        return response()->json(['success' => 'Alive'], 200);
        */
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

    public function showLinkRequestForm(Request $request)
    {
        return view('dashboard.pages.auth.login');
    }

    /**
     * Get the response for a successful password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkResponse(Request $request, $response)
    {
        // Return the response
        $resp = new ServiceResponse;
        $resp->message = trans($response);
        $resp->status = true;
        $resp->data = (object) [];
        return response()->json($resp, 200);
    }

    /**
     * Get the response for a failed password reset link.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $response
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    protected function sendResetLinkFailedResponse(Request $request, $response)
    {
        // Return the response
        $resp = new ServiceResponse;
        $resp->message = trans($response);
        $resp->status = false;
        $resp->data = (object) [];
        return response()->json($resp, 200);
    }
}
