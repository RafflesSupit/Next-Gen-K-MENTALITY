@extends('layouts.app')

@section('title', 'Warung Makan Berkah - Home')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-orange-400 to-red-500 text-white rounded-lg p-8 mb-8">
        <h1 class="text-4xl font-bold mb-4">Welcome to Maison Étoile</h1>
        <p class="text-xl mb-6">Serving the best Indonesian food with authentic taste</p>
        <a href="{{ route('menu') }}" class="bg-white text-orange-500 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100">
            See Our Menus
        </a>
    </div>

    <!-- About Section -->
    <div class="grid md:grid-cols-2 gap-8 mb-8">
        <div>
            <h2 class="text-3xl font-bold mb-4 text-gray-800">About Us</h2>
            <p class="text-gray-600 mb-4">
                Maison Étoile has been serving customers since 2010 with a commitment to serving high quality food and excellent service.
            </p>
            <p class="text-gray-600 mb-4">
                We use fresh ingredients and traditional recipes to deliver unforgettable flavors.
            </p>
            <div class="flex flex-wrap gap-2">
                <span class="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm">Exclusive</span>
                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">Fresh</span>
                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">Best Service</span>
            </div>
        </div>
        <div class="bg-gray-200 rounded-lg h-72 flex items-center justify-center">
           <img class="w-full h-full object-cover rounded-2xl" src="https://i.postimg.cc/HWhDjfTv/resto2.jpg" alt="">
        </div>
    </div>

    <!-- Featured Menu -->
    <div class="mb-8">
        <h2 class="text-3xl font-bold mb-6 text-gray-800 text-center">Signature Menu</h2>
        <div class="grid md:grid-cols-3 gap-6">
            @forelse($featuredMenus as $menu)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="h-48 bg-gray-200 flex items-center justify-center">
                    <img 
                        src="{{ asset('storage/' . $menu->image) }}" 
                        alt="{{ $menu->name }}" 
                        class="w-full h-full object-cover"
                    >
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-lg mb-2">{{ $menu->name }}</h3>
                    <p class="text-gray-600 text-sm mb-2">{{ $menu->description }}</p>
                    <p class="text-orange-500 font-bold">$ {{ number_format($menu->price, 0, ',', '.') }}</p>
                </div>
            </div>
            @empty
            <div class="col-span-3 text-center text-gray-500">
                <p>Currently there is no menu available.</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Contact Info dengan Maps -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Contact & Location</h2>
        <div class="grid md:grid-cols-2 gap-6">
            <div>
                <h3 class="font-semibold mb-2">Address</h3>
                <p class="text-gray-600 mb-4">Sawosari Street No.3, Bugel, Sidorejo District, Salatiga City, Central Java</p>
                
                <h3 class="font-semibold mb-2">Opening Hours</h3>
                <p class="text-gray-600 mb-4">Monday - Sunday: 08.00 AM - 10.00 PM</p>
                
                <h3 class="font-semibold mb-2">Phone</h3>
                <p class="text-gray-600 mb-2">(0271) 123-4567</p>
                
                <h3 class="font-semibold mb-2">WhatsApp</h3>
                <p class="text-gray-600">0812-3456-7890</p>
            </div>
            <div>
                <h3 class="font-semibold mb-2">Location Map</h3>
                <div class="rounded-lg overflow-hidden">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d247.3357987468532!2d110.4970521!3d-7.3119519!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a790b318594c9%3A0xe004af270db0a2d1!2sKost%20Putra%20Suko%20Aji!5e0!3m2!1sen!2sid!4v1750407250655!5m2!1sen!2sid" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection