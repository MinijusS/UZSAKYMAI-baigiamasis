<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderedItems;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return View('orders.index')->with(['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return View('orders.create')->with(['products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Order($request->all());
        $order->user_id = Auth::user()->id;

        $timezoned = $order->end_time + 180; //Adds 3 hours because of timezone difference
        $end = strtotime("+" . $timezoned . " minutes", strtotime(date(now()))); //Adds selected time to start counting from NOW
        $time = gmdate("Y-m-d H:i:s", $end); //Formats from unix timestamp to date format for DB
        $order->end_time = $time; //Sets in DB

        $order->save();

        $product_count = $request->input('product_count');

        for ($i = 0; $i < $product_count; $i++) {
            $order->orderedItems()->create([
                'order_id' => $order->id,
                'product_id' => $request->input("product-{$i}"),
                'quantity' => $request->input("quantity-{$i}"),
                'sauce_id' => $request->input("sauce-{$i}"),
                'size' => $request->input("size-{$i}")
            ]);
        }

        return redirect()->route('orders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('orders.edit')->with(['order' => $order]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $get_time = $request->input('end_time');
        //If end_time is not changed then leave old time
        if ($get_time != null) {
            $timezoned = $get_time + 180; //Adds 3 hours because of timezone difference
            $end = strtotime("+" . $timezoned . " minutes", strtotime(date(now()))); //Adds selected time to start counting from NOW
            $time = gmdate("Y-m-d H:i:s", $end); //Formats from unix timestamp to date format for DB
            $request->merge(['end_time' => $time]); //Sets in DB
        }

        $order->update($request->all());

        $product_count = $request->input('product_count');

        $order->orderedItems()->where(['order_id' => $order->id])->delete();

        for ($i = 0; $i < $product_count; $i++) {
            $order->orderedItems()->create([
                'order_id' => $order->id,
                'product_id' => $request->input("product-{$i}"),
                'quantity' => $request->input("quantity-{$i}"),
                'sauce_id' => $request->input("sauce-{$i}"),
                'size' => $request->input("size-{$i}")
            ]);
        }

        return redirect()->route('orders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Order $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
