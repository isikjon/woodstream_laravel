<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\OldProduct;

class ProductController extends Controller
{
    public function show($slug)
    {
        \Log::info('ProductController: Попытка загрузить товар ID: ' . $slug);
        try {
            $product = OldProduct::where('id', $slug)
                ->with(['categories', 'city', 'country', 'styles', 'materials'])
                ->firstOrFail();
            
            \Log::info('ProductController: Товар найден в продакшн БД: ' . $product->name);

            $similarProducts = OldProduct::whereHas('categories', function($q) use ($product) {
                $q->whereIn('categories.id', $product->categories->pluck('id'));
            })
            ->where('products.id', '!=', $product->id)
            ->whereIn('availability', [7, 8])
            ->limit(8)
            ->get();

            $weeklyProducts = OldProduct::where('products.id', '!=', $product->id)
                ->orderBy('priority', 'desc')
                ->limit(24)
                ->get();

            return view('products.show', compact('product', 'similarProducts', 'weeklyProducts'));
        } catch (\Exception $e) {
            \Log::error('ProductController: Ошибка загрузки товара: ' . $e->getMessage());
            \Log::error('ProductController: Stack trace: ' . $e->getTraceAsString());
            abort(404, 'Товар не найден');
        }
    }
}
