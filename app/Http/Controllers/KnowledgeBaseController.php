<?php

namespace App\Http\Controllers;

use App\Models\KnowledgeBaseArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KnowledgeBaseController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->get('q'));
        $articles = KnowledgeBaseArticle::query()
            ->when($q, function ($query) use ($q) {
                $query->where('title', 'like', "%$q%")
                    ->orWhere('content', 'like', "%$q%");
            })
            ->where('published', true)
            ->latest()
            ->paginate(10);

        return view('kb.index', compact('articles', 'q'));
    }

    public function show(string $slug)
    {
        $article = KnowledgeBaseArticle::where('slug', $slug)->where('published', true)->firstOrFail();
        $article->increment('views');
        return view('kb.show', compact('article'));
    }

    public function create()
    {
        return view('kb.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'content' => 'required|string',
            'published' => 'sometimes|boolean',
        ]);
        $data['slug'] = Str::slug($data['title']) . '-' . substr(Str::uuid(), 0, 8);
        $data['published'] = $request->boolean('published', true);
        $article = KnowledgeBaseArticle::create($data);
        return redirect()->route('kb.show', $article->slug)->with('success', 'Article created.');
    }
}
