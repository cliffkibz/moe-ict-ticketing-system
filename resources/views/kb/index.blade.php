@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-5xl py-6 px-4">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Knowledge Base</h1>
        <a href="{{ route('kb.create') }}" class="px-3 py-2 rounded bg-blue-600 text-white text-sm">New Article</a>
    </div>

    <form method="get" action="{{ route('kb.index') }}" class="mb-4">
        <input type="text" name="q" value="{{ $q }}" placeholder="Search articles..." class="border rounded px-3 py-2 w-full" />
    </form>

    <div class="space-y-4">
        @forelse ($articles as $article)
            <div class="bg-white p-4 rounded shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <a href="{{ route('kb.show', $article->slug) }}" class="text-lg font-semibold">{{ $article->title }}</a>
                        <div class="text-gray-500 text-sm">{{ $article->category }} · {{ $article->created_at->diffForHumans() }} · {{ $article->views }} views</div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-gray-500">No articles found.</div>
        @endforelse
    </div>

    <div class="mt-4">{{ $articles->withQueryString()->links() }}</div>
</div>
@endsection
