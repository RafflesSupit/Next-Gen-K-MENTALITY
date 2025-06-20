@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto mt-10 bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Create Menu</h2>
    <a href="javascript: history.go(-1)" class="text-sm text-blue-600 hover:underline mb-4 inline-block">
        ← Back to Menu  
    </a>
    <form action="{{ route('admin.menu.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-semibold mb-2">Name</label>
            <input type="text" name="name" id="name" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-semibold mb-2">Description</label>
            <textarea name="description" id="description" rows="3" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
        </div>
        <div class="mb-4">
            <label for="price" class="block text-gray-700 font-semibold mb-2">Price</label>
            <input type="number" name="price" id="price" step="0.01" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>
        <div class="mb-4">
            <label for="image" class="block text-gray-700 font-semibold mb-2">Image (optional)</label>
            <input type="file" name="image" id="image" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>
        <div class="mb-6">
            <label for="category" class="block text-gray-700 font-semibold mb-2">Category</label>
            <input list="categories" name="category" id="category" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            <datalist id="categories">
                @foreach($categories as $category)
                <option value="{{ $category }}">
                @endforeach
            </datalist>
        </div>
        <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700 transition">Create Menu</button>
    </form>
</div>
@endsection