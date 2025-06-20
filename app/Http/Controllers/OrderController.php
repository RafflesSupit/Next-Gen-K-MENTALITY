<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function create()
    {
        $menus = Menu::all();
        return view('order', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'table_number' => 'required',
            'quantities' => 'required|array',
        ]);

        $total = 0;
        $validItems = [];
        
        // Proses quantities[menu_id] => quantity
        foreach ($request->quantities as $menuId => $quantity) {
            if ($quantity > 0) {
                $validItems[] = [
                    'menu_id' => $menuId,
                    'quantity' => $quantity
                ];
            }
        }
        
        if (empty($validItems)) {
            return back()->withErrors(['quantities' => 'Pilih minimal 1 menu dengan quantity > 0']);
        }
        
        foreach ($validItems as $item) {
            $menu = Menu::find($item['menu_id']);
            $total += $menu->price * $item['quantity'];
        }

        $order = Order::create([
            'customer_name' => $request->customer_name,
            'table_number' => $request->table_number,
            'total_amount' => $total,
            'order_date' => now(),
        ]);

        foreach ($validItems as $item) {
            $menu = Menu::find($item['menu_id']);
            OrderItem::create([
                'order_id' => $order->id,
                'menu_id' => $item['menu_id'],
                'quantity' => $item['quantity'],
                'price' => $menu->price,
            ]);
        }

        return redirect()->route('home')->with('success', 'Pesanan berhasil dibuat!');
    }
}