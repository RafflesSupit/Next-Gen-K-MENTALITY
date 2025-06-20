@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')
<div class="max-w-lg mx-auto mt-10 bg-white p-8 rounded shadow">
    <h2 class="text-2xl font-bold mb-6">Edit Profile</h2>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 border border-green-400 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    <a href="javascript: history.go(-1)" class="text-sm text-blue-600 hover:underline mb-4 inline-block">
        ← Go Back
    </a>

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="block font-semibold mb-1">Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block font-semibold mb-1">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="w-full border px-3 py-2 rounded" required>
        </div>

        <div class="mb-4">
            <label for="password" class="block font-semibold mb-1">Password (optional)</label>
            <input type="password" name="password" id="password" class="w-full border px-3 py-2 rounded">
            <small class="text-gray-500">Fill in if you want to change the password</small>
        </div>

        <div class="mb-6">
            <label for="password_confirmation" class="block font-semibold mb-1">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border px-3 py-2 rounded">
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save Changes</button>
    </form>
</div>
@endsection
