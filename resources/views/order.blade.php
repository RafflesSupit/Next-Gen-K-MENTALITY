@extends('layouts.app')

@section('title', 'Pesan - Warung Makan Berkah')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-center mb-8">Buat Pesanan Dine-In</h1>
    
    <form method="POST" action="{{ route('order.store') }}" class="max-w-4xl mx-auto" id="orderForm">
        @csrf
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-bold mb-4">Informasi Pesanan</h2>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Nama Pelanggan *</label>
                    <input type="text" name="customer_name" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" value="{{ old('customer_name') }}">
                </div>
                <div>
                    <label class="block text-gray-700 font-bold mb-2">Nomor Meja *</label>
                    <input type="text" name="table_number" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" value="{{ old('table_number') }}">
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold mb-4">Pilih Menu</h2>
            <div id="menu-items">
                @foreach($menus as $menu)
                <div class="flex items-center justify-between border-b py-4">
                    <div class="flex-1">
                        <h3 class="font-bold">{{ $menu->name }}</h3>
                        <p class="text-gray-600 text-sm">{{ $menu->description }}</p>
                        <p class="text-orange-500 font-bold">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <input type="number" 
                               name="quantities[{{ $menu->id }}]" 
                               min="0" 
                               value="0" 
                               class="w-16 px-2 py-1 border border-gray-300 rounded quantity-input"
                               data-price="{{ $menu->price }}"
                               data-menu-id="{{ $menu->id }}">
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="mt-6 text-right">
                <p class="text-xl font-bold">Total: Rp <span id="total-amount">0</span></p>
            </div>
            
            <div class="mt-6 text-center">
                <button type="submit" class="bg-green-500 text-white px-8 py-3 rounded-lg text-lg hover:bg-green-600">
                    Buat Pesanan
                </button>
            </div>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const quantityInputs = document.querySelectorAll('.quantity-input');
    
    quantityInputs.forEach(input => {
        input.addEventListener('input', updateTotal);
    });
    
    function updateTotal() {
        let total = 0;
        
        quantityInputs.forEach(input => {
            const quantity = parseInt(input.value) || 0;
            const price = parseFloat(input.dataset.price);
            total += quantity * price;
        });
        
        document.getElementById('total-amount').textContent = total.toLocaleString('id-ID');
    }
    
    // Form submission handler
    document.getElementById('orderForm').addEventListener('submit', function(e) {
        const formData = new FormData();
        formData.append('_token', document.querySelector('input[name="_token"]').value);
        formData.append('customer_name', document.querySelector('input[name="customer_name"]').value);
        formData.append('table_number', document.querySelector('input[name="table_number"]').value);
        
        let itemIndex = 0;
        quantityInputs.forEach(input => {
            const quantity = parseInt(input.value) || 0;
            if (quantity > 0) {
                formData.append(`items[${itemIndex}][menu_id]`, input.dataset.menuId);
                formData.append(`items[${itemIndex}][quantity]`, quantity);
                itemIndex++;
            }
        });
        
        if (itemIndex === 0) {
            e.preventDefault();
            alert('Pilih minimal satu menu!');
            return false;
        }
    });
});
</script>
@endsection