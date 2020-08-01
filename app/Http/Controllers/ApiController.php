<?php

namespace App\Http\Controllers;

use App\Category;
use App\Order;
use App\OrderedItems;
use App\Product;
use App\Sauce;
use http\Env\Request;
use Illuminate\Http\Response;

class ApiController extends Controller
{
    public function index()
    {
        return response(['orders' => Order::all()->jsonSerialize(), 'sauces' => Sauce::all()->jsonSerialize(), 'orderedItems' => OrderedItems::all()->jsonSerialize()], Response::HTTP_OK);
    }

    public function productIndex()
    {
        return response(['products' => Product::all()->jsonSerialize(), 'categories' => Category::all()->jsonSerialize()], Response::HTTP_OK);
    }

    public function done(Order $order)
    {
        $order->status = Order::ORDER_DONE;
        $order->update();
        return response(Order::all()->jsonSerialize(), Response::HTTP_OK);
    }

    public function revert(Order $order)
    {
        $order->status = Order::ORDER_ACTIVE;
        $order->update();
        return response(Order::all()->jsonSerialize(), Response::HTTP_OK);
    }

    public function cancel(Order $order)
    {
        $order->status = Order::ORDER_CANCELLED;
        $order->update();
        return response(Order::all()->jsonSerialize(), Response::HTTP_OK);
    }

    public function create()
    {
        return response(['products' => Product::all()->jsonSerialize(), 'sauces' => Sauce::all()->jsonSerialize()], Response::HTTP_OK);
    }
}
