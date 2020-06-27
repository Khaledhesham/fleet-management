<?php

namespace App\Services;

use App\Helpers\APIResponse;
use Illuminate\Http\Request;
use Laravel\Passport\Client as OClient;

class AuthService extends Service
{
	/**
	 * Logs a user in
	 * 
	 * @param Illuminate\Http\Request $request
	 * @return array
	 */
	public function login(Request $request)
	{
		$email = $request->email;
		$password = $request->password;

		if (Auth::attempt(['email' => $email, 'password' => $password])) {
			$response = $this->getTokens($email, $password);
			$data = $response["data"];
			$message = "Authorized Successfully";
			$statusCode =  $response["statusCode"];
		} else {
			$data = NULL;
			$message = "Authorization failed";
			$statusCode = APIResponse::UNAUTHORIZED_STATUS_CODE;
		}

		return $this->response($data, $message, $statusCode);
	}

	/**
	 * Refreshes Token
	 * 
	 * @param Illuminate\Http\Request $request
	 * @return array
	 */
	public function refreshToken(Request $request) {
		if (is_null($request->header('Refreshtoken'))) {
			return $this->response(NULL, "Authorization failed", APIResponse::UNAUTHORIZED_STATUS_CODE);
		}

		$refresh_token = $request->header('Refreshtoken');
		$Oclient = $this->getOClient();
		$formParams = [ 'grant_type' => 'refresh_token',
						'refresh_token' => $refresh_token,
						'client_id' => $Oclient->id,
						'client_secret' => $Oclient->secret,
						'scope' => '*'];

		return $this->sendRequest("/oauth/token", $formParams, 'POST');
	}

	/**
	 * Logs a user out
	 * 
	 * @param Illuminate\Http\Request $request
	 * @return array
	 */
	public function logout(Request $request) {
		$request->user()->token()->revoke();
		return $this->response(NULL, 'Successfully logged out', APIResponse::SUCCESS_STATUS_CODE);
	}

	/**
	 * Gets Tokens for user
	 * 
	 * @param string $email
	 * @param string $password
	 * @return array
	 */
	private function getTokens(string $email, string $password) {
		$Oclient = $this->getOClient();

		$formParams = [ 'grant_type' => 'password',
						'client_id' => $Oclient->id,
						'client_secret' => $Oclient->secret,
						'username' => $email,
						'password' => $password,
						'scope' => '*'];

		return $this->sendRequest("/oauth/token", $formParams, 'POST');
	}

	/**
	 * Gets Oauth2 client
	 * 
	 * @return Laravel\Passport\Client
	 */
	private function getOClient() {
		return OClient::where('password_client', 1)->first();
	}
}