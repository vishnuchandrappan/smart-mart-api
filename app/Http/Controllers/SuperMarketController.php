<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewSuperMarketRequest;
use App\Http\Responses\SuccessResponse;
use Illuminate\Http\Request;

class SuperMarketController extends Controller
{

    public function __construct()
    {
        // $this->middleware('isAdmin');
    }

    public function store(NewSuperMarketRequest $request)
    {
        auth()->user()->superMarket()->create($request->all());
        return new SuccessResponse('Super Market Created');
    }

    public function update(NewSuperMarketRequest $request)
    {
        auth()->user()->superMarket->update($request->all());
        return new SuccessResponse("Details Updated");
    }


}
