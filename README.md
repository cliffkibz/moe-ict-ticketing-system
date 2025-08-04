# MOE ICT Ticketing System 🇰🇪
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── TicketController.php
│   │   │   ├── PDFController.php
│   │   └── Requests/
│   │       └── StoreTicketRequest.php
│   └── Models/
│       └── Ticket.php
├── database/
│   └── migrations/
│       └── create_tickets_table.php
├── resources/
│   ├── views/
│   │   ├── tickets/
│   │   │   ├── create.blade.php
│   │   │   ├── index.blade.php
│   │   │   └── show.blade.php
│   │   └── pdf/
│   │       └── work_ticket.blade.php
├── routes/
│   └── web.php
├── lang/
│   ├── en/
│   │   └── tickets.php
│   └── sw/
│       └── tickets.php
├── composer.json
├── package.json
├── tailwind.config.js (if using Tailwind)
└── README.md
A Laravel-based ticket management system for Kenya’s Ministry of Energy ICT Department.

## Features
- Ticket creation, status tracking
- PDF export matching official form
- English & Swahili support
- Role-based access for Admins, ICT Staff, and Users

## Requirements
- PHP 8.2+
- Laravel 11
- MySQL
- Composer & Node.js

## Setup
```bash
composer install
npm install && npm run dev
php artisan migrate
php artisan serve
