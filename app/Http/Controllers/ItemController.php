<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyItemRequest;
use App\Http\Requests\NewItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use App\Http\Responses\SuccessWithData;
use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    protected $superMarket;

    public function __construct()
    {
        // $this->middleware('isAdmin');
        // $this->superMarket = auth()->user()->superMarket;
    }

    public function index()
    {
        $items = auth()->user()->superMarket->items;
        return new SuccessWithData($items);
    }

    public function show($id)
    {
        try {
            $item = auth()->user()->superMarket->items()->findOrFail($id);
        } catch (\Exception $e) {
            return new ErrorResponse('Unauthorized', 401);
        }
        return new SuccessWithData($item);
    }

    public function create(NewItemRequest $request)
    {
        auth()->user()->superMarket->items()->create($request->all());
        return new SuccessResponse('Item Created');
    }

    public function update($id, UpdateItemRequest $request)
    {
        try {
            $item = auth()->user()->superMarket->items()->findOrFail($id);
        } catch (\Exception $e) {
            return new ErrorResponse('Unauthorized', 401);
        }

        $item->update($request->except(['item_id']));

        return new SuccessResponse('Item Updated');
    }

    public function destroy($id)
    {
        try {
            $item = auth()->user()->superMarket->items()->findOrFail($id);
        } catch (\Exception $e) {
            return new ErrorResponse('Unauthorized', 401);
        }
        $item->delete();

        return new SuccessResponse('Item Deleted');
    }

    public function outOfStock()
    {
        $items = auth()->user()->superMarket->outOfStock;
        return new SuccessWithData($items);
    }

    public function lowStock()
    {
        $items = auth()->user()->superMarket->lowStock;
        return new SuccessWithData($items);
    }

    public function stocks($id)
    {

        try {
            $item = auth()->user()->superMarket->items()->findOrFail($id);
        } catch (\Exception $e) {
            return new ErrorResponse('Unauthorized', 401);
        }

        $data = $item->stocks()->get();
        return new SuccessWithData($data);
    }

    // WEB
}
