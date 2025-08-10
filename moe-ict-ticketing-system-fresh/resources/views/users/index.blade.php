@extends('layouts.app')
@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold">Attachees</h2>
        <a href="{{ route('users.create') }}" class="px-4 py-2 rounded bg-green-700 text-white hover:bg-green-800">Add Attachee</a>
    </div>
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 p-3 mb-4 rounded">{{ session('success') }}</div>
    @endif
    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="py-2 px-4 border">Name</th>
                <th class="py-2 px-4 border">Email</th>
                <th class="py-2 px-4 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td class="py-2 px-4 border">{{ $user->name }}</td>
                    <td class="py-2 px-4 border">{{ $user->email }}</td>
                    <td class="py-2 px-4 border flex gap-2">
                        <a href="{{ route('users.edit', $user) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Delete this attachee?');">
                            @csrf @method('DELETE')
                            <button class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="py-2 px-4 border text-center">No attachees found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
