<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;

class SuccessResponse implements Responsable{
    protected $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

    public function toResponse($request)
    {
        return response()->json([
            'status' => 'ok',
            'message' => $this->message
        ]);
    }
}