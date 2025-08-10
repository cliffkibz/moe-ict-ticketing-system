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
        <span class="font-medium">Category:</span> {{ $ticket->category ?? '—' }}
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
    <div class="mb-2">
        <span class="font-medium">Priority:</span>
        @php
            $pill = match($ticket->priority ?? 'Normal') {
                'High' => 'bg-red-100 text-red-700',
                'Normal' => 'bg-gray-100 text-gray-700',
                default => 'bg-gray-100 text-gray-700',
            };
        @endphp
        <span class="px-2 py-1 rounded text-xs {{ $pill }}">{{ $ticket->priority ?? 'Normal' }}</span>
    </div>
    <div class="mb-2">
        <span class="font-medium">{{ __('Status') }}:</span> {{ $ticket->status }}
    </div>
    @if($ticket->resolved_at)
    <div class="mb-2 text-green-700">
        <span class="font-medium">Resolved At:</span> {{ $ticket->resolved_at->format('d-M-Y H:i') }}
    </div>
    <div class="mb-4 text-green-700">
        <span class="font-medium">Resolution Time:</span> {{ $ticket->resolution_minutes }} minutes
    </div>
    @endif
    <div class="mb-4">
        <span class="font-medium">{{ __('Date Submitted') }}:</span> {{ $ticket->created_at->format('d-M-Y H:i') }}
    </div>

    <div class="flex items-center gap-2 flex-wrap">
        <a href="{{ route('tickets.pdf', $ticket->id) }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">{{ __('tickets.download_pdf') }}</a>
        <a href="{{ route('tickets.index') }}" class="text-blue-600 hover:underline">{{ __('tickets.back_to_list') }}</a>

        <form action="{{ route('tickets.assign', $ticket) }}" method="POST" class="flex items-center gap-2">
            @csrf
            <input type="hidden" name="assignee_name" id="assignee_name_input">
            <button type="button" class="px-3 py-2 rounded bg-indigo-600 text-white" onclick="promptAssign()">Assign</button>
        </form>
        <script>
        function promptAssign() {
            var name = prompt('Enter the name of the person to assign to:');
            if (name !== null && name.trim() !== '') {
                document.getElementById('assignee_name_input').value = name.trim();
                // Submit the form
                document.querySelector('form[action*="assign"]').submit();
            }
        }
        </script>

        @if($ticket->status !== 'Closed')
        <form action="{{ route('tickets.close', $ticket) }}" method="POST" onsubmit="return confirm('Close this ticket?');">
            @csrf
            <button class="bg-gray-800 text-white px-4 py-2 rounded">Close Ticket</button>
        </form>
        @endif
    </div>

    @if($ticket->status === 'Closed')
    <div class="mt-6 p-4 border rounded bg-gray-50">
        <div class="font-semibold mb-2">Rate Resolution Quality</div>
        <form action="{{ route('tickets.rate', $ticket) }}" method="POST" class="flex items-center gap-3">
            @csrf
            <select name="rating" class="border rounded px-2 py-1" required>
                <option value="">--</option>
                @for($i=1;$i<=5;$i++)
                    <option value="{{ $i }}" @selected($ticket->rating === $i)>{{ $i }}</option>
                @endfor
            </select>
            <button class="px-3 py-2 rounded bg-blue-600 text-white">Submit</button>
            @if($ticket->rating)
                <span class="text-gray-600">Current rating: {{ $ticket->rating }}/5</span>
            @endif
        </form>
    </div>
    @endif
@endsection
