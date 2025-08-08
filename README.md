<<<<<<< HEAD
# MOE ICT Ticketing System

A Laravel 11-based web application to manage ICT support tickets for the Ministry of Education (MOE). It provides a simple workflow for submitting, viewing, and managing tickets, plus PDF generation of work tickets and basic localization (English/Swahili).

Key features
- Ticket lifecycle: create, list, view details
- PDF work ticket export (barryvdh/laravel-dompdf)
- Localization scaffolding (en, sw)
- Tailwind CSS with Vite for assets
- Laravel 11, PHP >= 8.2

Technology stack
- Backend: Laravel 11 (PHP >= 8.2)
- Frontend: Vite + Tailwind CSS
- Database: MySQL/MariaDB, PostgreSQL, or SQLite
- Tooling: Composer, Node.js (>= 18)


Quick start (local development)
1) Prerequisites
   - PHP 8.2+
   - Composer 2+
   - Node.js 18+ and npm (or yarn/pnpm)
   - A database (MySQL/MariaDB, PostgreSQL, or SQLite)

2) Clone and enter the project
   - git clone <repo-url>
   - cd moe-ict-ticketing-system

3) Environment file
   - If .env does not exist, copy it from the example:
     - Linux/macOS: cp .env.example .env
     - Windows (PowerShell): Copy-Item .env.example .env
     - Windows (CMD): copy .env.example .env
   - Update .env with your database credentials and APP_URL if needed (e.g., http://127.0.0.1:8000)

4) Install dependencies
   - composer install
   - npm install

5) Generate app key (if not already generated)
   - php artisan key:generate

6) Database
   - Create a database and configure .env (DB_* values) accordingly.
   - To use SQLite, set DB_CONNECTION=sqlite and create the file:
     - Linux/macOS: touch database/database.sqlite
     - Windows (PowerShell): New-Item -ItemType File -Path database/database.sqlite
     - Windows (CMD): type NUL > database\database.sqlite
   - Run migrations:
     - php artisan migrate

7) Run the app (two terminals)
   - Terminal A (Laravel):
     - php artisan serve
   - Terminal B (Vite dev server for assets):
     - npm run dev
   - Open http://127.0.0.1:8000 in your browser.


Production build
- Build assets: npm run build
- Serve with your preferred web server (e.g., Nginx/Apache) pointing the document root to the public/ directory.
- Ensure APP_ENV=production and APP_DEBUG=false in .env.


Project structure (high-level)
- app/
  - Http/Controllers/ (TicketController, PDFController)
  - Http/Requests/ (StoreTicketRequest)
  - Models/ (Ticket)
- database/migrations/ (tickets table)
- resources/views/
  - tickets/ (create, index, show)
  - pdf/ (work_ticket)
- routes/web.php
- lang/
  - en/tickets.php
  - sw/tickets.php


Common commands
- Start Laravel: php artisan serve
- Run Vite dev server: npm run dev
- Run database migrations: php artisan migrate
- Clear caches: php artisan optimize:clear


Troubleshooting
- Port busy on 8000: php artisan serve --host=127.0.0.1 --port=8001
- Vite not found: ensure npm install ran successfully; Node 18+ is required.
- Database connection errors: verify DB_* in .env and that the DB server is running; for SQLite ensure the database file exists and is writable.


License
- Internal use. Update as appropriate for your organization.
=======
# osTicket-inspired Ticketing System
>>>>>>> 477a5336d0a4e4d69e1a4ad6cc023b53c96f9745
