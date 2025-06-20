@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold text-gray-800">Menus</h1>
        <a href="{{ route('admin.menu.create') }}" class="inline-flex items-center bg-blue-600 text-white px-5 py-2 rounded-lg shadow hover:bg-blue-700 transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Add Menu
        </a>
    </div>
    <div class="bg-white shadow rounded-lg overflow-x-auto">
        <table class="min-w-full table-fixed divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="w-16 px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">#</th>
                    <th class="w-2/3 px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Menu Name</th>
                    <th class="w-1/3 px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @forelse($menus as $menu)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 whitespace-nowrap text-gray-700 text-center">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-900 font-medium">{{ $menu->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.menu.edit', $menu->id) }}" class="text-indigo-600 hover:text-indigo-900 font-medium transition">Edit</a>
                            <form action="{{ route('admin.menu.delete', $menu->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this menu?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium transition">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-4 text-center text-gray-500">No menus found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection