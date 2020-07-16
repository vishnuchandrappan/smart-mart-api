<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;

class ErrorResponse implements Responsable
{
    protected $message, $response_code;

    public function __construct($message, $response_code = 400)
    {
        $this->message = $message;
        $this->response_code = $response_code;
    }

    public function toResponse($request)
    {
        return response()->json([
            'status' => 'error',
            'message' => $this->message
        ], $this->response_code);
    }
}
