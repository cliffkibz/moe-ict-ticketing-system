<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTicketRequest;
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

        $ticket = Ticket::create($data);

        return redirect()->route('tickets.show', $ticket->id)
                         ->with('success', 'Ticket created successfully!');
    }

    // Show a single ticket
    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('tickets.show', compact('ticket'));
    }
}
