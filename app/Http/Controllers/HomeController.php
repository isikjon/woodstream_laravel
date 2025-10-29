<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $weeklyProducts = \App\Models\OldProduct::where('availability', '!=', 5)
            ->orderBy('priority', 'desc')
            ->orderBy('order', 'desc')
            ->limit(8)
            ->get();

        try {
            $blogs = \App\Models\Blog::where('status', 1)
                ->orderBy('created_at', 'desc')
                ->limit(3)
                ->get();
        } catch (\Exception $e) {
            $blogs = collect();
        }

        return view('home.index', compact('weeklyProducts', 'blogs'));
    }
}
