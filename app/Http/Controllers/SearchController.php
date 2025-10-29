<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OldProduct;

class SearchController extends Controller
{
    public function autocomplete(Request $request)
    {
        $query = $request->get('q', '');
        
        if (mb_strlen($query) < 2) {
            return response()->json([]);
        }
        
        $products = OldProduct::where('availability', '!=', 5)
            ->where(function($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('model', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%");
            })
            ->limit(10)
            ->get(['id', 'name', 'model', 'slug']);
        
        $results = $products->map(function($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'code' => $product->model,
                'url' => route('products.show', $product->slug ?? $product->id),
                'photo' => $product->photo_url ?? '',
            ];
        });
        
        return response()->json($results);
    }
    
    public function results(Request $request)
    {
        $query = $request->get('q', '');
        
        if (mb_strlen($query) < 2) {
            return redirect()->route('catalog');
        }
        
        $products = OldProduct::where('availability', '!=', 5)
            ->where(function($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%")
                  ->orWhere('model', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%");
            })
            ->orderBy('priority', 'desc')
            ->orderBy('order', 'desc')
            ->paginate(24);
        
        return view('catalog.index', [
            'products' => $products,
            'searchQuery' => $query,
        ]);
    }
}
