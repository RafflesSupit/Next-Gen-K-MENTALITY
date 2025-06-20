@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container mx-auto px-4 py-5">
    <h1 class="text-3xl font-bold mb-8">Dashboard Admin</h1>

    <!-- Stats Cards -->
    <div class="grid md:grid-cols-3 gap-6 mb-8">
        <div class="bg-blue-500 text-white rounded-lg p-6">
            <h3 class="text-lg font-semibold">Total Pesanan</h3>
            <p class="text-3xl font-bold">{{ $totalOrders }}</p>
        </div>
        <div class="bg-yellow-500 text-white rounded-lg p-6">
            <h3 class="text-lg font-semibold">Pesanan Pending</h3>
            <p class="text-3xl font-bold">{{ $pendingOrders }}</p>
        </div>
        <div class="bg-green-500 text-white rounded-lg p-6">
            <h3 class="text-lg font-semibold">Total Pendapatan</h3>
            <p class="text-3xl font-bold">Rp {{ number_format($totalRevenue, 0,',','.') }}</p>
        </div>
    </div>

    <!-- Menu Button Section -->
    <div class="mb-8">
        <div class="bg-white rounded-lg shadow-md p-8 flex felx-col items-center">
            <h2 class="text-2xl font-bold mb-4 text-purple-700">Kelola Menu</h2>
            <p class="mb-6 text-gray-600 text-center max-w-lg">Tambah, edit, atau hapus item menu yang tersedia di aplikasi Anda. Pastikan menu selalu up-to-date agar pelanggan dapat melihat pilihan terbaru.</p>
            <a href="{{ route('admin.menu.index') }}" class="inline-flex items-center bg-purple-600 text-white px-8 py-3 rounded-lg-shadow hover:bg-purple-700 transition text-lg font-semibold">Kelola Menu</a>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold mb-4">Menu Cepat</h2>
        <div class="grid md:grid-cols-2 gap-4">
            <a href="{{ route('admin.orders') }}" class="bg-blue-500 text-white p-4 rounded-lg text-center hover:bg-blue-600">Kelola Pesanan</a>
            <a href="{{ route('admin.users') }}" class="bg-gray-500 text-white p-4 rounded-lg text-center hover:bg-gray-600">Lihat Pengguna</a>
        </div>
    </div>
</div>
@endsection
