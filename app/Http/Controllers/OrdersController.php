<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderEditRequest;
use App\Mail\OrderComplited;
use App\Order;
use App\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with(['products','partner'])->get();
        return view('orders.index',compact('orders'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::with('products')
            ->where('id',$id)
            ->first();

        $partners = Partner::all()->pluck('name','id');

        return view('orders.edit',compact('order','partners'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param OrderEditRequest $request
     * @param int $id
     * @return void
     */
    public function update(OrderEditRequest $request, $id)
    {
        $order = Order::find($id);
        $order->fill($request->all());
        $order->save();

        if($order->isCompleted()) {
            $order->load(['products','products.vendor']);

            $vendorsMails = $order->products
                ->pluck('vendor')
                ->pluck('email')
                ->unique();

            Mail::to($order->partner->email)->send(new OrderComplited($order));

            foreach ($vendorsMails as $email){
                Mail::to($email)->send(new OrderComplited($order));
            }
        }

        return Redirect::to(route('order.edit',$order))
            ->with(['success'=>'Заказ изменен!']);
    }

}
