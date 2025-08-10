<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Work Ticket #{{ $ticket->ticket_no }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            color: #222;
            background: #fff;
            margin: 0;
            padding: 0;
        }
        .header {
            display: flex;
            align-items: center;
            gap: 18px;
            border-bottom: 4px solid #0c5c2c;
            padding: 18px 0 10px 0;
        }
        .header img {
            height: 60px;
        }
        .header .title {
            font-size: 2rem;
            font-weight: bold;
            color: #0c5c2c;
            letter-spacing: 1px;
        }
        .accent {
            height: 8px;
            background: linear-gradient(90deg, #0c5c2c 0 60%, #F0B429 60% 100%);
            margin-bottom: 24px;
        }
        .section {
            margin-bottom: 22px;
        }
        .section-title {
            font-size: 1.1rem;
            font-weight: bold;
            color: #0c5c2c;
            margin-bottom: 8px;
            border-left: 4px solid #F0B429;
            padding-left: 8px;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 18px;
        }
        .details-table th, .details-table td {
            padding: 8px 10px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }
        .details-table th {
            background: #f3f4f6;
            color: #0c5c2c;
            font-weight: 600;
        }
        .details-table tr:last-child td {
            border-bottom: none;
        }
        .remarks {
            background: #f9fafb;
            border-left: 4px solid #0c5c2c;
            padding: 10px 14px;
            margin-bottom: 18px;
            font-size: 1rem;
        }
        .signature {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }
        .signature .block {
            width: 45%;
        }
        .signature .label {
            color: #0c5c2c;
            font-weight: 600;
            margin-bottom: 30px;
        }
        .signature .line {
            border-bottom: 1.5px solid #222;
            margin-bottom: 6px;
            height: 24px;
        }
        .footer {
            margin-top: 40px;
            font-size: 0.95rem;
            color: #888;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
<img src="public_path('energy.jpg')" alt="moe logo" style="height:60px">           <div class="title">Ministry of Education ICT Work Ticket</div>
    </div>
    <div class="accent"></div>

    <div class="section">
        <div class="section-title">Ticket Details</div>
        <table class="details-table">
            <tr>
                <th>Ticket No.</th>
                <td>{{ $ticket->ticket_no }}</td>
                <th>Status</th>
                <td>{{ $ticket->status }}</td>
            </tr>
            <tr>
                <th>Category</th>
                <td>{{ $ticket->category ?? '—' }}</td>
                <th>Priority</th>
                <td>{{ $ticket->priority ?? 'Normal' }}</td>
            </tr>
            <tr>
                <th>Requestor</th>
                <td>{{ $ticket->requestor_name }}</td>
                <th>Department</th>
                <td>{{ $ticket->department }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $ticket->email }}</td>
                <th>Date Submitted</th>
                <td>{{ $ticket->created_at->format('d-M-Y H:i') }}</td>
            </tr>
            <tr>
                <th>Assigned To</th>
                <td colspan="3">{{ optional($ticket->assignee)->name ?? '—' }}</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <div class="section-title">Issue Description</div>
        <div class="remarks">{{ $ticket->issue }}</div>
    </div>

    @if($ticket->remarks)
    <div class="section">
        <div class="section-title">Remarks</div>
        <div class="remarks">{{ $ticket->remarks }}</div>
    </div>
    @endif

    @if($ticket->status === 'Closed')
    <div class="section">
        <div class="section-title">Resolution</div>
        <table class="details-table">
            <tr>
                <th>Resolved At</th>
                <td>{{ $ticket->resolved_at ? $ticket->resolved_at->format('d-M-Y H:i') : '—' }}</td>
                <th>Resolution Time</th>
                <td>{{ $ticket->resolution_minutes ? $ticket->resolution_minutes . ' min' : '—' }}</td>
            </tr>
            <tr>
                <th>Rating</th>
                <td colspan="3">{{ $ticket->rating ? ($ticket->rating . '/5') : '—' }}</td>
            </tr>
        </table>
    </div>
    @endif

    <div class="signature">
        <div class="block">
            <div class="label">Requestor Signature</div>
            <div class="line"></div>
            <div>Date: ____________________</div>
        </div>
        <div class="block">
            <div class="label">Attache Signature</div>
            <div class="line"></div>
            <div>Date: ____________________</div>
        </div>
    </div>

    <div class="footer">
        &copy; {{ date('Y') }} Ministry of Education — ICT Ticketing System. All rights reserved.
    </div>
</body>
</html>
