<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\KnowledgeBaseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChatbotController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('tickets', TicketController::class)->except(['edit', 'update', 'destroy']);
Route::get('tickets/{ticket}/pdf', [PDFController::class, 'export'])->name('tickets.pdf');
Route::post('tickets/{ticket}/close', [TicketController::class, 'close'])->name('tickets.close');
Route::post('tickets/{ticket}/assign', [TicketController::class, 'assign'])->name('tickets.assign');
Route::post('tickets/{ticket}/rate', [TicketController::class, 'rate'])->name('tickets.rate');

// Knowledge Base routes
Route::get('/kb', [KnowledgeBaseController::class, 'index'])->name('kb.index');
Route::get('/kb/create', [KnowledgeBaseController::class, 'create'])->name('kb.create');
Route::post('/kb', [KnowledgeBaseController::class, 'store'])->name('kb.store');
Route::get('/kb/{slug}', [KnowledgeBaseController::class, 'show'])->name('kb.show');

// Chatbot
Route::get('/chat', [ChatbotController::class, 'widget'])->name('chat.widget');
Route::post('/chat/message', [ChatbotController::class, 'message'])->name('chat.message');
