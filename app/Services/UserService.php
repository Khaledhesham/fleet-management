<?php

namespace App\Services;

use App\Helpers\APIResponse;
use App\User;
use Illuminate\Http\Request;

class UserService extends Service
{
	/**
	 * Registers a user
	 * 
	 * @param Illuminate\Http\Request $request
	 * @return $array
	 */
	public function register(Request $request)
	{
		$input = $request->all();
		$input['password'] = bcrypt($input['password']);
		$user = User::create($input);
		return $this->response($user, "User Registered Successfully", APIResponse::SUCCESS_STATUS_CODE);
	}

	/**
	 * Retrieves user details
	 * 
	 * @param Illuminate\Http\Request $request
	 * @return $array
	 */
	public function details()
	{
		$user = Auth::user();
		return $this->response($user, "Retrieved Details Successfully", APIResponse::SUCCESS_STATUS_CODE);
	}
}