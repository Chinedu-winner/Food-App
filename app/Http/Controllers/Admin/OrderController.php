<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller{
    public function index(){
        $orders = Order::latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function show($id){
        $order = Order::findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function destroy($id){
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('admin.orders')->with('success', 'Order deleted successfully');
    }

    public function track($order = null){
        if ($order) {
            $order = Order::find($order);
        }
        return view('admin.orders.track', compact('order'));
    }
}
