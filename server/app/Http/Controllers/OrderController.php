<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $myOrders = Order::where('user_id', Auth::id())->get();
        if (!$myOrders) {
            return response(['status' => 'fail', 'message' => 'You have got no orders yet, start ordering'], 404);
        }
        return response(['status' => 'success', 'results' => count($myOrders), 'data' => ['orders' => $myOrders]], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'bail|required',
            'item_id' => 'required',
            "adresse_street" => 'required',
            "adresse_number" => 'required',
            "adresse_zip" => 'required',
            "adresse_city" => 'required',
            "adresse_country" => 'required',
            "total_price" => 'required',
            "phone" => 'required|min:10',
            "tracking_number" => 'required|unique:order',
            "delivery_time_min" => 'required',
            "delivery_time_max" => 'required',
        ]);
        $order = Order::create([
            'user_id' => Auth::id(),
            'item_id' => $validated['item_id'],
            "adresse_street" => $validated['adresse_street'],
            "adresse_number" => $validated['adresse_number'],
            "adresse_zip" => $validated['adresse_zip'],
            "adresse_city" => $validated['adresse_city'],
            "adresse_country" => $validated['adresse_country'],
            "total_price" => $validated['total_price'],
            "phone" => $validated['phone'],
            "tracking_number" => $validated['tracking_number'],
            "delivery_time_min" => $validated['delivery_time_min'],
            "delivery_time_max" => $validated['delivery_time_max'],

        ]);
        return $order;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
