<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants = Restaurant::all();

        return response([
            'status' => 'success',
            'results' => count($restaurants),
            'data' => $restaurants,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $restaurant = Restaurant::create($request->all());
        return response(['status' => 'success', 'data' => ['restaurant' => $restaurant]], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $restaurant = Restaurant::find($id);
        if (!$restaurant) {
            return response(['status' => 'Fail', 'message' => 'No restaurant found with id: ' . $id], 404);
            exit;
        }

        return response(['status' => 'success', 'data' => ['restaurant' => $restaurant]], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $restaurant = Restaurant::find($id);
        if (!$restaurant) {
            return response(['status' => 'Fail', 'message' => 'No restaurant found with id: ' . $id], 404);
            exit;
        }

        $restaurant->update($request->all());
        return response(['status' => 'success', 'message' => 'Restaurant has been updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $restaurant = Restaurant::find($id);
        if (!$restaurant) {
            return response(['status' => 'Fail', 'message' => 'No restaurant found with id: ' . $id], 404);
            exit;
        }
        Restaurant::destroy($id);
        return response(['status' => 'success', 'message' => 'Restaurant has been deleted successfully'], 204);
    }
}
