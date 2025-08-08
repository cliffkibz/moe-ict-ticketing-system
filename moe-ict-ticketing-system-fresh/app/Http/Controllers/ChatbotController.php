<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KnowledgeBaseArticle;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ChatbotController extends Controller
{
    public function widget()
    {
        return view('chat.widget');
    }

    public function message(Request $request)
    {
        $data = $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        $text = trim($data['message']);

        // Simple rule-based reply using KB lookup
        $suggest = KnowledgeBaseArticle::where('published', true)
            ->where(function($q) use ($text) {
                $q->where('title', 'like', "%$text%")
                  ->orWhere('content', 'like', "%$text%");
            })
            ->limit(3)->get(['title', 'slug']);

        $reply = 'Here are some articles that might help:';
        if ($suggest->isEmpty()) {
            $reply = "I'm not sure yet. Please provide more details, or create a ticket.";
        }

        // Persist chat message (simple ephemeral session id)
        $sessionId = $request->cookie('chat_session_id') ?? (string) Str::uuid();
        if (!$request->hasCookie('chat_session_id')) {
            cookie()->queue(cookie('chat_session_id', $sessionId, 60*24*7));
        }

        DB::table('ai_chat_messages')->insert([
            'session_id' => $sessionId,
            'user_id' => Auth::id(),
            'role' => 'user',
            'content' => $text,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('ai_chat_messages')->insert([
            'session_id' => $sessionId,
            'user_id' => null,
            'role' => 'assistant',
            'content' => $reply . ($suggest->isNotEmpty() ? (' ' . $suggest->pluck('title')->map(fn($t) => '• ' . $t)->implode(' ')) : ''),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'reply' => $reply,
            'articles' => $suggest->map(fn($a) => [
                'title' => $a->title,
                'url' => route('kb.show', $a->slug)
            ])->values(),
        ]);
    }
}
