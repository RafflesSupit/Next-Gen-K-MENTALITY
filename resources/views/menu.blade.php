@extends('layouts.app')

@section('title', 'Menu - Maison Étoile')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-center mb-8 text-gray-800">Our Menus</h1>
    
    @auth
        <div class="flex flex-col sm:flex-row justify-center gap-4 mb-8">
            <!-- Tombol Pesan Sekarang - untuk semua user yang login -->
            <a href="{{ route('order.create') }}" class="bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition duration-200 text-center">
                Order Now
            </a>
            
            <!-- Tombol Tambah Menu - hanya untuk admin -->
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.menu.create') }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg hover:bg-blue-600 transition duration-200 text-center">
                    Add Menu
                </a>
            @endif
        </div>
    @endauth

    @forelse($menus as $category => $categoryMenus)
    <div class="mb-8">
        <h2 class="text-2xl font-bold mb-4 text-gray-700 capitalize">{{ $category }}</h2>
        <div class="grid md:grid-cols-3 gap-6">
            @foreach($categoryMenus as $menu)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="h-48 bg-gray-200">
                    <img 
                        src="{{ asset('storage/' . $menu->image) }}" 
                        alt="{{ $menu->name }}" 
                        class="w-full h-full object-cover"
                    >
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-lg mb-2">{{ $menu->name }}</h3>
                    <p class="text-gray-600 text-sm mb-2">{{ $menu->description }}</p>
                    <p class="text-orange-500 font-bold text-lg">$ {{ number_format($menu->price, 0, ',', '.') }}</p>
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <div class="flex space-x-2 mt-4">
                                {{-- Tombol Edit --}}
                                <a href="{{ route('admin.menu.edit', $menu->id) }}" class="text-blue-500 hover:underline">
                                    Edit
                                </a>

                                {{-- Tombol Hapus --}}
                                <form action="{{ route('admin.menu.delete', $menu->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this menu?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @empty
    <div class="text-center">
        <p class="text-gray-500">There are no menus available yet</p>
    </div>
    @endforelse
</div>
@endsection