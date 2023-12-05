<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orderitem;
use App\Models\Order;
use App\Events\OrderItemUpdated;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        if ($search) {
            $matchingOrder = Order::where('order_number', 'like', "%$search%")->first();

            if ($matchingOrder) {
                $orderItems = Orderitem::where('order_id', $matchingOrder->id)->get();
            } else {
                $orderItems = collect();
            }
        } else {
            $orderItems = Orderitem::all();
        }

        return view(('admin.orderitem.index'), compact('orderItems', 'search'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function changeStatus($id)
    {
        $orderItem = Orderitem::findOrFail($id);

        // Salva il vecchio stato
        $oldCompleted = $orderItem->completed;

        $orderItem->completed = !$orderItem->completed;
        $orderItem->save();

        // Verifica se il vecchio stato e il nuovo stato sono diversi
        if ($oldCompleted !== $orderItem->completed) {
            event(new OrderItemUpdated($orderItem));
        }

        return redirect()->back();
    }
}
