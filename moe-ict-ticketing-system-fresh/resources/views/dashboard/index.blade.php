@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-7xl px-4">
    <!-- Hero / Header -->
    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-r from-green-700 to-green-600 text-white shadow-lg mb-8" style="background-image: linear-gradient(90deg, var(--brand-green-dark), var(--brand-green));">
        <div class="p-6 md:p-8">
            <div class="flex items-center gap-4 mb-2">
                <img src="{{ asset('energy.jpg') }}" alt="MOE Logo" class="h-14 w-auto shadow border border-yellow-300 bg-white" style="max-width:320px;">
                <br>
            </div>
            <p class="text-2xl md:text-3xl font-bold">Operations Dashboard | Real-time overview of tickets and resolution performance</p>
            <div class="mt-4 flex flex-wrap gap-3">
                <a href="{{ route('tickets.index') }}" class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 transition-colors px-4 py-2 rounded-lg ring-1 ring-white/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5A2.25 2.25 0 015.25 5.25h13.5A2.25 2.25 0 0121 7.5v9a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 16.5v-9z" />
                    </svg>
                    <span>View Tickets</span>
                </a>
                <a href="{{ route('kb.index') }}" class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 transition-colors px-4 py-2 rounded-lg ring-1 ring-white/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 5.25h15M4.5 12h15m-15 6.75h15" />
                    </svg>
                    <span>Knowledge Base</span>
                </a>
            </div>
        </div>
        <div class="absolute right-0 top-0 -mr-10 -mt-10 opacity-20 select-none" aria-hidden="true">
            <div class="w-40 h-40 md:w-56 md:h-56 rounded-full bg-white/20 blur-2xl"></div>
            <div class="absolute bottom-0 right-10 w-24 h-2 bg-yellow-400" style="background-color: var(--brand-gold);"></div>
        </div>
    </div>

    <!-- KPI Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-gray-200 p-5 hover:shadow-md transition">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5A2.25 2.25 0 015.25 5.25h13.5A2.25 2.25 0 0121 7.5v9a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 16.5v-9z" />
                    </svg>
                </div>
                <div>
                    <div class="text-gray-500 text-sm">Total Tickets</div>
                    <div class="text-3xl font-semibold">{{ $totalTickets }}</div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-gray-200 p-5 hover:shadow-md transition">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-full bg-orange-100 text-orange-700 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <div class="text-gray-500 text-sm">Open Tickets</div>
                    <div class="text-3xl font-semibold text-orange-600">{{ $openTickets }}</div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-gray-200 p-5 hover:shadow-md transition">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-full bg-green-100 text-green-700 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75l2.25 2.25L15 9.75m6 2.25a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <div class="text-gray-500 text-sm">Closed Tickets</div>
                    <div class="text-3xl font-semibold text-green-600">{{ $closedTickets }}</div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-gray-200 p-5 hover:shadow-md transition">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <div class="text-gray-500 text-sm">Avg Resolution (min)</div>
                    <div class="text-3xl font-semibold">{{ $avgResolutionMinutes ?? '—' }}</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Card -->
    <div class="bg-white rounded-xl shadow-sm ring-1 ring-gray-200 p-5 md:p-6 mb-8">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg md:text-xl font-semibold">Average Resolution Time (Last 30 Days)</h2>
            <div class="text-sm text-gray-500">Minutes/day</div>
        </div>
        @if(!empty($chartLabels))
            <div class="relative">
                <canvas id="resChart" height="80"></canvas>
            </div>
        @else
            <div class="text-gray-500">No resolved tickets in the last 30 days.</div>
        @endif
    </div>

    @php
        // Priority breakdown
        $priorityCounts = \App\Models\Ticket::select('priority')->get()
            ->groupBy(fn($t) => $t->priority ?? 'Normal')
            ->map->count();

        // Oldest open tickets
        $oldestOpen = \App\Models\Ticket::where('status', 'Open')
            ->orderBy('created_at')
            ->limit(5)
            ->get();

        // Attaché performance (last 30 days)
        $windowStart = now()->subDays(30);
        $tickets30 = \App\Models\Ticket::with('assignee')
            ->where('created_at', '>=', $windowStart)
            ->whereNotNull('assigned_to')
            ->get();
        $byAssignee = $tickets30->groupBy('assigned_to');
        $attacheStats = $byAssignee->map(function($group) {
            $closed = $group->where('status', 'Closed');
            $avg = $closed->avg(fn($t) => $t->resolution_minutes ?? 0);
            $ratingAvg = $group->avg(fn($t) => $t->rating ?? null);
            return [
                'name' => optional($group->first()->assignee)->name ?? 'Unknown',
                'total' => $group->count(),
                'closed' => $closed->count(),
                'avg_minutes' => $avg ? (int) ceil($avg) : null,
                'avg_rating' => $ratingAvg ? number_format($ratingAvg, 1) : null,
            ];
        })->sortByDesc('closed')->take(5);
    @endphp

    <!-- Insights Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Tickets by Priority -->
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-gray-200 p-5">
            <h3 class="font-semibold mb-3">Tickets by Priority</h3>
            <div class="space-y-2">
                @php
                    $prioColors = [
                        'High' => 'bg-red-100 text-red-700',
                        'Normal' => 'bg-gray-100 text-gray-700',
                        '' => 'bg-gray-100 text-gray-700'
                    ];
                @endphp
                @forelse($priorityCounts as $label => $count)
                    @php $cls = $prioColors[$label] ?? 'bg-gray-100 text-gray-700'; @endphp
                    <div class="flex items-center justify-between">
                        <span class="px-2 py-1 rounded text-xs {{ $cls }}">{{ $label }}</span>
                        <span class="font-semibold">{{ $count }}</span>
                    </div>
                @empty
                    <div class="text-gray-500">No tickets yet.</div>
                @endforelse
            </div>
        </div>

        <!-- Oldest Open Tickets -->
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-gray-200 p-5">
            <h3 class="font-semibold mb-3">Oldest Open Tickets</h3>
            <div class="divide-y">
                @forelse($oldestOpen as $t)
                    <div class="py-2 flex items-center justify-between">
                        <div>
                            <div class="font-medium">{{ $t->ticket_no }}</div>
                            <div class="text-sm text-gray-500">{{ $t->requestor_name }} · {{ $t->created_at->diffForHumans() }}</div>
                        </div>
                        <a href="{{ route('tickets.show', $t->id) }}" class="text-blue-600 text-sm">View</a>
                    </div>
                @empty
                    <div class="text-gray-500">All clear. No open tickets.</div>
                @endforelse
            </div>
        </div>

        <!-- Attaché Performance -->
        <div class="bg-white rounded-xl shadow-sm ring-1 ring-gray-200 p-5">
            <h3 class="font-semibold mb-3">Attaché Performance (30 days)</h3>
            <div class="space-y-3">
                @forelse($attacheStats as $row)
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="font-medium">{{ $row['name'] }}</div>
                            <div class="text-sm text-gray-500">Closed: {{ $row['closed'] }}/{{ $row['total'] }} · Avg: {{ $row['avg_minutes'] ?? '—' }}m · Rating: {{ $row['avg_rating'] ?? '—' }}</div>
                        </div>
                    </div>
                @empty
                    <div class="text-gray-500">No assigned tickets in the last 30 days.</div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Helpful Links -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-4">
        <a href="{{ route('tickets.create') }}" class="block rounded-xl border border-dashed border-gray-300 p-6 bg-white hover:bg-gray-50 transition">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </div>
                <div>
                    <div class="font-semibold">Create a new ticket</div>
                    <div class="text-gray-500 text-sm">Log a new issue or request</div>
                </div>
            </div>
        </a>
        <a href="{{ route('kb.create') }}" class="block rounded-xl border border-dashed border-gray-300 p-6 bg-white hover:bg-gray-50 transition">
            <div class="flex items-center gap-3">
                <div class="h-10 w-10 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 6.75h15m-15 4.5h15m-15 4.5h9" />
                    </svg>
                </div>
                <div>
                    <div class="font-semibold">Add knowledge base article</div>
                    <div class="text-gray-500 text-sm">Document solutions for future reuse</div>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection

@push('scripts')
@if(!empty($chartLabels))
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const el = document.getElementById('resChart');
    if (!el || typeof window.Chart === 'undefined') return;
    const ctx = el.getContext('2d');
    new window.Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($chartLabels),
            datasets: [{
                label: 'Avg minutes',
                data: @json($chartValues),
                borderColor: '#0c5c2c',
                backgroundColor: 'rgba(12, 92, 44, .10)',
                pointBackgroundColor: '#0c5c2c',
                pointRadius: 3,
                borderWidth: 2,
                tension: 0.3,
                fill: true,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: { mode: 'index', intersect: false }
            },
            interaction: { mode: 'nearest', axis: 'x', intersect: false },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { color: '#6b7280' }
                },
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(107, 114, 128, 0.15)' },
                    ticks: { color: '#6b7280' },
                    title: { display: true, text: 'Minutes', color: '#6b7280' }
                }
            }
        }
    });
});
</script>
@endif
@endpush
