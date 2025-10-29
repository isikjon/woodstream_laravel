<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OldProduct;
use Illuminate\Support\Facades\Cache;

class SearchController extends Controller
{
    public function autocomplete(Request $request)
    {
        $query = $request->get('q', '');
        
        if (mb_strlen($query) < 2) {
            return response()->json([]);
        }

        $cacheKey = 'search_' . md5($query);
        
        $products = Cache::remember($cacheKey, 600, function() use ($query) {
            $productsQuery = OldProduct::where('availability', '!=', 5)
                ->where(function($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%")
                      ->orWhere('model', 'LIKE', "%{$query}%")
                      ->orWhere('sku', 'LIKE', "%{$query}%");
                })
                ->orderByRaw("CASE 
                    WHEN name LIKE ? THEN 1
                    WHEN sku LIKE ? THEN 2
                    WHEN model LIKE ? THEN 3
                    ELSE 4
                END", ["{$query}%", "{$query}%", "{$query}%"])
                ->orderBy('priority', 'desc')
                ->limit(8)
                ->get(['id', 'name', 'model', 'sku', 'price', 'special', 'availability']);
            
            if ($productsQuery->isEmpty()) {
                $productsQuery = OldProduct::where(function($q) use ($query) {
                        $q->where('name', 'LIKE', "%{$query}%")
                          ->orWhere('model', 'LIKE', "%{$query}%")
                          ->orWhere('sku', 'LIKE', "%{$query}%");
                    })
                    ->orderByRaw("CASE 
                        WHEN name LIKE ? THEN 1
                        WHEN sku LIKE ? THEN 2
                        WHEN model LIKE ? THEN 3
                        ELSE 4
                    END", ["{$query}%", "{$query}%", "{$query}%"])
                    ->orderBy('priority', 'desc')
                    ->limit(8)
                    ->get(['id', 'name', 'model', 'sku', 'price', 'special', 'availability']);
            }
            
            return $productsQuery;
        });
        
        $results = $products->map(function($product) {
            $price = $product->special > 0 ? $product->special : $product->price;
            $statusText = $this->getStatusText($product->availability);
            
            return [
                'id' => $product->id,
                'name' => $product->name,
                'code' => $product->model ?: $product->sku,
                'price' => number_format($price, 0, ',', ' ') . ' ₽',
                'status' => $statusText,
                'url' => route('product.show', $product->id),
            ];
        });
        
        return response()->json($results);
    }

    protected function getStatusText($availability)
    {
        return match($availability) {
            5 => 'Продан',
            7 => 'В наличии',
            8 => 'Под заказ',
            9 => 'Забронировано',
            10 => 'Скоро в продаже',
            11 => 'Под реставрацию',
            default => 'В наличии',
        };
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
                  ->orWhere('sku', 'LIKE', "%{$query}%")
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
