<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function export($id)
    {
        $ticket = Ticket::findOrFail($id);
        $pdf = Pdf::loadView('pdf.work_ticket', compact('ticket'));
        return $pdf->download("WorkTicket_{$ticket->ticket_no}.pdf");
    }
}
