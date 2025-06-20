@extends('layouts.app')
@section('title','Detail Pesanan - Admin')
@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">
            Detail Pesanan #{{$order->id}}
        </h1>
        <a href="{{route('admin.orders')}}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Kembali</a>
    </div>
    <div class="grid md:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold mb-4">Informasi Pesanan</h2>
            <div class="space-y-2">
                <p><strong>Pelanggan:</strong>{{$order->customer_name}}</p>
                <p><strong>Meja:</strong>{{$order->table_number}}</p>
                <p><strong>Status:</strong>
                    <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                        {{ ucfirst($order->status)}}
                    </span>
                </p>
                <p><strong>Tanggal:</strong>{{ $order->order_date->format('d/m/Y H:i')}}</p>
                <p><strong>Total:</strong>
                    <span class="text-green-600 font-bold">
                        Rp {{ number_format($order->total_amount, 0 , '.','.')}}
                    </span>
                </p>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold mb-4">Item Pesanan</h2>
            <div class="space-y-3">
                @foreach ($order->orderItems as $item)
                    <div class="flex justify-between items-center border-b pb-2">
                        <div>
                            <p class="font-medium">{{$item->menu->name}}</p>
                            <p class="text-sm text-gray-500">{{$item->quantity}} * Rp {{number_format($item->price,0,'','' )}}</p>
                        </div>
                        <p class="font-bold">Rp {{number_format($item->price * $item->quantity,0,'','' )}} </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection