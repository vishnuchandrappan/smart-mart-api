<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;

class SuccessWithToken implements Responsable{
    protected $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function toResponse($request)
    {
        $data = [
            'access_token' => $this->token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];

        return response()->json([
            'status' => 'ok',
            'data' => $data
        ]);
    }
}