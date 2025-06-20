<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $totalRevenue = Order::sum('total_amount');
        
        return view('admin.dashboard', compact('totalOrders', 'pendingOrders', 'totalRevenue'));
    }

    // public function users()
    // {
    //     $users = User::all();
    //     return view('admin.users', compact('users'));
    // }

    public function orders()
    {
        $orders = Order::with('orderItems.menu')->latest()->get();
        return view('admin.orders', compact('orders'));
    }

    public function showOrder(Order $order)
    {
        $order->load('orderItems.menu');
        return view('admin.orders.show', compact('order'));
    }

    public function updateOrder(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,preparing,served,completed',
        ]);

        $order->update(['status' => $request->status]);
        return redirect()->route('admin.orders')->with('success', 'Order status updated successfully.');
    }

    public function deleteOrder(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders')->with('success', 'Order successfully deleted.');
    }
}