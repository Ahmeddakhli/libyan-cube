<?php

namespace App\Http\Controllers\Actions\Auth;

use App\User;
use App\Http\Helpers\Utilities;
use Config;
use Auth;
use Carbon\Carbon;

class RegisterUserAction
{
	public function __construct()
	{
		//
	}

	public function execute(array $data): User
	{
		// Store the image if provided
		if (isset($data['image'])) {
            $data['image'] = Utilities::storeFile($data['image'], 'storage/profile_images', Config::get('constants.default_image'));
		} else {
			$data['image'] = 'front/images/placeholder.jpg';
		}

		if (Auth::check() && auth()->user()->isAdmin()) {
			$data['email_verified_at'] = Carbon::now();
		}

		// Encrypt the password
		$password = $data['password'];
		$data['password'] = bcrypt($data['password']);

		// Create the user
		$user = User::create($data);

		// Attaching the permissions
		$user->permissions()->sync($user->group->permissions);

		$user = User::find($user->id); // To unload the permissions relation

		return $user;
	}
}
