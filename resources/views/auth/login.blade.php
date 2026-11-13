@extends('layouts.app')

@section('title', 'Sign in')

@section('content')
<form method="POST" action="/login" class="max-w-sm mx-auto mt-10 space-y-4 p-6 bg-white rounded-lg shadow">
    @csrf
    <h2 class="text-xl font-bold text-center text-emerald-700">Barangay Bulletin Sign in</h2>

    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" class="w-full border rounded p-2">
    @error('email') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror

    <input type="password" name="password" placeholder="Password" class="w-full border rounded p-2">
    @error('password') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror

    <button class="w-full bg-emerald-600 hover:bg-emerald-700 text-white rounded p-2">Sign in</button>
</form>
@endsection