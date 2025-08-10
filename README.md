# MOE ICT Ticketing System

A Laravel 11-based web application to manage ICT support tickets for the Ministry of Education (MOE). It provides a simple workflow for submitting, viewing, and managing tickets, plus PDF generation of work tickets and basic localization (English/Swahili).

## Key Features
- Ticket lifecycle: create, list, view details
- PDF work ticket export (barryvdh/laravel-dompdf)
- Localization scaffolding (en, sw)
- Tailwind CSS with Vite for assets
- Laravel 11, PHP >= 8.2

## Technology Stack
- Backend: Laravel 11 (PHP >= 8.2)
- Frontend: Vite + Tailwind CSS
- Database: MySQL/MariaDB, PostgreSQL, or SQLite
- Tooling: Composer, Node.js (>= 18)

## Software & Dependencies Required
To run this application, you must have the following installed:
- **PHP 8.2+**
- **Composer 2+** (PHP dependency manager)
- **Node.js 18+** (JavaScript runtime)
- **npm** (comes with Node.js, for frontend assets)
- **A database**: MySQL/MariaDB, PostgreSQL, or SQLite
- **Git** (for cloning the repository)

### Optional/Recommended
- **A web server**: Apache or Nginx (for production)
- **PowerShell or Bash** (for running commands)

## Quick Start (Local Development)
1. **Clone and enter the project**
   ```sh
   git clone <repo-url>
   cd moe-ict-ticketing-system
   ```
2. **Environment file**
   - If `.env` does not exist, copy it from the example:
     - Linux/macOS: `cp .env.example .env`
     - Windows (PowerShell): `Copy-Item .env.example .env`
     - Windows (CMD): `copy .env.example .env`
   - Update `.env` with your database credentials and `APP_URL` if needed (e.g., `http://127.0.0.1:8000`)
3. **Install dependencies**
   ```sh
   composer install
   npm install
   ```
4. **Generate app key**
   ```sh
   php artisan key:generate
   ```
5. **Database setup**
   - Create a database and configure `.env` (`DB_*` values) accordingly.
   - To use SQLite, set `DB_CONNECTION=sqlite` and create the file:
     - Linux/macOS: `touch database/database.sqlite`
     - Windows (PowerShell): `New-Item -ItemType File -Path database/database.sqlite`
     - Windows (CMD): `type NUL > database\database.sqlite`
   - Run migrations:
     ```sh
     php artisan migrate
     ```
6. **Run the app (two terminals)**
   - Terminal A (Laravel):
     ```sh
     php artisan serve
     ```
   - Terminal B (Vite dev server for assets):
     ```sh
     npm run dev
     ```
   - Open [http://127.0.0.1:8000](http://127.0.0.1:8000) in your browser.

## Production Build
- Build assets: `npm run build`
- Serve with your preferred web server (e.g., Nginx/Apache) pointing the document root to the `public/` directory.
- Ensure `APP_ENV=production` and `APP_DEBUG=false` in `.env`.

## Project Structure (High-Level)
- `app/`
  - `Http/Controllers/` (TicketController, PDFController)
  - `Http/Requests/` (StoreTicketRequest)
  - `Models/` (Ticket)
- `database/migrations/` (tickets table)
- `resources/views/`
  - `tickets/` (create, index, show)
  - `pdf/` (work_ticket)
- `routes/web.php`
- `lang/`
  - `en/tickets.php`
  - `sw/tickets.php`

## Common Commands
- Start Laravel: `php artisan serve`
- Run Vite dev server: `npm run dev`
- Run database migrations: `php artisan migrate`
- Clear caches: `php artisan optimize:clear`
- Clear view cache: `php artisan view:clear`

## Troubleshooting
- Port busy on 8000: `php artisan serve --host=127.0.0.1 --port=8001`
- Vite not found: ensure `npm install` ran successfully; Node 18+ is required.
- Database connection errors: verify `DB_*` in `.env` and that the DB server is running; for SQLite ensure the database file exists and is writable.

## License
- Internal use only.
