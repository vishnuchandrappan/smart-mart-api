<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;

class SuccessWithData implements Responsable{
    protected $data,$response_code;

    public function __construct($data,$response_code = 200)
    {
        $this->data = $data;
        $this->response_code = $response_code;
    }

    public function toResponse($request)
    {
        return response()->json([
            'status' => 'ok',
            'data' => $this->data
        ],$this->response_code);
    }
}