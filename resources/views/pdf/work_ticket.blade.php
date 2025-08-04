<!DOCTYPE html>
<html>
<head>
    <title>State Department for Energy ICT Work Ticket</title>
    <style>
        body { font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #222; }
        .header { text-align: center; margin-bottom: 10px; }
        .header .title { font-size: 18px; font-weight: bold; margin-bottom: 2px; }
        .header .address { font-size: 12px; margin-bottom: 2px; }
        .header .contact { font-size: 12px; margin-bottom: 2px; }
        .divider { border-bottom: 2px solid #000; margin: 10px 0; }
        .section-label { font-weight: bold; margin-top: 10px; margin-bottom: 4px; text-transform: uppercase; font-size: 13px; }
        .row { display: flex; margin-bottom: 6px; }
        .label { width: 180px; font-weight: bold; }
        .value { flex: 1; border-bottom: 1px solid #222; min-height: 18px; padding-left: 4px; }
        .value.no-underline { border-bottom: none; }
        .remarks-line { border-bottom: 1px solid #222; width: 100%; height: 18px; margin-bottom: 2px; }
        .thankyou { text-align: center; margin-top: 30px; font-weight: bold; font-size: 14px; }
        .signature { margin-top: 18px; font-size: 12px; }
        .input-box { border: 1px solid #222; min-height: 22px; padding: 2px 4px; margin-bottom: 2px; }
        .small { font-size: 11px; }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="title">State Department for Energy ICT Work Ticket</div>
        <div class="address">Kawi Complex, Off Red Cross Rd, Nairobi.</div>
        <div class="contact">
            Nairobi | Phone: +254 (0) 20 4841000 | Email: info@energy.go.ke | <span class="small">https://energy.go.ke/</span>
        </div>
    </div>
    <div class="divider"></div>

    <!-- Ticket Info Section -->
    <div class="section-label">Ticket Information</div>
    <div class="row">
        <div class="label">Ticket Number:</div>
        <div class="value">{{ $ticket->ticket_no ?? '_________________' }}</div>
        <div class="label" style="width:120px;">Date:</div>
        <div class="value" style="width:120px;">{{ $ticket->created_at ? $ticket->created_at->format('d-M-Y') : '_____/_____/______' }}</div>
    </div>
    <div class="row">
        <div class="label">Completed Date (ICT):</div>
        <div class="value" style="width:120px;"></div>
        <div class="label" style="width:120px;">Signature Date:</div>
        <div class="value" style="width:120px;"></div>
    </div>

    <div class="divider"></div>

    <!-- Issue/Job Details Section -->
    <div class="section-label">Reported Issue</div>
    <div class="input-box">{{ $ticket->issue ?? '_________________________________________________________' }}</div>
    <div class="section-label">User Remarks</div>
    <div class="remarks-line"></div>
    <div class="remarks-line"></div>
    <div class="remarks-line"></div>
    <div class="remarks-line"></div>

    <div class="divider"></div>

    <!-- Requested By Section -->
    <div class="section-label">Requested By</div>
    <div class="row">
        <div class="label">Name:</div>
        <div class="value">{{ $ticket->requestor_name ?? '_________________' }}</div>
        <div class="label" style="width:120px;">Date & Time:</div>
        <div class="value" style="width:120px;">{{ $ticket->created_at ? $ticket->created_at->format('d-M-Y H:i') : '_____/_____/______' }}</div>
    </div>
    <div class="row">
        <div class="label">Email:</div>
        <div class="value">{{ $ticket->email ?? '_________________' }}</div>
        <div class="label" style="width:120px;">Floor/Dept:</div>
        <div class="value" style="width:120px;"></div>
    </div>
    <div class="row">
        <div class="label">Work Order Names:</div>
        <div class="value"></div>
    </div>

    <div class="divider"></div>

    <!-- Footer / Thank You -->
    <div class="thankyou">Thank You</div>
    <div class="signature">Sylvester ?? 20 4841000 F2, Geo</div>
</body>
</html>
