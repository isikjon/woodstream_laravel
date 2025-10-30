<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $query = \App\Models\OldProduct::query();
        
        if (\Schema::connection('production')->hasColumn('products', 'availability')) {
            $query->where('availability', '!=', 5);
        }
        
        if (\Schema::connection('production')->hasColumn('products', 'priority')) {
            $query->orderBy('priority', 'desc');
        }
        if (\Schema::connection('production')->hasColumn('products', 'order')) {
            $query->orderBy('order', 'desc');
        }
        
        $weeklyProducts = $query->orderBy('id', 'desc')
            ->limit(8)
            ->get();

        try {
            $blogQuery = \App\Models\Blog::query();
            
            if (\Schema::connection('production')->hasColumn('blog', 'status')) {
                $blogQuery->where('status', 1);
            }
            
            $blogs = $blogQuery->orderBy('created_at', 'desc')
                ->limit(3)
                ->get();
        } catch (\Exception $e) {
            $blogs = collect();
        }

        return view('home.index', compact('weeklyProducts', 'blogs'));
    }
}
