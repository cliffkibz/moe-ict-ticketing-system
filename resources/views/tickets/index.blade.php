@extends('layouts.app')
@section('content')
<div class="max-w-5xl mx-auto p-6 bg-white rounded shadow">
    <h2 class="text-xl font-semibold mb-4">{{ __('tickets.list_title') }}</h2>
    <a href="{{ route('tickets.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mb-4 inline-block">{{ __('tickets.create_new') }}</a>
    <table class="min-w-full bg-white border">
        <thead>
            <tr>
                <th class="py-2 px-4 border">#</th>
                <th class="py-2 px-4 border">{{ __('Requestor Name') }}</th>
                <th class="py-2 px-4 border">{{ __('Department') }}</th>
                <th class="py-2 px-4 border">Location</th>
                <th class="py-2 px-4 border">Office Contact</th>
                <th class="py-2 px-4 border">Category</th>
                <th class="py-2 px-4 border">{{ __('Priority') }}</th>
                <th class="py-2 px-4 border">{{ __('Status') }}</th>
                <th class="py-2 px-4 border">{{ __('tickets.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($tickets as $ticket)
                <tr>
                    <td class="py-2 px-4 border">{{ $ticket->ticket_no }}</td>
                    <td class="py-2 px-4 border">{{ $ticket->requestor_name }}</td>
                    <td class="py-2 px-4 border">{{ $ticket->department }}</td>
                    <td class="py-2 px-4 border">{{ $ticket->location ?? '—' }}</td>
                    <td class="py-2 px-4 border">{{ $ticket->office_contact ?? '—' }}</td>
                    <td class="py-2 px-4 border">{{ $ticket->category ?? '—' }}</td>
                    <td class="py-2 px-4 border">
                        @php
                            $pill = match($ticket->priority ?? 'Normal') {
                                'High' => 'bg-red-100 text-red-700',
                                'Normal' => 'bg-gray-100 text-gray-700',
                                default => 'bg-gray-100 text-gray-700',
                            };
                        @endphp
                        <span class="px-2 py-1 rounded text-xs {{ $pill }}">{{ $ticket->priority ?? 'Normal' }}</span>
                    </td>
                    <td class="py-2 px-4 border">{{ $ticket->status }}</td>
                    <td class="py-2 px-4 border">
                        <a href="{{ route('tickets.show', $ticket->id) }}" class="text-blue-600 hover:underline">{{ __('tickets.view') }}</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="py-2 px-4 border text-center">{{ __('tickets.no_tickets') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="mt-4">{{ $tickets->links() }}</div>
</div>
@endsection
