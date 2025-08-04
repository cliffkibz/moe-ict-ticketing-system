<!DOCTYPE html>
<html>
<head>
    <title>MOE ICT Work Ticket</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .section { margin-bottom: 10px; }
        .label { font-weight: bold; display: inline-block; width: 150px; }
        .box { border: 1px solid #000; padding: 5px; min-height: 30px; }
        .row { margin-bottom: 8px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>State Department for Energy ICT Work Ticket</h2>
        <p>Kawi Complex, Off Red Cross Rd, Nairobi<br>
        Phone: +254 (0) 20 4841000 • Email: info@energy.go.ke • https://energy.go.ke/</p>
    </div>

    <div class="section">
        <div class="row"><span class="label">Ticket No.:</span> {{ $ticket->ticket_no }}</div>
        <div class="row"><span class="label">Requested By:</span> {{ $ticket->requestor_name }}</div>
        <div class="row"><span class="label">Department:</span> {{ $ticket->department }}</div>
        <div class="row"><span class="label">Issue:</span> <div class="box">{{ $ticket->issue }}</div></div>
        <div class="row"><span class="label">Remarks:</span> <div class="box">{{ $ticket->remarks }}</div></div>
        <div class="row"><span class="label">Status:</span> {{ $ticket->status }}</div>
        <div class="row"><span class="label">Date Submitted:</span> {{ $ticket->created_at->format('d-M-Y H:i') }}</div>
    </div>

    <div class="section">
        <div class="row"><span class="label">Completed Date (ICT):</span> ___________________</div>
        <div class="row"><span class="label">Signature Date:</span> ___________________</div>
        <div class="row"><span class="label">ICT Staff:</span> ___________________</div>
    </div>
</body>
</html>
