@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Admin Dashboard</h1>
    
    <!-- Stats Cards -->
    <div class="grid md:grid-cols-3 gap-6 mb-8">
        <div class="bg-blue-500 text-white rounded-lg p-6">
            <h3 class="text-lg font-semibold">Total Orders</h3>
            <p class="text-3xl font-bold">{{ $totalOrders }}</p>
        </div>
        <div class="bg-yellow-500 text-white rounded-lg p-6">
            <h3 class="text-lg font-semibold">Pending Orders</h3>
            <p class="text-3xl font-bold">{{ $pendingOrders }}</p>
        </div>
        <div class="bg-green-500 text-white rounded-lg p-6">
            <h3 class="text-lg font-semibold">Total Revenue</h3>
            <p class="text-3xl font-bold">$ {{ number_format($totalRevenue, 0, ',', '.') }}</p>
        </div>
    </div>
    
    <!-- Menu Button Section -->
    <div class="mb-8">
        <div class="bg-white rounded-lg shadow-md p-8 flex flex-col items-center">
            <h2 class="text-2xl font-bold mb-4 text-purple-700">Manage Menu</h2>
            <p class="mb-6 text-gray-600 text-center max-w-lg">
                Add, edit, or remove menu items available in your app. Keep your menu up-to-date so customers can see the latest options.
            </p>
            <a href="{{ route('admin.menu.index') }}" class="inline-flex items-center bg-purple-600 text-white px-8 py-3 rounded-lg shadow hover:bg-purple-700 transition text-lg font-semibold">
                Manage Menus
            </a>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold mb-4">Quick Menu</h2>
        <div class="grid md:grid-cols-2 gap-4">
            <a href="{{ route('admin.orders') }}" class="bg-blue-500 text-white p-4 rounded-lg text-center hover:bg-blue-600">
                Manage Orders
            </a>
            <a href="{{ route('admin.users') }}" class="bg-gray-500 text-white p-4 rounded-lg text-center hover:bg-gray-600">
                View Users
            </a>
        </div>
    </div>
</div>
@endsection