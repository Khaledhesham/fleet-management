<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }

    /**
     * Logs user in
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $response = $this->authService->login($request);
        return $response->format();
    }

    /**
     * Logs user out
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $response = $this->authService->logout($request);
        return $response->format();
    }

    /**
     * Refreshes user token
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function refreshToken(Request $request)
    {
        $response = $this->authService->refreshToken($request);
        return $response->format();
    }
}
