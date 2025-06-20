<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard(){
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status','pending')->count();
        $totalRevenue = Order::sum('total_amount');
    
        return view('admin.dashboard', compact('totalOrders', 'pendingOrders', 'totalRevenue'));
    }
    
    public function orders(){
        $orders = Order::with('orderItems.menu')->latest()->get();
        return view(admin.orders, compact('orders'));
    }
    
    public function showOrder(Order $order){
        $order->load('orderItems.menu');
        return view('admin.orders.show', compact('order'));
    }
    
    public function updateOrder(Request $request, Order $order){
        $request->validated([
            'status' => 'required|in:pending,preparing,served,completed'
        ]);
    
        $order->update(['status' => $request->status]);
        return redirect()->route('admin.orders')->with('success','Status Pesanan Berhasil Diperbaharui');
    }
    
    public function deleteOrder(Order $order){
        $order->delete($order);
        
        return redirect()->route('admin.orders')->with('success','Pesanan Berhasil Dihapus');
    }
}
