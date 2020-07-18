<?php

namespace App\Http\Controllers;

use App\District;
use App\Http\Requests\NewSuperMarketRequest;
use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use App\Http\Responses\SuccessWithData;
use App\SuperMarket;
use App\User;
use Illuminate\Http\Request;

class SuperMarketController extends Controller
{

    public function __construct()
    {
        // $this->middleware('isAdmin');
    }

    public function store(NewSuperMarketRequest $request)
    {
        if (auth()->user()->superMarket) {
            return new ErrorResponse('User Already exists');
        }

        auth()->user()->superMarket()->create($request->all());
        return new SuccessResponse('Super Market Created');
    }

    public function update($id, NewSuperMarketRequest $request)
    {
        $superMarket = SuperMarket::find($id);

        if (auth()->user()->superMarket->id !== $superMarket->id) {
            return new ErrorResponse('Unauthorized', 401);
        }

        $superMarket->update($request->all());
        return new SuccessResponse("Details Updated");
    }

    public function show()
    {
        $data = auth()->user()->superMarket;
        if (!$data) {
            return new ErrorResponse("No results found", 404);
        }
        return new SuccessWithData($data);
    }

    public function getLabels()
    {
        $labels = auth()->user()->superMarket->labels;
        return new SuccessWithData($labels);
    }

    public function getItems($id)
    {
        $items = auth()->user()->superMarket->itemsInLabel($id)->get();
        return new SuccessWithData($items);
    }

    public function changeState()
    {
        $sm = auth()->user()->superMarket;
        $sm->update([
            'is_opened' => !$sm->is_opened
        ]);

        return new SuccessResponse('Changes Saved');
    }


    // WEB

    public function new($id)
    {
        $district = District::find($id);
        $users = User::all();
        return view('superMarkets.new', compact('district', 'users'));
    }

    public function webStore($id)
    {
        $district = District::find($id)->superMarkets()->create(
            request(['name', 'address', 'contact', 'location', 'phone_number', 'user_id'])
        );

        return redirect('/districts/' . $id);
    }

    public function webDelete($id)
    {
        SuperMarket::find($id)->delete();
        return back();
    }

    public function webShow($id)
    {
        $superMarket = SuperMarket::find($id);
        return view('superMarkets.show', compact('superMarket'));
    }
}
