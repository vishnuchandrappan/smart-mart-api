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
        $this->middleware('auth:api', ['except' => ['login', 'adminLogin']]);
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

        $user = User::where('email', $request->email)->get()[0];

        $data = [];
        $data['token'] = $token;
        $data['user'] = $user;
        return new SuccessWithData($data);
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

    public function adminLogin(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->get()[0];

        if ($user->user_type !== '1') {
            return new ErrorResponse('Unauthenticated',403);
        }

        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return new ErrorResponse("Unauthorized", 401);
        }

        $data = [];
        $data['token'] = $token;
        $data['user'] = $user;
        $data['expiresIn'] = auth()->factory()->getTTL() * 60;
        return new SuccessWithData($data);
    }
}
