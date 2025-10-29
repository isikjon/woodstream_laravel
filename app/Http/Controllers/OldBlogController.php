<?php

namespace App\Http\Controllers;

use App\Models\OldBlog;
use Illuminate\Http\Request;

class OldBlogController extends Controller
{
    public function index(Request $request)
    {
        $query = OldBlog::where('type', 'article')->where('status', 1);

        if ($request->has('search') && $request->search) {
            $query->where(function($q) use ($request) {
                $q->where('header', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('tag') && $request->tag) {
            $query->where('tags', 'like', '%' . $request->tag . '%');
        }

        $articles = $query->orderBy('id', 'desc')->paginate(9);
        $tags = OldBlog::where('type', 'article')
            ->where('status', 1)
            ->whereNotNull('tags')
            ->pluck('tags')
            ->flatMap(function($tags) {
                return is_string($tags) ? explode(' ', $tags) : $tags;
            })
            ->unique()
            ->filter()
            ->values();

        return view('blog.index', compact('articles', 'tags'));
    }

    public function show($id)
    {
        $article = OldBlog::where('type', 'article')->where('status', 1)->findOrFail($id);
        $relatedArticles = OldBlog::where('type', 'article')
            ->where('status', 1)
            ->where('id', '!=', $article->id)
            ->limit(3)
            ->get();

        return view('blog.show', compact('article', 'relatedArticles'));
    }
}
