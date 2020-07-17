<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStockRequest;
use App\Http\Requests\UpdateStockRequest;
use App\Item;
use Illuminate\Http\Request;
use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use App\Stock;

class StockController extends Controller
{
    public function create(CreateStockRequest $request)
    {
        $item = Item::find($request->item_id);

        if ($item->superMarket->user->id !== auth()->user()->id) {
            return new ErrorResponse('Unauthorized', 401);
        }

        $item->stocks()->create($request->only(['stock']));

        $item->stock = $item->stock + $request->stock;
        $item->save();

        return new SuccessResponse('Stock Addded Successfully');
    }

    public function update(UpdateStockRequest $request)
    {
        $stock = Stock::find($request->stock_id);

        $previous = $stock->stock;

        if ($stock->item->superMarket->user->id !== auth()->user()->id) {
            return new ErrorResponse('Unauthorized', 401);
        }

        $stock->update($request->only(['stock']));

        $stock->item->update([
            'stock' => $stock->item->stock - $previous + $stock->stock
        ]);

        return new SuccessResponse('Stock Modified Successfully');
    }
}
