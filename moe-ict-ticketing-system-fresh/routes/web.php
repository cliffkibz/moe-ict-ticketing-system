<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PDFController;

Route::get('/', function () {
    return redirect()->route('tickets.index');
});

Route::resource('tickets', TicketController::class)->except(['edit', 'update', 'destroy']);
Route::get('tickets/{ticket}/pdf', [PDFController::class, 'export'])->name('tickets.pdf');
