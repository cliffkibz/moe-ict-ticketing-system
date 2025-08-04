@extends('layouts.app')
@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-xl font-semibold mb-4">{{ __('tickets.detail_title') }}</h2>
    <div class="mb-4">
        <span class="font-medium">{{ __('Ticket No.') }}:</span> {{ $ticket->ticket_no }}
    </div>
    <div class="mb-4">
        <span class="font-medium">{{ __('Requestor Name') }}:</span> {{ $ticket->requestor_name }}
    </div>
    <div class="mb-4">
        <span class="font-medium">{{ __('Department') }}:</span> {{ $ticket->department }}
    </div>
    <div class="mb-4">
        <span class="font-medium">{{ __('Email') }}:</span> {{ $ticket->email }}
    </div>
    <div class="mb-4">
        <span class="font-medium">{{ __('Issue') }}:</span> {{ $ticket->issue }}
    </div>
    <div class="mb-4">
        <span class="font-medium">{{ __('Remarks') }}:</span> {{ $ticket->remarks }}
    </div>
    <div class="mb-4">
        <span class="font-medium">{{ __('Status') }}:</span> {{ $ticket->status }}
    </div>
    <div class="mb-4">
        <span class="font-medium">{{ __('Date Submitted') }}:</span> {{ $ticket->created_at->format('d-M-Y H:i') }}
    </div>
    <a href="{{ route('tickets.pdf', $ticket->id) }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">{{ __('tickets.download_pdf') }}</a>
    <a href="{{ route('tickets.index') }}" class="ml-2 text-blue-600 hover:underline">{{ __('tickets.back_to_list') }}</a>
</div>
@endsection
