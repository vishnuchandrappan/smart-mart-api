<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use App\Http\Responses\SuccessWithData;
use App\Http\Responses\SuccessWithToken;
use Illuminate\Http\Request;

use App\User;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(LoginRequest $request)
    {
        if (User::where('email', $request->email)->first()->phone_verified_at == null) {
            return new ErrorResponse("Account Not Verified", 402);
        }
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return new ErrorResponse("Unauthorized", 401);
        }

        return new SuccessWithToken($token);
    }

    public function me()
    {
        return new SuccessWithData(auth()->user());
    }


    public function logout()
    {
        auth()->logout();
        return new SuccessResponse("Successfully logged out");
    }


    public function refresh()
    {
        return new SuccessWithToken(auth()->refresh());
    }
}
