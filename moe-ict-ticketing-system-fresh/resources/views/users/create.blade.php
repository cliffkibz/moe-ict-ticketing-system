@extends('layouts.app')
@section('content')
<div class="max-w-md mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Add Attachee</h2>
    <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block font-medium mb-1">Name</label>
            <input name="name" class="w-full border rounded px-3 py-2" required value="{{ old('name') }}">
            @error('name')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="block font-medium mb-1">Email</label>
            <input name="email" type="email" class="w-full border rounded px-3 py-2" required value="{{ old('email') }}">
            @error('email')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="block font-medium mb-1">Password</label>
            <input name="password" type="password" class="w-full border rounded px-3 py-2" required>
            @error('password')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="flex gap-2 justify-end">
            <a href="{{ route('users.index') }}" class="px-4 py-2 rounded bg-gray-200">Cancel</a>
            <button class="px-4 py-2 rounded bg-green-700 text-white hover:bg-green-800">Add</button>
        </div>
    </form>
</div>
@endsection
