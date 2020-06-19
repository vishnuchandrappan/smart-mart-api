<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyItemRequest;
use App\Http\Requests\NewItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Http\Responses\ErrorResponse;
use App\Http\Responses\SuccessResponse;
use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    protected $superMarket;

    public function __construct()
    {
        // $this->middleware('isAdmin');
        $this->superMarket = auth()->user()->superMarket;
    }

    public function create(NewItemRequest $request)
    {
        $category = $this->validateCategory($request->category_id);
        $category->create($request->only([
            'name', 'unit_price', 'discount'
        ]));

        return new SuccessResponse('Item Created');
    }

    public function update(UpdateItemRequest $request)
    {
        $item = Item::find($request->item_id);
        $this->validateCategory($item->category);

        $item->update($request->only([
            'name', 'unit_price', 'discount'
        ]));

        return new SuccessResponse('Item Updated');
    }

    public function destroy(DestroyItemRequest $request)
    {
        $item = Item::find($request->item_id);
        $this->validateCategory($item->category);

        $item->delete();

        return new SuccessResponse('Item Deleted');
    }

    protected function validateCategory($category_id)
    {
        try {
            $data = $this->superMarket->categories()->findOrFail($category_id);
        } catch (\Exception $e) {
            return new ErrorResponse('Unauthorized', 401);
        }

        return $data;
    }
}
