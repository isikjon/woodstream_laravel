<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('status', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        $tags = Blog::where('status', 1)
            ->whereNotNull('tags')
            ->where('tags', '!=', '')
            ->pluck('tags')
            ->flatMap(function($tags) {
                return explode(',', $tags);
            })
            ->map(function($tag) {
                return trim($tag);
            })
            ->filter()
            ->unique()
            ->sort()
            ->values();

        return view('blog.index', compact('blogs', 'tags'));
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        $relatedBlogs = Blog::where('status', 1)
            ->where('id', '!=', $blog->id)
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();

        return view('blog.show', compact('blog', 'relatedBlogs'));
    }
}
