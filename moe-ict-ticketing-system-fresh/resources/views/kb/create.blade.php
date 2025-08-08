@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-3xl py-6 px-4">
    <h1 class="text-2xl font-bold mb-4">Create Knowledge Base Article</h1>

    <form method="post" action="{{ route('kb.store') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium mb-1">Title</label>
            <input name="title" class="border rounded px-3 py-2 w-full" required />
            @error('title')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Category</label>
            <input name="category" class="border rounded px-3 py-2 w-full" />
            @error('category')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Content</label>
            <textarea name="content" rows="10" class="border rounded px-3 py-2 w-full" required></textarea>
            @error('content')<div class="text-red-600 text-sm">{{ $message }}</div>@enderror
        </div>
        <div class="flex items-center space-x-2">
            <input type="checkbox" name="published" value="1" checked>
            <label>Published</label>
        </div>
        <div>
            <button class="px-4 py-2 bg-blue-600 text-white rounded">Create</button>
        </div>
    </form>
</div>
@endsection
