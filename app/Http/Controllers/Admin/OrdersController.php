<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\orderRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders  =Order::paginate(5);
        return view('admin.orders.index',[
            'orders' => $orders,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $statusOptions = Order::statusOptions();
        $paymentStatus = Order::paymentStatus();


        return view('admin.orders.edit' , [
            'order' => $order,
            'statusOptions' => $statusOptions,
            'paymentStatus' => $paymentStatus,

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(orderRequest $request, Order $order)
    {
        $data = $request->validated();
        $order->update($data);
        return redirect()->route('orders.index')
       ->with('success',"Order ({$order->id}) Updated!");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
