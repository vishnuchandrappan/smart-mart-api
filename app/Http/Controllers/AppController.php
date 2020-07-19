<?php

namespace App\Http\Controllers;

use App\Http\Responses\SuccessResponse;
use App\Http\Responses\SuccessWithData;
use App\Item;
use Illuminate\Http\Request;
use App\SuperMarket;
use App\Order;

class AppController extends Controller
{
    public function one()
    {
        $data = SuperMarket::where('district_id', 1)->get();
        return new SuccessWithData($data);
    }

    public function two()
    {
        $a = SuperMarket::find(1);
        $data = $a;
        $data['categories'] = $a->labels;
        return new SuccessWithData($data);
    }

    public function three()
    {
        $data = SuperMarket::find(1)->itemsInLabel(1)->get();
        return new SuccessWithData($data);
    }

    public function four()
    {
        $data = Item::find(1);
        return new SuccessWithData($data);
    }

    public function five(Request $request)
    {
        try {
            $order = Order::firstOrFail();
        } catch (\Exception $th) {
            $order = Order::create([
                'user_id' => 3
            ]);
        }
        try {
            $item = $order->items()->findOrFail($request->item_id);
            $item->number = $item->number + 1;
            $item->cost =  $item->cost + $request->cost;
            $item->save();
        } catch (\Exception $th) {
            $order->items()->create([
                'item_id' => $request->item_id,
                'number' => 1,
                'cost' => $request->cost
            ]);
        }

        return new SuccessResponse("Added");
    }
}
