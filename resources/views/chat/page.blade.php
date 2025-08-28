@extends('layouts.app')
@section('content')
<div class="min-h-[80vh] flex flex-col items-center justify-center bg-gradient-to-br from-green-50 to-white py-12">
    <div class="mb-8 flex flex-col items-center">
        <img src="{{ asset('energy.jpg') }}" alt="MOE Logo" class="h-20 mb-2 rounded shadow">
        <h1 class="text-2xl md:text-3xl font-bold text-[var(--brand-green)] mb-1">MOE ICT Assistant</h1>
        <div class="text-gray-600 text-center max-w-xl">Ask a question, search the knowledge base, or get help with your ICT issues. The assistant will suggest solutions or help you log a ticket.</div>
    </div>
    <div class="w-full max-w-lg">
        @include('chat.widget')
    </div>
</div>
@endsection
