@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-3xl py-6 px-4">
    <a href="{{ route('kb.index') }}" class="text-blue-600">← Back to Knowledge Base</a>

    <h1 class="text-3xl font-bold mt-2">{{ $article->title }}</h1>
    <div class="text-gray-500 text-sm">{{ $article->category }} · {{ $article->created_at->format('M d, Y') }} · {{ $article->views }} views</div>

    <div class="prose max-w-none mt-6">
        {!! nl2br(e($article->content)) !!}
    </div>
</div>
@endsection
