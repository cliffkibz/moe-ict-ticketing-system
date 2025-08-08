<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTicketRequest;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Notifications\TicketCreatedNotification;
use App\Notifications\TicketClosedNotification;
use function view;
use function redirect;

class TicketController extends Controller
{
    // Show all tickets
    public function index()
    {
        $tickets = Ticket::latest()->paginate(10);
        return view('tickets.index', compact('tickets'));
    }

    // Show form to create a new ticket
    public function create()
    {
        return view('tickets.create');
    }

    // Store a new ticket
    public function store(StoreTicketRequest $request)
    {
        $data = $request->validated();
        $data['ticket_no'] = 'MOEICT ' . random_int(10000000, 99999999);
        $data['status'] = 'Open';
        // AI-powered prioritization (rule-based heuristic for now)
        $data['priority'] = $this->inferPriority($data);

        // Auto-assignment (round-robin per category by current open-load)
        $data['assigned_to'] = $this->autoAssign($data['category'] ?? null);

        $ticket = Ticket::create($data);

        if ($ticket->assignee) {
            $ticket->assignee->notify(new TicketCreatedNotification($ticket));
        }

        return redirect()->route('tickets.show', $ticket->id)
                         ->with('success', 'Ticket created successfully!');
    }

    // Show a single ticket
    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        $users = User::orderBy('name')->get(['id','name']);
        return view('tickets.show', compact('ticket','users'));
    }

    // Close a ticket (sets resolved_at and status)
    public function close(Ticket $ticket)
    {
        if ($ticket->status !== 'Closed') {
            $ticket->status = 'Closed';
            $ticket->resolved_at = now();
            $ticket->save();

            if ($ticket->assignee) {
                $ticket->assignee->notify(new TicketClosedNotification($ticket));
            }
        }

        return redirect()->route('tickets.show', $ticket->id)->with('success', 'Ticket closed.');
    }

    private function autoAssign(?string $category): ?int
    {
        // Very simple strategy: pick the user with the fewest open tickets
        // Optionally filter by category skill mapping in the future
        $openCounts = \App\Models\User::query()
            ->withCount(['tickets as open_tickets_count' => function($q) {
                $q->where('status', 'Open');
            }])
            ->orderBy('open_tickets_count')
            ->limit(1)
            ->get(['id']);

        return $openCounts->first()->id ?? null;
    }

    public function assign(Ticket $ticket, Request $request)
    {
        $request->validate(['assigned_to' => 'nullable|exists:users,id']);
        $ticket->assigned_to = $request->input('assigned_to') ? (int) $request->input('assigned_to') : null;
        $ticket->save();

        if ($ticket->assignee) {
            $ticket->assignee->notify(new TicketCreatedNotification($ticket));
        }

        return back()->with('success', 'Ticket assignment updated.');
    }

    public function rate(Ticket $ticket, Request $request)
    {
        $request->validate(['rating' => 'required|integer|min:1|max:5']);
        $ticket->rating = (int) $request->input('rating');
        $ticket->save();
        return back()->with('success', 'Thank you for your feedback.');
    }

    private function inferPriority(array $data): string
    {
        $issue = strtolower($data['issue'] ?? '');
        $dept = strtolower($data['department'] ?? '');

        // Keyword-based urgency
        $urgentKeywords = ['urgent', 'critical', 'down', 'cannot access', 'security', 'breach', 'deadline', 'production'];
        foreach ($urgentKeywords as $kw) {
            if (str_contains($issue, $kw)) {
                return 'High';
            }
        }

        // Department-specific bumps
        if (str_contains($dept, 'exams') || str_contains($dept, 'finance')) {
            return 'High';
        }

        // Recurring by same email in last 7 days => bump
        $recentCount = Ticket::where('email', $data['email'] ?? null)
            ->where('created_at', '>=', now()->subDays(7))
            ->count();
        if ($recentCount >= 3) {
            return 'High';
        }

        return 'Normal';
    }
}
