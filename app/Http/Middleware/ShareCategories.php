<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\View;
use App\Models\Category;

class ShareCategories
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->is('admin*') && !$request->is('livewire*')) {
            $categories = cache()->remember('header_categories', 3600, function () {
                return Category::where('status', 1)
                    ->orderBy('order')
                    ->get(['id', 'name', 'slug']);
            });
            
            View::share('categories', $categories);
        }
        
        return $next($request);
    }
}
