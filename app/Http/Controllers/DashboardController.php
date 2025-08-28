<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Basic KPIs
        $totalTickets = Ticket::count();
        $openTickets = Ticket::where('status', 'Open')->count();
        $closedTickets = Ticket::where('status', 'Closed')->count();

        // Average resolution time (minutes) for resolved tickets (DB-agnostic)
        $avgResolutionMinutes = Ticket::whereNotNull('resolved_at')->get()
            ->avg(fn ($t) => $t->resolution_minutes ?? 0);
        $avgResolutionMinutes = $avgResolutionMinutes !== null ? (int) ceil($avgResolutionMinutes) : null;

        // Resolution times distribution for last 30 days (avg minutes per day)
        $last30Days = now()->subDays(30);
        $resolutionSeries = Ticket::whereNotNull('resolved_at')
            ->where('resolved_at', '>=', $last30Days)
            ->get()
            ->groupBy(fn ($t) => $t->resolved_at->format('Y-m-d'))
            ->map(function ($group) {
                $avg = $group->avg(fn ($t) => $t->resolution_minutes ?? 0);
                return (int) ceil($avg);
            })
            ->sortKeys();
        $chartLabels = $resolutionSeries->keys()->values()->all();
        $chartValues = $resolutionSeries->values()->all();

        return view('dashboard.index', [
            'totalTickets' => $totalTickets,
            'openTickets' => $openTickets,
            'closedTickets' => $closedTickets,
            'avgResolutionMinutes' => $avgResolutionMinutes,
            'chartLabels' => $chartLabels,
            'chartValues' => $chartValues,
        ]);
    }
}
