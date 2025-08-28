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
        $data['ticket_no'] = $this->generateUniqueTicketNo();
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

    private function generateUniqueTicketNo(): string
    {
        do {
            $no = 'MOEICT ' . random_int(10000000, 99999999);
        } while (Ticket::where('ticket_no', $no)->exists());
        return $no;
    }

    private function inferPriority(array $data): string
    {
        $issue = strtolower($data['issue'] ?? '');
        $dept = strtolower($data['department'] ?? '');
        $category = $data['category'] ?? null;
        $email = $data['email'] ?? null;

        // 1) Strong phrases (exact substrings) that almost always imply High
        $strongPhrases = [
            'system down', 'server down', 'network down', 'production down', 'production outage',
            'security breach', 'data breach', 'data loss', 'ransomware', 'cannot access', "can't access", 'cant access',
        ];
        foreach ($strongPhrases as $p) {
            if ($p !== '' && str_contains($issue, $p)) {
                return 'High';
            }
        }

        // 2) Strong keywords with word boundaries
        if (preg_match('/\\b(urgent|critical|outage|breach|security)\\b/i', $issue)) {
            return 'High';
        }

        // 3) Contextual "down" — only if tied to key systems to avoid "download" false positives
        if (
            preg_match('/\\b(system|server|network|website|app|vpn)\\b[^\.\n]{0,20}\\bdown\\b/i', $issue) ||
            preg_match('/\\bdown\\b[^\.\n]{0,20}\\b(system|server|network|website|app|vpn)\\b/i', $issue)
        ) {
            return 'High';
        }

        // 4) Department bump for critical business functions
        if (preg_match('/\\b(exam|exams|finance|payroll|accounts)\\b/i', $dept)) {
            return 'High';
        }

        // 5) Category-specific heuristics (e.g., networking issues)
        if ($category === 'Networking' && preg_match('/\\b(outage|down|latency|packet loss|disconnect)\\b/i', $issue)) {
            return 'High';
        }

        // 6) Repetition by same reporter within time windows
        if ($email) {
            $count24h = Ticket::where('email', $email)
                ->where('created_at', '>=', now()->subHours(24))
                ->count();
            if ($count24h >= 2) {
                return 'High';
            }

            $count7d = Ticket::where('email', $email)
                ->where('created_at', '>=', now()->subDays(7))
                ->count();
            if ($count7d >= 3) {
                return 'High';
            }
        }

        // 7) Moderate indicators -> Medium
        if (preg_match('/\b(error|failed|failing|failure|not working|slow|performance|latency|timeout|timed out)\b/i', $issue)) {
            return 'Medium';
        }

        // 8) Low priority for non-critical categories when no other triggers
        if (in_array($category, ['GeneralSupport','SpecialUse'], true)) {
            return 'Low';
        }

        // Default
        return 'Normal';
    }
}
